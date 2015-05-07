<div class="ui raised red segment">
    <h3 class="ui red header">Treasure</h3>
    <div class="ui segment treasure-list">
        <div class="ui divided list" id="treasure-items">
            @forelse($sheet->treasure as $treasure)
                <div class="item">
                    <div class="right floated compact mini red ui button delete" id="treasure_{{ $treasure->id }}">Delete</div>
                    <div class="content">
                        <div class="header">{{ $treasure->name }}</div>
                        <p>{{ $treasure->description }}
                            <br />
                            <strong>Qty: </strong>{{$treasure->quantity}}
                        </p>
                    </div>
                </div>
            @empty
                <div class="ui blue message">
                    You currently do not have any treasures.
                </div>
            @endforelse
        </div>
    </div>
    <div class="ui form">
        <div class="ui action input" id="equipment_container">
            {{ Form::text('treasure', '', array('placeholder' => 'Treasure Name', 'id' => 'treasure')) }}
            {{ Form::number('treasure_qty', '', array('placeholder' => 'Qty', 'id' => 'treasure_qty')) }}
            <button class="ui icon red button" id="treasure_add">
                <i class="plus icon"></i>
            </button>
        </div>
        <br /><br />
        <div class="fields">
            {{ Form::textarea('treasure_desc', "", array('placeholder' => 'Treasure Description', 'id' => 'treasure_desc')) }}
        </div>
    </div>
</div>

@section('inline-js')
    <script type="text/javascript">
        var num_treasure = {{ $sheet->treasure->count() }};

        var add_treasure = function(data, append) {
            var treasure_item = '<div class="item"><div class="right floated compact mini red ui button delete" id="treasure_*id*">Delete</div>' +
            '<div class="content"><div class="header">*name*</div><p>*desc*<br /><strong>Qty: </strong>*qty*</p></div></div>';

            treasure_item = treasure_item.replace("*id*", data.id);
            treasure_item = treasure_item.replace("*name*", data.name);
            treasure_item = treasure_item.replace("*desc*", data.description);
            treasure_item = treasure_item.replace("*qty*", data.quantity);

            if(append == true) {
                $("#treasure-items").append(treasure_item);
            } else {
                $("#treasure-items").html(treasure_item);
            }
        };

        var clear_treasure_fields = function() {
            $("#treasure").val("");
            $("#treasure_qty").val("");
            $("#treasure_desc").val("");
        };

        $("#treasure_add").on("click", function()
        {
            var params = {
                'sheet' : "{{ $sheet->id }}",
                'name' : $("input[name=treasure]").val(),
                'desc' : $("#treasure_desc").val(),
                'qty' : $("#treasure_qty").val()
            };

            $.ajax({
                url : "{{ action('User\CharacterController@postTreasure') }}",
                type : "POST",
                data : params,
                success : function(data) {
                    if(parseInt(num_treasure) == 0) {
                        add_treasure(data, false);
                        num_treasure++;
                    } else {
                        add_treasure(data, true);
                    }
                    clear_treasure_fields();
                }
            });
        });

        $("#treasure-items").on("click", ".delete", function()
        {
            var treasure_id = $(this).attr('id');
            treasure_id = treasure_id.substr(treasure_id.indexOf("_") + 1);
            var params = {
                'sheet' : "{{ $sheet->id }}",
                'treasure' : treasure_id
            };

            $.ajax({
                type : "DELETE",
                data : params,
                url : "{{ action('User\CharacterController@deleteTreasure') }}",
                success : function() {
                    num_treasure--;
                    $("#treasure_" + params['treasure']).parent().remove();
                    if(num_treasure == 0) {
                        $("#treasure-items").html('<div class="ui blue message">You currently do not have any treasures.</div>');
                    }
                }
            });
        });
    </script>
@append

@section('inline-js')
    <style type="text/css">
        .treasure-list {
            max-height: 250px;
            overflow-y: scroll;
        }
        #treasure_desc {
            max-height: 50px;
        }
    </style>
@append