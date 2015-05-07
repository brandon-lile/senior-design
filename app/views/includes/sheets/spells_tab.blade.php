<div class="ui tab" data-tab="spells">

    <div class="row">
        <div class="ui sixteen wide column">
            <div class="ui center aligned divided grid">
                <div class="equal height row">
                    <div class="sixteen wide column">
                        <div class="ui blue raised segment">
                            <h2 class="ui blue header">Spell Information</h2>
                            <div class="ui form">
                                <div class="fields">
                                    <div class="four wide field">
                                        {{ Form::label('spell_class', 'Spell Casting Class') }}
                                        {{ Form::text('spell_class', $class_dropdown[$sheet->charactergeneral->class], array('disabled'))}}
                                    </div>
                                    <div class="four wide field">
                                        {{ Form::label('spell_ability', 'Spell Casting Ability') }}
                                        {{ Form::text('spell_ability', $ability_ids[$sheet->charactergeneral->spellclass->ability], array('disabled')) }}
                                    </div>
                                    <div class="four wide field">
                                        {{ Form::label('spell_save', 'Spell Save DC') }}
                                        {{ Form::text('spell_save', $spell_save, array('disabled')) }}
                                    </div>
                                    <div class="four wide field">
                                        {{ Form::label('spell_bonus', 'Spell Attack Bonus') }}
                                        {{ Form::number('spell_bonus', $spell_save - 8, array('disabled')) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ui segment">
        <div class="ui active inverted dimmer" id="spells_dimmer">
            <div class="ui active text loader">Loading Spells</div>
        </div>
        <div class="row">
            <div class="ui sixteen wide column">
                <div class="ui center aligned divided grid">
                    <div class="equal height row" id="spells_container">
                        <div class="five wide column" id="first_column">

                        </div>

                        <div class="five wide column" id="second_column">

                        </div>

                        <div class="five wide column" id="third_column">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('inline-js')
    <script type="text/javascript">

        var updateSpell = function updateSpell()
        {
            var spell_id = $(this).attr('id');
            spell_id = spell_id.substr(spell_id.indexOf("_") + 1);
            var params = {
                'spell' : spell_id,
                'sheet' : "{{ $sheet->id }}"
            };

            $.ajax({
                type : "POST",
                data : params,
                url : "{{ action('User\CharacterController@postSpell') }}",
                success : function(data) {
                    console.log(data);
                }
            });
        };

        var save_level_used = debounce(function()
        {
            var level_id = $(this).attr("id");
            level_id = level_id.substr(level_id.indexOf("_") + 1);
            var params = {
                'sheet' : "{{ $sheet->id }}",
                'level' : level_id,
                'value' : $(this).val()
            };

            $.ajax({
                type : "PATCH",
                data : params,
                url : "{{ action('User\CharacterController@patchLevels') }}",
                success : function(data)
                {

                }
            });
        }, 150);

        $(document).on("change", "#num_data .level-used", save_level_used);

        $(document).on("ready", function()
        {
            var output_spells = function(spells, level_total)
            {
                for (level = 1; level <= 9; level++) {
                    var spell_layout = '<div class="ui raised red segment"><h3 class="ui red header">Level: ' + level + '</h3>Slots Expended**slots_expended**<div class="ui segment equipment-list">' +
                            '<div class="ui divided list">**inner_spell**</div></div></div>';

                    // Slots Expended
                    var spells_slots = '<div class="ui right labeled icon input" id="num_data">' +
                            '<input type="number" class="slot_num_available" id="slots_level_' + level + '" value="**level_used**">' +
                            '<input type="number" class="level-used" id="level_' + level + '" value="' + level_total[level] + '" placeholder="Total">' +
                            '</div>';

                    // Spells
                    var spells_content = '';
                    if(spells.hasOwnProperty(level)) {
                        for(i = 0; i < spells[level].count; i++) {
                            spells_content += '<div class="item">' +
                            '<div class="right floated compact mini red ui button"  onclick="show_desc(this)">Desc</div>' +
                            '<div class="content">' +
                            '<div class="header"><div class="ui checkbox"><input type="checkbox" id="spell_' + spells[level][i]['id'] + '"><label>' + spells[level][i]['name'] + '</label></div></div>' +
                            '<div class="hidden cant_desc">' + spells[level][i]['desc'] + '</div>' +
                            '</div>' +
                            '</div>';
                        }
                        spells_slots = spells_slots.replace("**level_used**", spells[level]['used']);
                    }
                    else
                    {
                        spells_slots = spells_slots.replace("**level_used**", 0);
                    }

                    spell_layout = spell_layout.replace("**slots_expended**", spells_slots);
                    spell_layout = spell_layout.replace("**inner_spell**", spells_content);

                    if(level == 1 || level == 2){
                        $("#first_column").append(spell_layout);
                    } else if (level > 2 && level < 6) {
                        $("#second_column").append(spell_layout);
                    } else {
                        $("#third_column").append(spell_layout);
                    }
                }
            };

            var output_cantrips = function(cantrips)
            {
                var cantrips_layout = '<div class="ui raised red segment"><h3 class="ui red header">Cantrips</h3><div class="ui segment equipment-list">' +
                        '<div class="ui divided list">**inner_cantrips**</div></div></div>';
                var inner_cantrips = '';
                for(i = 0; i < cantrips.count; i++) {
                    inner_cantrips += '<div class="item">' +
                    '<div class="right floated compact mini red ui button" onclick="show_desc(this)">Desc</div>' +
                    '<div class="content">' +
                    '<div class="header">' + cantrips[i]['name'] + '</div>' +
                    '<div class="hidden cant_desc">' + cantrips[i]['desc'] + '</div>' +
                    '</div>' +
                    '</div>';
                }

                cantrips_layout = cantrips_layout.replace("**inner_cantrips**", inner_cantrips);
                $("#first_column").append(cantrips_layout);
            };

            var activate_spells = function(used)
            {
                $.each(used, function(index, value)
                {
                    $("#spell_" + value).parent().checkbox('check');
                });

                $("#spells_container .ui.checkbox").checkbox({
                    onChange : updateSpell
                });
            };

            $("#spells_dimmer").dimmer('show');
            $.ajax({
                type : "GET",
                url : "{{ action('User\CharacterController@getSpells', $sheet->id) }}",
                success : function(data) {

                    // Start the output
                    output_cantrips(data.cantrips);
                    output_spells(data.spells, data.level_used);

                    // Set some options
                    $(".slots_num_available").disabled = true;

                    // Activate checkboxes
                    activate_spells(data.used);

                    // Show it to the world
                    $("#spells_dimmer").dimmer('hide');
                }
            });
        });


        function show_desc(btn)
        {
            var div = $(btn).parent();
            if($('.cant_desc', div).hasClass('hidden')) {
                $('.cant_desc', div.parent()).addClass('hidden');
                $('.cant_desc', div).removeClass('hidden');
            } else {
                $('.cant_desc', div).addClass('hidden');
            }
        };
    </script>
@append

@section('inline-css')
    <style type="text/css">
        .hidden {
            display: none;
        }
        .level-used {
            border-right: 1px solid rgba(0,0,0,.15) !important;
        }
    </style>
@append