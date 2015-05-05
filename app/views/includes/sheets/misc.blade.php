<div class="ui green raised segment" id="misc">
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

@section('inline-js')
    <script type="text/javascript">

    </script>
@append