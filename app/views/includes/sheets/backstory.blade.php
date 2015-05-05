<div class="ui green raised segment" id="char_info">
    <h2 class="ui header">Character Information</h2>
        <div class="ui form">
            <div class="fields">
                <div class="five wide field">
                    {{ Form::label('age', 'Age') }}
                    {{ Form::number('age', $sheet->charactergeneral->age) }}
                </div>
                <div class="five wide field">
                    {{ Form::label('height', 'Height') }}
                    {{ Form::number('height',$sheet->charactergeneral->height) }}
                </div>
                <div class="five wide field">
                    {{ Form::label('weight', 'Weight') }}
                    {{ Form::number('weight', $sheet->charactergeneral->weight) }}
                </div>
            </div>

            <div class="fields">
                <div class="five wide field">
                    {{ Form::label('eyes', 'Eyes') }}
                    {{ Form::text('eyes', $sheet->charactergeneral->eyes) }}
                </div>
                <div class="five wide field">
                    {{ Form::label('skin', 'Skin') }}
                    {{ Form::text('skin', $sheet->charactergeneral->skin) }}
                </div>
                <div class="five wide field">
                    {{ Form::label('hair', 'Hair') }}
                    {{ Form::text('hair', $sheet->charactergeneral->hair) }}
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

@section('inline-js')
    <script type="text/javascript">

        var save_info = debounce(function()
            {
                var params = {
                    'field' : $(this).attr('name'),
                    'value' : $(this).val(),
                    'sheet' : "{{ $sheet->id }}"
                };

                console.log(params);
                $.ajax({
                    type : "PATCH",
                    data : params,
                    url : "{{ action('User\CharacterController@patchInfo') }}",
                    success : function(data) {

                    }
                });
            }, 250);
            
        $("#char_info input").on("change", save_info);
    </script>
@append

