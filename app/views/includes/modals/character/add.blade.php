<div class="ui modal" id="add_character_modal">
    <i class="close icon"></i>
    <div class="header">Add Character Sheet</div>
    <div class="content">
        @if ($errors->character->all() != false)
            <div class="ui column sixteen wide red message">
                <i class="close icon"></i>

                <div class="header">
                    The following errors were encountered:
                </div>

                <ul class="ui list">
                    @foreach ($errors->character->all('<li>:message</li>') as $message)
                        {{ $message }}
                    @endforeach
                </ul>
            </div>
        @endif
        {{ Form::open(array('url' => action('User\DashboardController@postCreateCharacter'), 'class' => 'ui form')) }}
            <div class="field">
                {{ Form::label('name', 'Character Name') }}
                {{ Form::text('name', Input::old('name'), array('id' => 'name', 'placeholder' => 'Character Name')) }}
            </div>
            <div class="field">
                {{ Form::label('class', 'Class') }}
                {{ Form::select('class', $class_dropdown, Input::old('class'), array('id' => 'class')) }}
            </div>
            <div class="field">
                {{ Form::label('level', 'Level') }}
                {{ Form::number('level', Input::old('level'), array('id' => 'level')) }}
            </div>
            <div class="field">
                {{ Form::label('race', 'Race') }}
                {{ Form::select('race', $race_dropdown, Input::old('race'), array('id' => 'race')) }}
            </div>
            <div class="field">
                {{ Form::label('alignment', 'Alignment') }}
                {{ Form::select('alignment', $alignment_dropdown, Input::old('alignment'), array('id' => 'alignment')) }}
            </div>
            <div class="field">
                {{ Form::label('background', 'Background') }}
                {{ Form::select('background', $background_dropdown, Input::old('background'), array('id' => 'background')) }}
            </div>
            <div class="field">
                {{ Form::label('xp', 'XP') }}
                {{ Form::number('xp', Input::old('xp'), array('id' => 'xp')) }}
            </div>
            {{ Form::submit('Create Character', array('class' => 'ui green submit button')) }}
        {{ Form::close() }}
    </div>
</div>

@section('inline-js')
    @if ($errors->character->all() != false)
        <script type="text/javascript">
            $("#add_character_modal").modal('show');
        </script>
    @endif
@append