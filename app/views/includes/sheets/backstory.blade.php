<div class="ui green raised segment">
    <h2 class="ui header">Character Information</h2>
        <div class="ui form">
            <div class="fields">
                <div class="five wide field">
                    {{ Form::label('age', 'Age') }}
                    {{ Form::number('age',0) }}
                </div>
                <div class="five wide field">
                    {{ Form::label('height', 'Height') }}
                    {{ Form::number('height',0) }}
                </div>
                <div class="five wide field">
                    {{ Form::label('weight', 'Weight') }}
                    {{ Form::number('weight',0) }}
                </div>
            </div>

            <div class="fields">
                <div class="five wide field">
                    {{ Form::label('eyes', 'Eyes') }}
                    {{ Form::text('eyes') }}
                </div>
                <div class="five wide field">
                    {{ Form::label('skin', 'Skin') }}
                    {{ Form::text('skin') }}
                </div>
                <div class="five wide field">
                    {{ Form::label('hair', 'Hair') }}
                    {{ Form::text('hair') }}
                </div>
            </div>

        </div>
        <div class="ui form">
            <div class="field">
                {{ Form::label('backstory', 'Character Backstory') }}
                {{ Form::textarea('backstory') }}
            </div>
        </div>
</div>


