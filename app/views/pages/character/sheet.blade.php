@section('content')
    <h1 class="ui red header">Pyro's Character Sheet - Jocelyn</h1>

    <div class="ui divider"></div>

    <div class="ui divided equal height row">
        <div class="four wide column">
            <div class="ui segment">
                <img src="{{ asset('images/dnd_character.jpg') }}" class="ui centered rounded image">
                <div class="ui mini buttons pic-ops">
                    <div class="ui blue button">Edit</div>
                    <div class="or"></div>
                    <div class="ui red button">Delete</div>
                </div>
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

@stop

@section('inline-js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.tabular.menu .item').tab({history:false});
        });
    </script>
@append