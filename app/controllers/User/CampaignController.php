<?php namespace User;

use Carbon\Carbon;
use DungeonCrawler\Objects\Campaign;
use DungeonCrawler\Objects\CampaignPicture;
use DungeonCrawler\Objects\DiaryEntry;
use DungeonCrawler\Objects\Npc;
use DungeonCrawler\User as User;
use DungeonCrawler\Objects\PendingPlayer;

use Illuminate\View\Factory as View;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector as Redirect;
use Illuminate\Foundation\Application as App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CampaignController extends \BaseController {

    public $layout = 'layouts.index';

    private $view;

    private $request;

    private $redirect;

    private $app;

    private $user;

    public function __construct(View $view, Request $request, Redirect $redirect, App $app)
    {
        $this->beforeFilter('auth');

        parent::__construct();

        $this->view = $view;
        $this->request = $request;
        $this->redirect = $redirect;
        $this->app = $app;
        $this->user = \Auth::user();
    }

    public function getIndex($id)
    {
        try
        {
            $campaign = Campaign::where('id', intval($id))->All()->firstOrFail();
            $dm = false;
            if ($campaign->dm_id == $this->user->id)
            {
                $dm = true;
            }

            $this->layout->content = $this->view->make('pages.campaign.index')
                ->with('campaign', $campaign)
                ->with('user', $this->user)
                ->with('is_dm', $dm);;
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function patchDescription()
    {
        try
        {
            $camp = Campaign::where('id', intval($this->request->get('camp_id')))->firstOrFail();
            $camp->description = $this->request->get('val');
            $camp->save();

            return \Response::json(true);
        }
        catch(ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function postEntry()
    {
        try
        {
            $camp = Campaign::where('id', intval($this->request->get('camp')))->with('DiaryEntry')->firstOrFail();

            $entry = new DiaryEntry();
            $entry->title = $this->request->get('title');
            $entry->entry = $this->request->get('entry');
            $camp->DiaryEntry()->save($entry);

            return $this->redirect->to('campaign/' . $camp->id);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }

    }

    public function postNpc()
    {
        try
        {
            $campaign = Campaign::where('id', intval($this->request->get('camp')))->firstOrFail();

            $npc = new Npc();
            $npc->name = $this->request->get('name');
            $npc->desc = $this->request->get('desc');

            $photo = $this->request->file('avatar');
            if($photo != null)
            {
                $random = md5(Carbon::now()) . str_random(16);
                $extension = $photo->getClientOriginalExtension();

                $photo->move(public_path('images/uploads'), $random . "." . $extension);
                $npc->npc_pic = $random;
                $npc->npc_pic_ext = $extension;
            }
            $campaign->Npc()->save($npc);

            return $this->redirect->to('campaign/' . $campaign->id);
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function postPicture()
    {
        try
        {
            $campaign = Campaign::where(array('id' => intval($this->request->get('campaign')), 'dm_id' => intval($this->user->id)))->firstOrFail();

            $photo = $this->request->file('picture');
            if($photo != null)
            {
                $pic = new CampaignPicture();
                $random = md5(Carbon::now()) . str_random(16);
                $extension = $photo->getClientOriginalExtension();

                $photo->move(public_path('images/uploads'), $random . "." . $extension);
                $pic->pic_filename = $random;
                $pic->pic_ext = $extension;
                $campaign->CampaignPicture()->save($pic);

                return $this->redirect->to('campaign/' . $campaign->id);
            }
            else
            {
                return $this->redirect->to('campaign/' . $campaign->id);
            }
        }
        catch (ModelNotFoundException $e)
        {
            $this->app->abort(404);
        }
    }

    public function postAddPlayer()
    {
        try
        {
            $campaign = Campaign::where(array('id' => intval($this->request->get('campaign')), 'dm_id' => $this->user->id))->firstOrFail();
            $user = User::where('email', $this->request->get('email'))->firstOrFail();

            $pending_player = new PendingPlayer();
            $pending_player->user_id = $user->id;
            $pending_player->campaign_id = $campaign->id;
            $pending_player->accept_hash = md5(Carbon::now()) . str_random(32);
            $pending_player->save();

            $email_info = array(
                'camp_name' => $campaign->campaign_name,
                'username' => $user->username
            );

            \Mail::send('emails.added_to_campaign', $email_info, function($message) use ($user, $campaign)
            {
                $message->from('brandon.lile@gmail.com', 'DungeonCrawler');
                $message->to($user['email'], $user['username'])->subject("You've been invited to the " . $campaign->campaign_name . " campaign!");
            });

            return $this->redirect->to('campaign/' . $campaign->id);
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirect->to('campaign/' . $this->request->get('campaign'));
        }
    }

    public function deleteCampaign($id = 0)
    {
        try
        {
            $campaign = Campaign::where(array('id' => intval($id), 'dm_id' => intval($this->user->id)))->firstOrFail();
            $campaign->delete();

            return $this->redirect->to('dashboard');
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirect->to('dashboard');
        }
    }
}