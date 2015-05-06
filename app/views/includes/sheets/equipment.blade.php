<div class="ui raised red segment">
    <h3 class="ui red header">Equipment</h3>
    <div class="ui segment equipment-list">
        <div class="ui divided list" id="equipment_list">
            @forelse($sheet->equipment as $equipment)
                <div class="item">
                    <div class="right floated compact mini red ui button delete" id="equipment_{{ $equipment->id }}">Delete</div>
                    <div class="content">
                        <div class="header">{{ $equipment->name }}</div>
                    </div>
                </div>
            @empty
                <div class="ui blue message">
                    You currently do not have any equipment.
                </div>
            @endforelse
        </div>
    </div>
    <div class="ui action input" id="equipment_container">
        {{ Form::text('equipment', '', array('placeholder' => 'Add Equipment', 'id' => 'equipment')) }}
        <button class="ui icon red button" id="equipment_add">
            <i class="plus icon"></i>
        </button>
    </div>
</div>

@section('inline-js')
    <script type="text/javascript">
        var num_equipment = "{{ $sheet->equipment->count() }}";
        $("#equipment_add").on('click', function()
        {
            var params = {
                'sheet' : "{{ $sheet->id }}",
                'equipment' : $("input[name=equipment]").val()
            };

            $.ajax({
                type : "POST",
                data : params,
                url : "{{ action('User\CharacterController@postEquipment') }}",
                success : function(data) {
                    if(parseInt(num_equipment) == 0) {
                        $("#equipment_list").html(
                                "<div class=\"item\">" +
                                    "<div class=\"right floated compact mini red ui button delete\" id=\"equipment_" + data.id + "\">Delete</div>" +
                                    "<div class=\"content\">" +
                                        "<div class=\"header\">" + data.name + "</div>" +
                                    "</div>" +
                                "</div>");
                        num_equipment++;
                    } else {
                        $("#equipment_list").append(
                                "<div class=\"item\">" +
                                    "<div class=\"right floated compact mini red ui button delete\" id=\"equipment_" + data.id + "\">Delete</div>" +
                                    "<div class=\"content\">" +
                                        "<div class=\"header\">" + data.name + "</div>" +
                                    "</div>" +
                                "</div>");
                    }

                    $("input[name=equipment]").val("");
                }
            });
        });

        $("#equipment_list").on("click", ".delete", function()
        {
            var equip_id = $(this).attr("id");
            equip_id = equip_id.substr(equip_id.indexOf("_") + 1);
            var params = {
                'equip_id' : equip_id,
                'sheet' : "{{ $sheet->id }}"
            };

            $.ajax({
                type : "DELETE",
                data : params,
                url : "{{ action('User\CharacterController@deleteEquipment') }}",
                success : function(data) {
                    num_equipment--;
                    $("#equipment_" + equip_id).parent().remove();
                    if(num_equipment == 0) {
                        $("#equipment_list").html('<div class="ui blue message">You currently do not have any equipment.</div>');
                    }
                }
            });
        });
    </script>
@append

@section('inline-css')
    <style type="text/css">
        #equipment_container {
            width:100%;
        }
        .equipment-list {
            max-height: 250px;
            overflow-y: scroll;
        }
    </style>
@append