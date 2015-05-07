<div class="ui green raised segment" id="misc">
    <h2 class="ui header">Misc.</h2>
    <div class="ui form" id="misc">
        <div class="field">
            {{ Form::label('traits', 'Personality Traits') }}
            {{ Form::textarea('traits', $sheet->charactergeneral->traits) }}
        </div>
        <div class="field">
            {{ Form::label('ideals', 'Ideals') }}
            {{ Form::textarea('ideals', $sheet->charactergeneral->ideals) }}
        </div>
        <div class="field">
            {{ Form::label('bonds', 'Bonds') }}
            {{ Form::textarea('bonds', $sheet->charactergeneral->bonds) }}
        </div>
        <div class="field">
            {{ Form::label('flaws', 'Flaws') }}
            {{ Form::textarea('flaws', $sheet->charactergeneral->flaws) }}
        </div>
    </div>
</div>