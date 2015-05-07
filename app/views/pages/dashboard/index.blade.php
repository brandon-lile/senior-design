@section('content')
    <div class="ui stackable grid">
        <div class="two column row">
            <div class="column">
                <div class="ui blue segment">
                    <h2 class="ui blue dividing header">Managed Campaign</h2>
                    @if (isset($owned_campaigns) && count($owned_campaigns) > 0)
                        <div class="ui divided list selection item-container">
                            @foreach ($owned_campaigns as $campaign)
                                <a class="item" href="{{ url('campaign/' . $campaign->id) }}">
                                    <div class="content">
                                        {{ $campaign->campaign_name }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="ui blue message">You currently do not manage any campaigns. Click the button below to start one.</div>
                    @endif

                    <h2 class="ui blue dividing header">Campaigns</h2>
                    @if (isset($campaigns) && count($campaigns) > 0)
                        <div class="ui divided list selection item-container">
                            @foreach($campaigns as $campaign)
                                <a class="item" href="{{ url('campaign/' . $campaign->campaign->id) }}">
                                    <div class="content">
                                        {{ $campaign->campaign->campaign_name . " - " . $campaign->charactersheet->charactergeneral->char_name }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="ui blue message">You currently are not involved in any campaigns. Get a DM to invite you!</div>
                    @endif
                    <div class="ui divider"></div>
                    <button class="ui blue button" id="add_campaign">Create Campaign</button>
                </div>
            </div>
            <div class="column">
                <div class="ui green segment">
                    <h2 class="ui green dividing header">Character Sheets</h2>
                    @if (isset($sheets) && count($sheets) > 0)
                        <div class="ui divided list selection item-container sheets-container">
                            @foreach ($sheets as $sheet)
                                <a class="item" href="{{ url('character/' . $sheet->id) }}">
                                    <div class="content">
                                        {{ $sheet->charactergeneral->char_name }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="ui green message">You currently do not have any character sheets. Create one to get started!</div>
                    @endif
                    <div class="ui divider"></div>
                    <button class="ui green button" id="add_character">Create Character Sheet</button>
                </div>
            </div>
        </div>
        <div class="two column row">
            <div class="column">
                @include('includes.dashboard.pending')
            </div>
            <div column="column">

            </div>
        </div>
    </div>
    @include('includes.modals.campaign.add')
    @include('includes.modals.character.add')
@stop

@section('inline-js')
    <script type="text/javascript">
        $(document).on('click', "#add_campaign", function(){
            $("#add_campaign_modal").modal('show');
        }).on('click', "#add_character", function(){
            $("#add_character_modal").modal('show');
        });
    </script>
@append

@section('inline-css')
    <style type="text/css">
        .item-container {
            max-height: 180px;
            overflow-y: scroll;
        }
    </style>
@append