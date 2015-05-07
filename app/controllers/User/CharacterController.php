<?php namespace User;

use Carbon\Carbon;
use Illuminate\View\Factory as View;
use DungeonCrawler\Objects\CharacterGeneral;
use DungeonCrawler\Objects\CharacterSheet;
use DungeonCrawler\Objects\Helpers\Character;
use DungeonCrawler\Objects\SavingThrow;
use DungeonCrawler\Objects\Skill;
use DungeonCrawler\Objects\Helpers\SkillsHelper;
use DungeonCrawler\Objects\Equipment;
use DungeonCrawler\Objects\Spell;
use DungeonCrawler\Objects\Helpers\SpellClass;
use DungeonCrawler\Objects\CharSpell;
use DungeonCrawler\Objects\Treasure;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector as Redirect;
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

    private $redirect;

    public function __construct(View $view, CharacterGeneral $characterGeneral, App $app, Request $request, Character $character, SkillsHelper $skillsHelper, Redirect $redirect)
    {
        $this->beforeFilter('auth');

        parent::__construct();

        $this->view = $view;
        $this->characterGeneral = $characterGeneral;
        $this->app = $app;
        $this->request = $request;
        $this->character = $character;
        $this->skills = $skillsHelper;
        $this->redirect = $redirect;
        $this->user = \Auth::user();
    }

    public function getSheet($id = 0)
    {
        // @todo - Add link to campaign page
        try
        {
            $sheet = CharacterSheet::where(array('id' => intval($id), 'user_id' => $this->user->id))->All()->firstOrFail();
            $sheet->abilities = $this->character->prettifyAbilities($sheet->abilities, true);
            $sheet->savingthrows->abilities = $this->character->prettifyAbilities($sheet->savingthrows->abilities, false);
            $ability_ids = $this->character->abilityIdToName();
            $ability_ids[null] = "None";

            // Spell save and spell attack
            $spell_save = 0;
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
                ->with('spell_save', $spell_save)
                ->with('user', $this->user);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function postAvatar()
    {
        try
        {
            $sheet = CharacterSheet::where('id', intval($this->request->get('sheet_id')))->firstOrFail();

            $photo = $this->request->file('avatar');

            if($photo === null)
            {
                $this->app->abort(200);
            }
            else
            {
                $random = md5(Carbon::now()) . str_random(16);
                $extension = $photo->getClientOriginalExtension();

                $photo->move(public_path('images/uploads'), $random . "." . $extension);
                $sheet->char_pic = $random;
                $sheet->char_pic_ext = $extension;
                $sheet->save();

                return $this->redirect->to('character/' . $sheet->id);
            }
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function deleteAvatar($id = 0)
    {
        try
        {
            $sheet = CharacterSheet::where('id', intval($id))->firstOrFail();
            $sheet->char_pic = null;
            $sheet->char_pic_ext = null;
            $sheet->save();

            return $this->redirect->to('character/' . $sheet->id);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function deleteCharacter($id = 0)
    {
        try
        {
            $sheet = CharacterSheet::where(array('id' => intval($id), 'user_id' => intval($this->user->id)))->firstOrFail();
            $sheet->delete();

            return $this->redirect->to('dashboard');
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    /************************************************************************
     * Ajax functions
     ***********************************************************************/

    public function patchLevels()
    {
        try
        {
            $sheet = CharacterSheet::where('id', intval($this->request->get('sheet')))->with('SpellsUsed')->firstOrFail();
            $new_array = $sheet->spellsused->spells_used;
            $new_array[$this->request->get('level')] = $this->request->get('value');
            $sheet->spellsused->spells_used = $new_array;
            $sheet->spellsused->save();

            return \Response::json($sheet->spellsused);

        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function getSpells($id = 0)
    {
        try
        {
            $sheet = CharacterSheet::where('id', $id)->with('CharacterGeneral', 'CharacterGeneral.SpellClass', 'CharSpell', 'CharSpell.Spell', 'SpellsUsed')->firstOrFail();

            // Spells (currently grab all of the same class -- no subclass)
            if (strpos($sheet->charactergeneral->spellclass->class, " ") != false)
                $base_class = substr($sheet->charactergeneral->spellclass->class, 0, strpos($sheet->charactergeneral->spellclass->class, " "));
            else
                $base_class = $sheet->charactergeneral->spellclass->class;

            $spell_class_ids = SpellClass::where('class', 'LIKE', '%' . $base_class . '%')->get();

            $classes = array();
            foreach ($spell_class_ids as $spell_class)
            {
                $classes[] = $spell_class->id;
            }

            // Get the spells
            $spells = Spell::whereIn('class', $classes)->get();

            // Realign
            $spells = $this->character->realignSpells($spells);

            //Get the spell levels used
            $spells_used = $this->character->realignSpellsUsed($sheet->spellsused);

            // Realign the spells the user has
            $used_spells = array();
            foreach($sheet->CharSpell as $charspell)
            {
                if($charspell->spell->level != 0){
                    $spells['spells'][$charspell->spell->level]['used']++;
                    $used_spells[] = $charspell->spell_id;
                }
            }

            $spells['used'] = $used_spells;
            $spells['level_used'] = $spells_used;
            return \Response::json($spells);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function postSpell()
    {
        try
        {
            $sheet = CharacterSheet::where('id', intval($this->request->get('sheet')))->firstOrFail();

            // Check to see if we have the spell already
            try
            {
                $charSpell = CharSpell::where(array('sheet_id' => intval($this->request->get('sheet')), 'spell_id' => intval($this->request->get('spell'))))->firstOrFail();
                $charSpell->delete();
                return \Response::json(false);
            }
            catch (ModelNotFoundException $e)
            {
                // Don't have it yet
                $charSpell = new CharSpell();
                $charSpell->sheet_id = intval($this->request->get('sheet'));
                $charSpell->spell_id = intval($this->request->get('spell'));
                $charSpell->save();

                return \Response::json($charSpell);
            }
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

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

                if($attr == 'class')
                {
                    $charSpells = CharSpell::where('sheet_id', intval($this->request->get('sheet')))->get();
                    foreach($charSpells as $cs)
                    {
                        $cs->delete();
                    }
                }

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
            $info_attr = array('age', 'height', 'weight', 'eyes', 'skin', 'hair', 'backstory', 'traits', 'ideals', 'bonds', 'flaws');
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

    public function postTreasure()
    {
        try
        {
            $sheet = CharacterSheet::where('id', intval($this->request->get('sheet')))->firstOrFail();

            $treasure = new Treasure();
            $treasure->name = $this->request->get('name');
            $treasure->description = $this->request->get('desc');
            $treasure->quantity = $this->request->get('qty');
            $sheet->Treasure()->save($treasure);

            return \Response::json($treasure);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function deleteTreasure()
    {
        try
        {
            $treasure = Treasure::where(array('id' => $this->request->get('treasure'), 'sheet_id' => intval($this->request->get('sheet'))))->firstOrFail();
            $treasure->delete();

            return \Response::json(true);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }
}