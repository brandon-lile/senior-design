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

    public function prettifyAbilities($abilities)
    {
        $return_array = array();

        foreach($abilities as $skill_id => $skill_val)
        {
            $return_array[$skill_id] = array(
                'name' => $this->ability_id_to_name[$skill_id],
                'value' => $skill_val,
                'bonus' => floor(($skill_val - 10) / 2)
            );
        }

        return $return_array;
    }

    public function getAbilityBonus($value)
    {
        return floor(($value - 10) / 2);
    }
}