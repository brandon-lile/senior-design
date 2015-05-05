<?php namespace User;

use Illuminate\View\Factory as View;
use DungeonCrawler\Objects\CharacterGeneral;
use DungeonCrawler\Objects\CharacterSheet;
use DungeonCrawler\Objects\Helpers\Character;
use DungeonCrawler\Objects\SavingThrow;
use DungeonCrawler\Objects\Skill;
use DungeonCrawler\Objects\Helpers\SkillsHelper;
use DungeonCrawler\Objects\Equipment;

use Illuminate\Http\Request;
use Illuminate\Foundation\Application as App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CharacterController extends \BaseController{

    public $layout = 'layouts.index';

    private $view;

    private $characterGeneral;

    private $app;

    private $request;

    private $character;

    private $skills;

    public function __construct(View $view, CharacterGeneral $characterGeneral, App $app, Request $request, Character $character, SkillsHelper $skillsHelper)
    {
        $this->beforeFilter('auth');

        parent::__construct();

        $this->view = $view;
        $this->characterGeneral = $characterGeneral;
        $this->app = $app;
        $this->request = $request;
        $this->character = $character;
        $this->skills = $skillsHelper;
    }

    public function getSheet($id = 0)
    {
        $sheet = CharacterSheet::where('id', $id)->All()->first();
        $sheet->abilities = $this->character->prettifyAbilities($sheet->abilities, true);
        $sheet->savingthrows->abilities = $this->character->prettifyAbilities($sheet->savingthrows->abilities, false);
        $ability_ids = $this->character->abilityIdToName();
        $ability_ids[null] = "None";

        // Spell save and spell attack
        $spell_save = $spell_bonus = 0;
        if ($sheet->charactergeneral->spellclass->ability == null)
        {
            $spell_save = 8 + $sheet->charactergeneral->proficiency_bonus;
        }
        else
        {
            $spell_save = 8 + $sheet->charactergeneral->proficiency_bonus + $sheet->abilities[$sheet->charactergeneral->spellclass->ability]['bonus'];
        }

        $this->layout->content = $this->view->make('pages.character.sheet')
                                    ->with('class_dropdown', $this->characterGeneral->classToDropdown())
                                    ->with('background_dropdown', $this->characterGeneral->backgroundToDropdown())
                                    ->with('alignment_dropdown', $this->characterGeneral->alignmentToDropdown())
                                    ->with('race_dropdown', $this->characterGeneral->raceToDropdown())
                                    ->with('sheet', $sheet)
                                    ->with('skills_output', $this->skills->getSkillsOutputArray())
                                    ->with('ability_ids', $ability_ids)
                                    ->with('skills_choices', $this->skills->getSkillsChoiceDropdown())
                                    ->with('spell_save', $spell_save);
    }

    /************************************************************************
     * Ajax functions
     ***********************************************************************/

    public function patchAbility()
    {
        try
        {
            $sheet = CharacterSheet::where('id', intval($this->request->get('sheet')))->firstOrFail();
            $abilityToId = $this->character->AbilityNameToId();
            $new_abilities = $sheet->abilities;

            if(isset($new_abilities[$abilityToId[$this->request->get('ability')]]))
            {
                $new_abilities[$abilityToId[$this->request->get('ability')]] = intval($this->request->get('value'));
                $sheet->abilities = array();
                $sheet->abilities = $new_abilities;
                $sheet->save();
            }

            return \Response::json(array('bonus' => $this->character->getAbilityBonus($this->request->get('value'))));
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function patchClassAttr($attr)
    {
        $attr_array = array('class', 'race', 'alignment', 'background', 'level', 'xp');

        if(in_array($attr, $attr_array))
        {
            try
            {
                $sheet = CharacterGeneral::where('sheet_id', intval($this->request->get('sheet')))->firstOrFail();
                $sheet[$attr] = intval($this->request->get('value'));
                $sheet->save();

                return \Response::json(true);
            }
            catch (ModelNotFoundException $e)
            {
                $this->app->abort(404);
            }
        }

        $this->app->abort(404);
    }

    public function patchSavingThrow()
    {
        try
        {
            $throws = SavingThrow::where('sheet_id', intval($this->request->get('sheet')))->firstOrFail();
            $abilityToId = $this->character->AbilityNameToId();
            $new_abilities = $throws->abilities;

            if(isset($new_abilities[$abilityToId[$this->request->get('field')]]))
            {
                $new_abilities[$abilityToId[$this->request->get('field')]] = intval(boolval($this->request->get('value')));
                $throws->abilities = $new_abilities;
                $throws->save();

                return \Response::json(true);
            }
            else
            {
                $this->app->abort(404);
            }
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function patchSkills()
    {
        try
        {
            $skills = Skill::where('sheet_id', intval($this->request->get('sheet')))->firstOrFail();
            $new_skills = $skills->skills;
            $clean_skills = $this->skills->getCleanSkills();

            if (isset($new_skills[$clean_skills[$this->request->get('skill')]]))
            {
                $new_skills[$clean_skills[$this->request->get('skill')]] = intval($this->request->get('value'));
                $skills->skills = array();
                $skills->skills = $new_skills;
                $skills->save();

                return \Response::json($new_skills);
            }
            else
            {
                $this->app->abort(404);
            }
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function patchInspiration($sheet, $val)
    {
        try
        {
            $sheet_data = CharacterSheet::where('id', intval($sheet))->firstOrFail();
            $sheet_data->insp = boolval($val);
            $sheet_data->save();

            return \Response::json($val);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function postEquipment()
    {
        try
        {
            $sheet = CharacterSheet::where('id', intval($this->request->get('sheet')))->firstOrFail();
            $equipment = new Equipment();
            $equipment->name = $this->request->get('equipment');

            $sheet->Equipment()->save($equipment);

            return \Response::json($equipment);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function deleteEquipment()
    {
        try
        {
            $equipment = Equipment::where(array('id' => intval($this->request->get('equip_id')), 'sheet_id' => intval($this->request->get('sheet'))))->firstOrFail();
            $equipment->delete();

            return \Response::json(true);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function patchHP()
    {
        $sheet_attr = array('armor_class', 'initiative', 'speed');
        $hp_attr = array('current', 'max');
        try
        {
            $sheet = CharacterSheet::where('id', intval($this->request->get('sheet')))->with('CharacterHP')->firstOrFail();

            if (in_array($this->request->get('field'), $sheet_attr))
            {
                $sheet[$this->request->get('field')] = $this->request->get('value');
                $sheet->save();
            }
            elseif (in_array($this->request->get('field'), $hp_attr))
            {
                $sheet->characterhp[$this->request->get('field')] = intval($this->request->get('value'));
                $sheet->characterhp->save();
            }
            else
            {
                $this->app->abort(500);
            }

            return \Response::json(true);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function patchInfo()
    {
        try
        {
            $info_attr = array('age', 'height', 'weight', 'eyes', 'skin', 'hair', 'backstory', 'traits', 'ideals', 'bonds');
            $sheet = CharacterSheet::where('id', intval($this->request->get('sheet')))->with('CharacterGeneral')->firstOrFail();

            if (in_array($this->request->get('field'), $info_attr))
            {
                $sheet->charactergeneral[$this->request->get('field')] = $this->request->get('value');
                $sheet->charactergeneral->save();

                return \Response::json(true);
            }
            else
            {
                $this->app->abort(500);
            }
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function patchFeatures()
    {
        try
        {
            $sheet = CharacterSheet::where('id', intval($this->request->get('sheet')))->firstOrFail();
            $sheet->features = $this->request->get('features');
            $sheet->save();

            return \Response::json(true);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    /************************************************************************
     * Private Functions
     ***********************************************************************/
}