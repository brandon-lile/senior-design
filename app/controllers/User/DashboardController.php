<?php namespace User;

use DungeonCrawler\Objects\CampaignCharacter;
use DungeonCrawler\User as User;
use DungeonCrawler\Objects\Campaign as Campaign;
use DungeonCrawler\Objects\CharacterGeneral as CharacterGeneral;
use DungeonCrawler\Objects\CharacterSheet;
use DungeonCrawler\Objects\PendingPlayer;
use DungeonCrawler\Objects\Helpers\Character;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\View\Factory as View;
use Illuminate\Http\Request as Request;
use Illuminate\Routing\Redirector as Redirect;

class DashboardController extends \BaseController {

    public $layout = 'layouts.index';

    private $view;

    private $request;

    private $redirect;

    private $characterGeneral;

    public function __construct(View $view, Request $request, Redirect $redirect, CharacterGeneral $characterGeneral, Character $character)
    {
        $this->beforeFilter('auth');

        parent::__construct();

        $this->view = $view;
        $this->request = $request;
        $this->redirect = $redirect;
        $this->characterGeneral = $characterGeneral;
        $this->character = $character;
        $this->user = \Auth::user();
    }

    public function getIndex()
    {
        $sheets = User::where('id', \Auth::id())
            ->with('CharacterSheets', 'CharacterSheets.CharacterGeneral', 'CampaignCharacters', 'CampaignCharacters.Campaign', 'CampaignCharacters.CharacterSheet.CharacterGeneral', 'OwnedCampaigns')
            ->firstOrFail();

        $pending_invites = PendingPlayer::where(array('user_id' => $this->user->id, 'accepted' => 0))->with('Campaign')->get();
        $pending_invites = $this->character->pendingToDropdown($pending_invites);
        $sheets_dropdown = $this->character->sheetsToDropdown($sheets);

        $this->layout->content = $this->view->make('pages.dashboard.index')
                                    ->with('sheets', $sheets->characterSheets)
                                    ->with('owned_campaigns', $sheets->ownedCampaigns)
                                    ->with('campaigns', $sheets->campaigncharacters)
                                    ->with('race_dropdown', $this->characterGeneral->raceToDropdown())
                                    ->with('alignment_dropdown', $this->characterGeneral->alignmentToDropdown())
                                    ->with('background_dropdown', $this->characterGeneral->backgroundToDropdown())
                                    ->with('class_dropdown', $this->characterGeneral->classToDropdown())
                                    ->with('pending', $pending_invites)
                                    ->with('sheets_dropdown', $sheets_dropdown)
                                    ->with('user', $this->user);
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
            return $this->redirect->to('dashboard')
                    ->withErrors($campaign->getValidatorErrors(), 'campaign')
                    ->withInput($this->request->all());
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
            return $this->redirect->to('dashboard')
                    ->withErrors($charGen->getValidatorErrors(), 'character')
                    ->withInput($this->request->all());
        }
    }

    public function postAcceptInvite()
    {
        try
        {
            $invite = PendingPlayer::where(array('user_id' => $this->user->id, 'campaign_id' => intval($this->request->get('campaign'))))->firstOrFail();
            $sheet = CharacterSheet::where(array('id' => intval($this->request->get('character')), 'user_id' => $this->user->id))->firstOrFail();

            $camp_char = new CampaignCharacter();
            $camp_char->camp_id = intval($this->request->get('campaign'));
            $camp_char->sheet_id = $sheet->id;
            $camp_char->save();

            $invite->accepted = intval(1);
            $invite->save();

            return $this->redirect->to('dashboard');
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirect->to('dashboard');
        }
    }
}