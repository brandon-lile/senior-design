<?php namespace DungeonCrawler\Objects\Helpers;


class Character {

    /************************************************************************
     * Helper arrays
     ***********************************************************************/

    protected $ability_id_to_name = array(
        0 => 'Strength',
        1 => 'Dexterity',
        2 => 'Constitution',
        3 => 'Intelligence',
        4 => 'Wisdom',
        5 => 'Charisma'
    );

    protected $ability_name_to_id = array(
        'strength' => 0,
        'dexterity' => 1,
        'constitution' => 2,
        'intelligence' => 3,
        'wisdom' => 4,
        'charisma' => 5
    );

    /************************************************************************
     * Helper functions
     ***********************************************************************/

    public function AbilityNameToId()
    {
        return $this->ability_name_to_id;
    }

    public function abilityIdToName()
    {
        return $this->ability_id_to_name;
    }

    public function prettifyAbilities($abilities, $bonus = true)
    {
        $return_array = array();

        foreach($abilities as $skill_id => $skill_val)
        {
            $return_array[$skill_id] = array(
                'name' => $this->ability_id_to_name[$skill_id],
                'value' => $skill_val,
            );

            if($bonus === true)
            {
                $return_array[$skill_id]['bonus'] = floor(($skill_val - 10) / 2);
            }
        }

        return $return_array;
    }

    public function getAbilityBonus($value)
    {
        return floor(($value - 10) / 2);
    }

    public function realignSpells($spells)
    {
        $final_spells = array();
        $final_spells['spells'] = array();
        $final_spells['cantrips'] = array();

        foreach($spells as $spell)
        {
            if($spell->level == 0)
            {
                $final_spells['cantrips'][] = $spell;
            }
            else
            {
                $final_spells['spells'][$spell->level][] = $spell;
            }
        }

        foreach($final_spells['spells'] as $level => $level_spells)
        {
            $final_spells['spells'][$level]['count'] = count($level_spells);
            $final_spells['spells'][$level]['used'] = 0;
        }

        $final_spells['cantrips']['count'] = count($final_spells['cantrips']);

        return $final_spells;
    }

    public function pendingToDropdown($pending)
    {
        if ($pending->count() > 0)
        {
            $return_invites = array();
            foreach($pending as $invite)
            {
                $return_invites[$invite->id] = $invite->campaign->campaign_name;
            }
            return $return_invites;
        }
        else
        {
            return false;
        }
    }

    public function sheetsToDropdown($sheets)
    {
        if ($sheets->charactersheets->count() > 0)
        {
            $return_sheets = array();
            foreach($sheets->charactersheets as $sheet)
            {
                $return_sheets[$sheet->id] = $sheet->charactergeneral->char_name;
            }
            return $return_sheets;
        }
        else
        {
            return false;
        }
    }
}