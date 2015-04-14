<?php

use DungeonCrawler\Objects\CharSpell;

class CampaignCharacterTableSeeder extends Seeder {

    public function run()
    {

        DB::table('campaign_characters')->delete();

        CampaignCharacter::create(
            array(
                'sheet_id' => intval(1),
                'camp_id' => intval(1),

            )
        );
    }
}