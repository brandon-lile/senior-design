<div class="ui form">
    <div class="fields">
        <div class="six wide field">
            {{ Form::label('ac', 'Armor Class') }}
            {{ Form::number('ac', 0) }}
        </div>
        <div class="five wide field">
            {{ Form::label('initiative', 'Initiative') }}
            {{ Form::number('initiative', 0) }}
        </div>
        <div class="five wide field">
            {{ Form::label('speed', 'Speed') }}
            {{ Form::number('speed', 0) }}
        </div>
    </div>
    <div class="two fields">
        <div class="field">
            <div class="ui mini left labeled input">
                <div class="ui green label">
                    {{ Form::label('max_hp', 'Max HP') }}
                </div>
                {{ Form::number('max_hp', 0) }}
            </div>
        </div>
        <div class="field">
            <div class="ui mini left labeled input">
                <div class="ui green label">
                    {{ Form::label('cur_hp', 'Cur HP') }}
                </div>
                {{ Form::number('cur_hp', 0) }}
            </div>
        </div>
    </div>
</div>
<div class="ui green raised segment">
    <h2 class="ui header">Misc.</h2>
    <div class="ui form" id="misc">
        <div class="field">
            {{ Form::label('traits', 'Personality Traits') }}
            {{ Form::textarea('traits') }}
        </div>
        <div class="field">
            {{ Form::label('ideals', 'Ideals') }}
            {{ Form::textarea('ideals') }}
        </div>
        <div class="field">
            {{ Form::label('bonds', 'Bonds') }}
            {{ Form::textarea('bonds') }}
        </div>
    </div>
</div>