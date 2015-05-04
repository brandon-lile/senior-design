<div class="ui raised red segment">
    <h3 class="ui red header">Treasure</h3>
    <div class="ui segment treasure-list">
        <div class="ui divided list">
            @forelse($sheet->treasure as $treasure)
                <div class="item">
                    <div class="right floated compact mini red ui button">Delete</div>
                    <div class="content">
                        <div class="header">{{$treasure->name}}</div>
                    </div>
                </div>
            @empty
                <div class ="ui blue message">
                    You currently do not have any treasure.

                </div>
        </div>
        @endforelse
    </div>
</div>
<div class="ui action input" id="treasure_container"
    {{ Form::text('treasure', '', array('placeholder' => 'Add Treasure', 'id' => 'treasure')) }}
    <button class="ui icon red button" id="treasure_add">
        <i class="plus icon"></i>
    </button>
</div>

@section('inline-js')
    <script type="text/javascript">
        $("#treasure_add").on('click', function()
        {
            var num_treasure = "{{ $sheet->treasure->count() }}";
            var params = {
                'sheet' : "{{ $sheet->id }}",
                'treasure' : $("input[name=treasure]").val()
            };

            $.ajax({
                type : "POST",
                data : params,
                url : "{{ action('User\CharacterController@postTreasure') }}",
                success : function(data) {
                    if(parseInt(num_treasure) == 0) {
                        $("#treasure_list").html(
                                "<div class=\"item\">" +
                                "<div class=\"right floated compact mini red ui button\" id=\"treasure_" + data.id + "\">Delete</div>" +
                                "<div class=\"content\">" +
                                "<div class=\"header\">" + data.name + "</div>" +
                                "</div>" +
                                "</div>");
                    } else {
                        $("#treasure_list").append(
                                "<div class=\"item\">" +
                                "<div class=\"right floated compact mini red ui button\" id=\"treasure_" + data.id + "\">Delete</div>" +
                                "<div class=\"content\">" +
                                "<div class=\"header\">" + data.name + "</div>" +
                                "</div>" +
                                "</div>");
                    }

                    $("input[name=treasure]").val("");
                }
            });
        });

        $("#treasure_list .delete").on("click", function()
        {
            var treasure_id = $(this).attr("id");
            treasure_id = treasure_id.substr(treasure_id.indexOf("_") + 1);
            var params = {
                'treasure_id' : treasure_id,
                'sheet' : "{{ $sheet->id }}"
            };

            $.ajax({
                type : "DELETE",
                data : params,
                url : "{{ action('User\CharacterController@deleteTreasure') }}",
                success : function(data) {
                    $("#treasure_" + treasure_id).parent().remove();
                }
            });
        });
    </script>
@append

@section('inline-js')
    <style type="text/css">
        #treasure_container {
            width:100%;
        }
        .treasure-list {
            max-height: 250px;
            overflow-y: scroll;
        }
    </style>
@append