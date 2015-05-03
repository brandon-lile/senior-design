<?php namespace User;

use Illuminate\View\Factory as View;
use DungeonCrawler\Objects\CharacterGeneral;
use DungeonCrawler\Objects\CharacterSheet;
use DungeonCrawler\Objects\Helpers\Character;

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

    public function __construct(View $view, CharacterGeneral $characterGeneral, App $app, Request $request, Character $character)
    {
        $this->beforeFilter('auth');

        parent::__construct();

        $this->view = $view;
        $this->characterGeneral = $characterGeneral;
        $this->app = $app;
        $this->request = $request;
        $this->character = $character;
    }

    public function getSheet($id = 0)
    {
        $sheet = CharacterSheet::where('id', $id)->All()->first();
        $sheet->abilities = $this->character->prettifyAbilities($sheet->abilities);

        $this->layout->content = $this->view->make('pages.character.sheet')
                                    ->with('class_dropdown', $this->characterGeneral->classToDropdown())
                                    ->with('background_dropdown', $this->characterGeneral->backgroundToDropdown())
                                    ->with('alignment_dropdown', $this->characterGeneral->alignmentToDropdown())
                                    ->with('race_dropdown', $this->characterGeneral->raceToDropdown())
                                    ->with('sheet', $sheet);
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

    /************************************************************************
     * Private Functions
     ***********************************************************************/
}