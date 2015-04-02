<div class="ui raised red segment">
    <h2 class="ui red header">Saving Throws</h2>
        <div class="ui segment">
            <div class="ui toggle checkbox">
                {{ Form::checkbox('strength_throw', 'strength_throw') }}
                {{ Form::label('strength_throw', 'Strength') }}
            </div>
            <div class="ui divider"></div>
            <div class="ui toggle checkbox">
                {{ Form::checkbox('dexterity_throw', 'dexterity_throw') }}
                {{ Form::label('dexterity_throw', 'Dexterity') }}
            </div>
            <div class="ui divider"></div>
            <div class="ui toggle checkbox">
                {{ Form::checkbox('const_throw', 'const_throw') }}
                {{ Form::label('const_throw', 'Constitution') }}
            </div>
            <div class="ui divider"></div>
            <div class="ui toggle checkbox">
                {{ Form::checkbox('int_throw', 'int_throw') }}
                {{ Form::label('int_throw', 'Intelligence') }}
            </div>
            <div class="ui divider"></div>
            <div class="ui toggle checkbox">
                {{ Form::checkbox('wisdom_throw', 'wisdom_throw') }}
                {{ Form::label('wisdom_throw', 'Wisdom') }}
            </div>
            <div class="ui divider"></div>
            <div class="ui toggle checkbox">
                {{ Form::checkbox('charisma_throw', 'charisma_throw') }}
                {{ Form::label('charisma_throw', 'Charisma') }}
            </div>
        </div>
</div>

@section('inline-js')
    <script type="text/javascript">
        $('.ui.checkbox').checkbox();
    </script>
@append