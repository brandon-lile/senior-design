@section('content')
    <h1 class="ui dividing header">
        {{ $campaign->campaign_name }}
        @if ($campaign->dm_id == $user->id)
            <a href="{{ action('User\CampaignController@deleteCampaign', $campaign->id) }}" class="ui right floated blue button mini delete-button">Delete</a>
        @endif
    </h1>

    <!-- General Info -->
    <div class="eight wide column">
        <div class="ui top attached tabular menu">
            <a class="active item" data-tab="diary">Diary</a>
            <a class="item" data-tab="pictures">Pictures</a>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="diary">
            <div class="ui segment camp_diary">
                @if(count($campaign->diaryentry) > 0)
                    <div class="ui divided list">
                        @foreach($campaign->diaryentry as $entry)
                            <div class="item">
                                <div class="header">{{ date("m/d/Y", strtotime($entry->created_at)) . " - " . $entry->title }}</div>
                                <p>{{ $entry->entry }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="ui blue message">There are currently no diary entries. Add one below!</div>
                @endif
            </div>
            @if ($is_dm)
                {{ Form::open(array('url' => action('User\CampaignController@postEntry'), 'class' => 'ui form')) }}
                    {{ Form::hidden('camp', $campaign->id) }}
                    <div class="field">
                        <div class="ui fluid action input">
                            {{ Form::text('title', '', array('placeholder' => 'Entry Title')) }}
                            <button class="ui green submit button">Save</button>
                        </div>
                    </div>
                    <div class="field">
                        {{ Form::textarea('entry', '', array('placeholder' => 'Diary Entry', 'class' => 'diary_entry')) }}
                    </div>
                {{ Form::close() }}
            @endif
        </div>
        <div class="ui bottom attached tab segment" data-tab="pictures" id="camp_pics">
            @if(count($campaign->campaignpicture) > 0)
                <div class="ui three column grid">
                    @foreach($campaign->campaignpicture as $pic)
                        <div class="column">
                            <div class="ui segment">
                                <img src="{{ $pic->pic_filename }}" class="ui centered fluid rounded image avatar-image">
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="ui blue message">You currently do not have any saved photos from your campaign. @if($is_dm)Add them below.@endif</div>
            @endif
            @if($is_dm)
                <div class="ui divider"></div>
                {{ Form::open(array('url' => action('User\CampaignController@postPicture'), 'class' => 'ui form', 'files' => true)) }}
                    {{ Form::hidden('campaign', $campaign->id) }}
                    <div class="field">
                        <div class="ui action input">
                            <input type="text" id="_picture" placeholder="Campaign Picture">
                            <label for="picture" class="ui icon button btn-file">
                                <i class="attach basic icon"></i>
                                <input type="file" id="picture" name="picture" style="display: none">
                            </label>
                        </div>
                    </div>
                    {{ Form::submit('Add Picture', array('class' => 'ui blue submit button')) }}
                {{ Form::close() }}
            @endif
        </div>
    </div>

    <!-- Campaign Description -->
    <div class="eight wide column">
        <div class="ui red tall stacked segment">
            <h2 class="ui red dividing header">Campaign Description</h2>
            @if($is_dm)
                {{ Form::textarea('camp_desc', $campaign->description, array('id' => 'camp_desc', 'class' => 'camp_desc')) }}
            @else
                <p>{{ $campaign->description }}</p>
            @endif
        </div>
    </div>

    <!-- Players -->
    <div class="ui hidden divider"></div>
    <div class="eight wide column">
        <div class="ui raised blue segment">
            <h2 class="ui blue dividing header">Players @if($is_dm)<button class="ui blue right floated button" id="add_player">Invite Player</button>@endif</h2>
            <div class="slick-slider">
                @forelse ($campaign->campaigncharacter as $sheet)
                    <div>
                        <img src="{{ $sheet->charactersheet->char_pic }}" class="ui centered rounded image avatar-image">
                        <h4 class="ui header char-pic-name">{{ $sheet->charactersheet->charactergeneral->char_name }}</h4>
                    </div>
                @empty
                    <div class="ui blue message">There are no players in this campaign. Go make some friends!</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- NPCS -->
    <div class="eight wide column">
        <div class="ui raised green segment">
            <h2 class="ui green dividing header">NPCs @if($is_dm)<button class="ui green right floated button" id="add_npc">Add NPC</button>@endif</h2>
            <div class="npc-container">
                @if(count($campaign->npc) > 0)
                    @foreach($campaign->npc as $npc)
                        <div class="ui vertical segment">
                            <a class="right floated compact ui button" href="{{ action('User\CampaignController@deleteNPC', $npc->id) }}">Delete NPC</a>
                            <img class="ui left floated tiny image npc" src="{{ $npc->npc_pic }}">
                            <div class="header">{{ $npc->name }}</div>
                            <p>{{ $npc->desc }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="ui green message">There are currently no NPCs</div>
                @endif
            </div>
        </div>
    </div>
    @if ($is_dm)
        @include('includes.modals.campaign.add_npc')
        @include('includes.modals.campaign.add_player')
    @endif
@stop

@section('inline-js')
    <script type="text/javascript">
        $('.menu .item').tab();

        $(document).on("ready", function()
        {
            @if(count($campaign->charactersheet) > 0)
            $(".slick-slider").slick({
                slidesToShow : 3,
                slidesToScroll : 1,
                autoplay : true,
                autoplayspeed : 1500,
                infinite: true
            });
            @endif
        });

        @if($is_dm)
            var save_desc = debounce(function(){
                var params = {
                    'camp_id' : "{{ $campaign->id }}",
                    'val' : $(this).val()
                };

                $.ajax({
                    type: "PATCH",
                    data : params,
                    url : "{{ action('User\CampaignController@patchDescription') }}",
                    success : function(data) {

                    }
                });
            }, 250);

            $("#add_npc").on("click", function()
            {
                $("#npc_modal").modal('show');
            });

            $("#camp_desc").on("change", save_desc);

            var fileExtentionRange = '.png .jpg .jpeg';
            var MAX_SIZE = 30; // MB

            $(document).on('change', '#camp_pics .btn-file :file', function() {
                var input = $(this);

                if (navigator.appVersion.indexOf("MSIE") != -1) { // IE
                    var label = input.val();

                    input.trigger('fileselect', [ 1, label, 0 ]);
                } else {
                    var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                    var numFiles = input.get(0).files ? input.get(0).files.length : 1;
                    var size = input.get(0).files[0].size;

                    input.trigger('fileselect', [ numFiles, label, size ]);
                }
            });

            $('#camp_pics .btn-file :file').on('fileselect', function(event, numFiles, label, size) {
                $('#picture').attr('name', 'picture'); // allow upload.

                var postfix = label.substr(label.lastIndexOf('.'));
                if (fileExtentionRange.indexOf(postfix.toLowerCase()) > -1) {
                    if (size > 1024 * 1024 * MAX_SIZE ) {
                        alert('max size：<strong>' + MAX_SIZE + '</strong> MB.');

                        $('#picture').removeAttr('name'); // cancel upload file.
                    } else {
                        $('#_picture').val(label);
                    }
                } else {
                    alert('file type：<br/> <strong>' + fileExtentionRange + '</strong>');

                    $('#picture').removeAttr('name'); // cancel upload file.
                }
            });

            $("#add_player").on("click", function()
            {
                $("#add_player_modal").modal('show');
            });
        @endif
    </script>
@append

@section('extra-css')
    {{ HTML::style('css/slick-theme.css') }}
    {{ HTML::style('css/slick.css') }}
@append

@section('extra-js')
    {{ HTML::script('javascript/slick.min.js') }}
@append