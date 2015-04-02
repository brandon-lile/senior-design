<div class="ui blue raised segment">
    <h2 class="ui header">Skills</h2>
    <?php
        $skills1 = array(
            'Acrobatics' => 'Dex',
            'Animal Handling' => 'Wis',
            'Arcana' => 'Int',
            'Athletics' => 'Str',
            'Deception' => 'Cha',
            'History' => 'Int',
            'Insight' => 'Wis',
            'Intimidation' => 'Cha',
            'Investigation' => 'Int'
        );
        $skills2 = array(
            'Medicine' => 'Wis',
            'Nature' => 'Int',
            'Perception' => 'Wis',
            'Performance' => 'Cha',
            'Persuasion' => 'Cha',
            'Religion' => 'Int',
            'Sleight of Hand' => 'Dex',
            'Stealth' => 'Dex',
            'Survival' => 'Wis'
        );
    ?>
    <div class="ui two column grid">
        <div class="column">
            @foreach($skills1 as $skill => $stat)
                <div class="ui mini toggle checkbox">
                    {{ Form::checkbox($skill, $skill) }}
                    {{ Form::label($skill, $skill . " (" . $stat . ")") }}
                </div>
                <div class="ui divider"></div>
            @endforeach
        </div>
        <div class="column">
            @foreach($skills2 as $skill => $stat)
                <div class="ui mini toggle checkbox">
                    {{ Form::checkbox($skill, $skill) }}
                    {{ Form::label($skill, $skill . " (" . $stat . ")") }}
                </div>
                <div class="ui divider"></div>
            @endforeach
        </div>
    </div>
</div>