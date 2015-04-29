<?php

use DungeonCrawler\Objects\Campaign;

class CampaignTableSeeder extends Seeder {

    public function run()
    {

        DB::table('campaigns')->delete();

        Campaign::create(
            array(
                'dm_id' => intval(1),
                'campaign_name' => 'MS&T DND test campaign',
                'description' => 'This is a description of the Missouri S&T Dungeons and Dragons test campaign.',

            )
        );
    }
}