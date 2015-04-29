<div class="ui modal" id="add_character_modal">
    <i class="close icon"></i>
    <div class="header">Add Character Sheet</div>
    <div class="content">
        {{ Form::open(array('url' => action('User\DashboardController@postCreateCharacter'), 'class' => 'ui form')) }}
            <div class="field">
                {{ Form::label('name', 'Character Name') }}
                {{ Form::text('name', '', array('id' => 'name', 'placeholder' => 'Character Name')) }}
            </div>
            <div class="field">
                {{ Form::label('class', 'Class') }}
                {{ Form::select('class', $class_dropdown, '', array('id' => 'class')) }}
            </div>
            <div class="field">
                {{ Form::label('level', 'Level') }}
                {{ Form::number('level', '', array('id' => 'level')) }}
            </div>
            <div class="field">
                {{ Form::label('race', 'Race') }}
                {{ Form::select('race', $race_dropdown, '', array('id' => 'race')) }}
            </div>
            <div class="field">
                {{ Form::label('alignment', 'Alignment') }}
                {{ Form::select('alignment', $alignment_dropdown, '', array('id' => 'alignment')) }}
            </div>
            <div class="field">
                {{ Form::label('background', 'Background') }}
                {{ Form::select('background', $background_dropdown, '', array('id' => 'background')) }}
            </div>
            <div class="field">
                {{ Form::label('xp', 'XP') }}
                {{ Form::number('xp', '', array('id' => 'xp')) }}
            </div>
            {{ Form::submit('Create Character', array('class' => 'ui green submit button')) }}
        {{ Form::close() }}
    </div>
</div>