@section('content')
    <h1 class="ui red header">Pyro's Character Sheet - Jocelyn</h1>

    <div class="ui divider"></div>

    <div class="ui divided equal height row">
        <div class="four wide column">
            <div class="ui segment">
                <img src="{{ $sheet->char_pic }}" class="ui centered rounded image avatar-image">
                @if ($sheet->char_pic != asset('images/avatar/stock.png'))
                    <div class="ui mini buttons pic-ops">
                        <div class="ui blue button" id="edit_avatar">Edit</div>
                        <div class="or"></div>
                        <a class="ui red button" href="{{ action('User\CharacterController@deleteAvatar', $sheet->id) }}">Delete</a>
                    </div>
                @else
                    <button class="ui blue button" id="add_avatar">Add avatar</button>
                @endif
            </div>
        </div>
        <div class="twelve wide column">
            @include('includes.sheets.class_dropdowns')
        </div>

    </div>

    <div class="ui divider"></div>

    <div class="ui tabular menu">
        <div class="active item" data-tab="stats">Stats</div>
        <div class="item" data-tab="information">Information</div>
        <div class="item" data-tab="spells">Spells</div>
    </div>

    @include('includes.sheets.stats_tab')
    @include('includes.sheets.information_tab')
    @include('includes.sheets.spells_tab')

    @include('includes.modals.character.avatar')

@stop

@section('inline-js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.tabular.menu .item').tab({history:false});
            $("#add_avatar").on("click", function()
            {
                $("#add_avatar_modal").modal('show');
            });
            $("#edit_avatar").on("click", function()
            {
                $("#add_avatar_modal").modal('show');
            });
        });
    </script>
@append