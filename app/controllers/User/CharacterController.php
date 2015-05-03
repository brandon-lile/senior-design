<?php namespace User;

use Illuminate\View\Factory as View;
use DungeonCrawler\Objects\CharacterGeneral;
use DungeonCrawler\Objects\CharacterSheet;
use DungeonCrawler\Objects\Helpers\Character;
use DungeonCrawler\Objects\SavingThrow;
use DungeonCrawler\Objects\Skill;
use DungeonCrawler\Objects\Helpers\SkillsHelper;

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

        $this->layout->content = $this->view->make('pages.character.sheet')
                                    ->with('class_dropdown', $this->characterGeneral->classToDropdown())
                                    ->with('background_dropdown', $this->characterGeneral->backgroundToDropdown())
                                    ->with('alignment_dropdown', $this->characterGeneral->alignmentToDropdown())
                                    ->with('race_dropdown', $this->characterGeneral->raceToDropdown())
                                    ->with('sheet', $sheet)
                                    ->with('skills_output', $this->skills->getSkillsOutputArray())
                                    ->with('ability_ids', $this->character->abilityIdToName())
                                    ->with('skills_choices', $this->skills->getSkillsChoiceDropdown());
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

    /************************************************************************
     * Private Functions
     ***********************************************************************/
}