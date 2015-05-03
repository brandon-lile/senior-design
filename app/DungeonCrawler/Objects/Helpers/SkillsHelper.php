<?php namespace DungeonCrawler\Objects\Helpers;

class SkillsHelper {

    /************************************************************************
     * Helper arrays
     ***********************************************************************/

    protected $skills_id_to_name = array(
        0 => 'Acrobatics',
        1 => 'Animal Handling',
        2 => 'Arcana',
        3 => 'Athletics',
        4 => 'Deception',
        5 => 'History',
        6 => 'Insight',
        7 => 'Intimidation',
        8 => 'Investigation',
        9 => 'Medicine',
        10 => 'Nature',
        11 => 'Perception',
        12 => 'Performance',
        13 => 'Persuasion',
        14 => 'Religion',
        15 => 'Sleight of Hand',
        16 => 'Stealth',
        17 => 'Survival'
    );

    protected $skills_name_to_id = array(
        'Acrobatics' => 0,
        'Animal Handling' => 1,
        'Arcana' => 2,
        'Athletics' => 3,
        'Deception' => 4,
        'History' => 5,
        'Insight' => 6,
        'Intimidation' => 7,
        'Investigation' => 8,
        'Medicine' => 9,
        'Nature' => 10,
        'Perception' => 11,
        'Performance' => 12,
        'Persuasion' => 13,
        'Religion' => 14,
        'Sleight of Hand' => 15,
        'Stealth' => 16,
        'Survival' => 17
    );

    protected $skills_output_array = array(
        0 => array('skill' => 'Acrobatics', 'ability' => 1),
        1 => array('skill' => 'Animal Handling', 'ability' => 4),
        2 => array('skill' => 'Arcana', 'ability' => 3),
        3 => array('skill' => 'Athletics', 'ability' => 0),
        4 => array('skill' => 'Deception', 'ability' => 5),
        5 => array('skill' => 'History', 'ability' => 3),
        6 => array('skill' => 'Insight', 'ability' => 4),
        7 => array('skill' => 'Intimidation', 'ability' => 5),
        8 => array('skill' => 'Investigation', 'ability' => 3),
        9 => array('skill' => 'Medicine', 'ability' => 4),
        10 => array('skill' => 'Nature', 'ability' => 3),
        11 => array('skill' => 'Perception', 'ability' => 4),
        12 => array('skill' => 'Performance', 'ability' => 5),
        13 => array('skill' => 'Persuasion', 'ability' => 5),
        14 => array('skill' => 'Religion', 'ability' => 3),
        15 => array('skill' => 'Sleight of Hand', 'ability' => 1),
        16 => array('skill' => 'Stealth', 'ability' => 1),
        17 => array('skill' => 'Survival', 'ability' => 4),
    );

    protected $clean_skill_name_to_id = array(
        'acrobatics' => 0,
        'animalhandling' => 1,
        'arcana' => 2,
        'athletics' => 3,
        'deception' => 4,
        'history' => 5,
        'insight' => 6,
        'intimidation' => 7,
        'investigation' => 8,
        'medicine' => 9,
        'nature' => 10,
        'perception' => 11,
        'performance' => 12,
        'persuasion' => 13,
        'religion' => 14,
        'sleightofhand' => 15,
        'stealth' => 16,
        'survival' => 17
    );

    protected $skills_choice_dropdown = array(
        0 => '-',
        1 => 'P',
        2 => 'E'
    );

    public function getSkillsOutputArray()
    {
        return $this->skills_output_array;
    }

    public function getSkillsChoiceDropdown()
    {
        return $this->skills_choice_dropdown;
    }

    public function getCleanSkills()
    {
        return $this->clean_skill_name_to_id;
    }
}