<div class="ui raised red segment">
    <h3 class="ui red header">Treasure</h3>
    <div class="ui segment equipment-list">
        <div class="ui divided list">
            <div class="item">
                <div class="right floated compact mini red ui button">Delete</div>
                <div class="content">
                    <div class="header">Crystal</div>
                </div>
            </div>
            <div class="item">
                <div class="right floated compact mini red ui button">Delete</div>
                <div class="content">
                    <div class="header">Healing Potion</div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('inline-js')
    <style type="text/css">
        .equipment-list {
            max-height: 250px;
            overflow-y: scroll;
        }
    </style>
@append