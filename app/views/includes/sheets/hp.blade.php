<div class="ui form" id="char_hp">
    <div class="fields">
        <div class="six wide field">
            {{ Form::label('ac', 'Armor Class') }}
            {{ Form::number('armor_class', $sheet->armor_class, array('id' => 'hp_armor_class')) }}
        </div>
        <div class="five wide field">
            {{ Form::label('initiative', 'Initiative') }}
            {{ Form::number('initiative', $sheet->initiative, array('id' => 'hp_initiative')) }}
        </div>
        <div class="five wide field">
            {{ Form::label('speed', 'Speed') }}
            {{ Form::number('speed', $sheet->speed, array('id' => 'hp_speed')) }}
        </div>
    </div>
    <div class="two fields">
        <div class="field">
            <div class="ui mini left labeled input">
                <div class="ui green label">
                    {{ Form::label('max_hp', 'Max HP') }}
                </div>
                {{ Form::number('max', $sheet->characterhp->max, array('id' => 'hp_max')) }}
            </div>
        </div>
        <div class="field">
            <div class="ui mini left labeled input">
                <div class="ui green label">
                    {{ Form::label('cur_hp', 'Cur HP') }}
                </div>
                {{ Form::number('current', $sheet->characterhp->current, array('id' => 'hp_current')) }}
            </div>
        </div>
    </div>
    <div class="divider"></div>
    <h3 class="ui header">Death Saves</h3>
    <div class="inline fields" id="save_successes">
        <label for="save_successes">Successes</label>
        <div class="field">
            <input type="checkbox" class="ui checkbox">
        </div>
        <div class="field">
            <input type="checkbox" class="ui checkbox">
        </div>
        <div class="field">
            <input type="checkbox" class="ui checkbox">
        </div>
    </div>
    <div class="inline fields" id="save_failures">
        <label for="save_successes">Failures</label>
        <div class="field">
            <input type="checkbox" class="ui checkbox">
        </div>
        <div class="field">
            <input type="checkbox" class="ui checkbox">
        </div>
        <div class="field">
            <input type="checkbox" class="ui checkbox">
        </div>
    </div>
</div>

@section('inline-js')
    <script type="text/javascript">
        $("#save_successes .checkbox").checkbox();
        $("#char_hp").on("change", "input[type=number]", function()
        {
            var params = {
                'field' : $(this).attr('name'),
                'value' : $(this).val(),
                'sheet' : "{{ $sheet->id }}"
            };

            $.ajax({
                type : "PATCH",
                data : params,
                url : "{{ action('User\CharacterController@patchHP'); }}",
                success : function(data) {

                }
            });
        });
    </script>
@append