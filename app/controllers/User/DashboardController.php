<?php namespace User;

use DungeonCrawler\User as User;
use DungeonCrawler\Objects\Campaign as Campaign;
use DungeonCrawler\Objects\CharacterGeneral as CharacterGeneral;
use DungeonCrawler\Objects\CharacterSheet;

use Illuminate\View\Factory as View;
use Illuminate\Http\Request as Request;
use Illuminate\Routing\Redirector as Redirect;

class DashboardController extends \BaseController {

    public $layout = 'layouts.index';

    private $view;

    private $request;

    private $redirect;

    private $characterGeneral;

    public function __construct(View $view, Request $request, Redirect $redirect, CharacterGeneral $characterGeneral)
    {
        $this->beforeFilter('auth');

        parent::__construct();

        $this->view = $view;
        $this->request = $request;
        $this->redirect = $redirect;
        $this->characterGeneral = $characterGeneral;
    }

    public function getIndex()
    {
        $sheets = User::where('id', \Auth::id())
            ->with('CharacterSheets', 'CharacterSheets.CharacterGeneral', 'CampaignCharacters', 'CampaignCharacters.Campaign', 'OwnedCampaigns')
            ->firstOrFail();

        $this->layout->content = $this->view->make('pages.dashboard.index')
                                    ->with('sheets', $sheets->characterSheets)
                                    ->with('campaigns', $sheets->ownedCampaigns)
                                    ->with('race_dropdown', $this->characterGeneral->raceToDropdown())
                                    ->with('alignment_dropdown', $this->characterGeneral->alignmentToDropdown())
                                    ->with('background_dropdown', $this->characterGeneral->backgroundToDropdown())
                                    ->with('class_dropdown', $this->characterGeneral->classToDropdown());
    }

    public function postCreateCampaign()
    {
        $campaign = new Campaign();
        $campaign->campaign_name = $this->request->get('name');
        $campaign->description = $this->request->get('description');
        $campaign->dm_id = \Auth::id();

        if ($campaign->isValid(true))
        {
            $campaign->save();

            return $this->redirect->to('dashboard');
        }
        else
        {

        }
    }

    public function postCreateCharacter()
    {
        $charGen = new CharacterGeneral();
        $charGen->char_name = $this->request->get('name');
        $charGen->fill($this->request->except('name'));

        if ($charGen->isValid(true))
        {
            $charSheet = new CharacterSheet();
            $charSheet->user_id = \Auth::id();
            $charSheet->save();
            $charSheet->CharacterGeneral()->save($charGen);

            return $this->redirect->to('dashboard');
        }
        else
        {

        }
    }

}