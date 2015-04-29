<div class="ui form" id="stats">
    <div class="twelve wide field">
        {{ Form::label('strength', 'Strength') }}
        {{ Form::number('strength') }}
    </div>

    <div class="twelve wide field">
        {{ Form::label('dexterity', 'Dexterity') }}
        {{ Form::number('dexterity', 0) }}
    </div>

    <div class="twelve wide field">
        {{ Form::label('constitution', 'Constitution') }}
        {{ Form::number('constitution', 0) }}
    </div>

    <div class="twelve wide field">
        {{ Form::label('intelligence', 'Intelligence') }}
        {{ Form::number('intelligence', 0) }}
    </div>

    <div class="twelve wide field">
        {{ Form::label('wisdom', 'Wisdom') }}
        {{ Form::number('wisdom', 0) }}
    </div>

    <div class="twelve wide field">
        {{ Form::label('charisma', 'Charisma') }}
        {{ Form::number('charisma', 0) }}
    </div>
</div>