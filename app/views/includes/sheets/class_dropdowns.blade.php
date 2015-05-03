<div class="ui form" id="class_dropdowns">
    <div class="three fields">
        <div class="field">
            {{ Form::label('class', 'Class') }}
            {{ Form::select('class', $class_dropdown, $sheet->charactergeneral->class, array('class' => 'ui dropdown'))}}
        </div>
        <div class="field">
            {{ Form::label('level', 'Level') }}
            {{ Form::number('level', $sheet->charactergeneral->level) }}
        </div>
        <div class="field">
            {{ Form::label('background', 'Background') }}
            {{ Form::select('background', $background_dropdown, $sheet->charactergeneral->background, array('class' => 'ui dropdown')) }}
        </div>
    </div>
    <div class="three fields">
        <div class="field">
            {{ Form::label('race', 'Race') }}
            {{ Form::select('race', $race_dropdown, $sheet->charactergeneral->race, array('class' => 'ui dropdown')) }}
        </div>
        <div class="field">
            {{ Form::label('alignment', 'Alignment') }}
            {{ Form::select('alignment', $alignment_dropdown, $sheet->charactergeneral->alignment, array('class' => 'ui dropdown')) }}
        </div>
        <div class="field">
            {{ Form::label('xp', 'XP') }}
            {{ Form::number('xp', $sheet->charactergeneral->xp) }}
        </div>
    </div>
</div>

@section('inline-js')
    <script type="text/javascript">
        $('select.dropdown').dropdown();

        var classFunction = function()
        {
            var params = {
                'field' : $(this).attr('name'),
                'value' : $(this).val(),
                'sheet' : "{{ $sheet->id }}"
            };

            $.ajax({
                type : "PATCH",
                data : params,
                url : "{{ url('character/patchClassAttr') }}" + "/" + params['field'],
                success : function(data){
                    if(params['field'] == 'level') {
                        $("#proficiency_bonus").val(1 + Math.ceil(params['value']/4));
                    }
                }
            });
        }

        $(document).on("change", "#class_dropdowns select", classFunction);
        $("#class_dropdowns input[type=number]").bind("input", classFunction);
    </script>
@append