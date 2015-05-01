<div class="ui form">
    <div class="three fields">
        <div class="field">
            {{ Form::label('class', 'Class') }}
            {{ Form::select('class', $class_dropdown, 0, array('class' => 'ui dropdown'))}}
        </div>
        <div class="field">
            {{ Form::label('level', 'Level') }}
            {{ Form::number('level', 0) }}
        </div>
        <div class="field">
            {{ Form::label('background', 'Background') }}
            {{ Form::select('background', $background_dropdown, 0, array('class' => 'ui dropdown')) }}
        </div>
    </div>
    <div class="three fields">
        <div class="field">
            {{ Form::label('race', 'Race') }}
            {{ Form::select('race', $race_dropdown, 0, array('class' => 'ui dropdown')) }}
        </div>
        <div class="field">
            {{ Form::label('alignment', 'Alignment') }}
            {{ Form::select('alignment', $alignment_dropdown, 0, array('class' => 'ui dropdown')) }}
        </div>
        <div class="field">
            {{ Form::label('xp', 'XP') }}
            {{ Form::number('xp', 0) }}
        </div>
    </div>
</div>

@section('inline-js')
    <script type="text/javascript">
        $('select.dropdown').dropdown();
    </script>
@append