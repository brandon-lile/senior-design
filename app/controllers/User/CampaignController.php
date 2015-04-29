<?php namespace User;

use DungeonCrawler\Objects\Campaign;
use DungeonCrawler\Objects\CampaignCharacter;

use Illuminate\View\Factory as View;

class CampaignController extends \BaseController {

    public $layout = 'layouts.index';

    private $view;

    public function __construct(View $view)
    {
        parent::__construct();

        $this->view = $view;
    }

    public function getIndex($id = 0)
    {
        $campaign = Campaign::where('id', intval($id))
            ->with('CampaignCharacters', 'CharacterSheets')
            ->firstOrFail();

        dd($campaign);
        $this->layout->content = $this->view->make('pages.campaign.index')
                                    ->with('campaign', $campaign);
    }
}