<div class="ui blue raised segment" id="skills">
    <h2 class="ui blue header">Skills</h2>
    <div class="ui two column grid">
        <div class="column">
            @for ($i = 0; $i < 18; $i++)
                @if ($i == 9)
                    </div>
                    <div class="column">
                @endif

                <div class="ui dropdown" id="{{ strtolower(str_replace(" ", "", $skills_output[$i]['skill'])) }}_dropdown">
                    <input type="hidden" value="{{ $skills_choices[$sheet->skill->skills[$i]] }}">
                    <div class="text">{{ $skills_choices[$sheet->skill->skills[$i]] }}</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <div class="item" data-value="0">-</div>
                        <div class="item" data-value="1">P</div>
                        <div class="item" data-value="2">E</div>
                    </div>
                </div>

                {{ Form::label(strtolower(str_replace(" ", "", $skills_output[$i]['skill'])) . "_dropdown", $skills_output[$i]['skill'] . " (" . substr($ability_ids[$skills_output[$i]['ability']], 0, 3) . ")") }}
                <div class="ui divider"></div>
            @endfor
        </div>
    </div>
</div>


@section('inline-js')
    <script type="text/javascript">
        $('#skills .ui.dropdown')
                .dropdown({
                    onChange : function(value, text, item) {
                        var skill = $(item).parent().parent().attr('id');
                        var params = {
                            'sheet' : "{{ $sheet->id }}",
                            'skill' : skill.substr(0, skill.indexOf("_")),
                            'value' : value
                        };

                        if (params['value'] != undefined){
                            $.ajax({
                                type : "PATCH",
                                data : params,
                                url : "{{ action('User\CharacterController@patchSkills') }}",
                                success : function(data) {

                                }
                            });
                        }
                    }
                })
        ;
    </script>
@append

