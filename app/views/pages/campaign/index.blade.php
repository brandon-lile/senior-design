@section('content')
    <h1 class="ui header">{{ $campaign->campaign_name }}</h1>

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
        </div>
        <div class="ui bottom attached tab segment" data-tab="pictures" id="camp_pics">
            @if(count($campaign->campaignpicture) > 0)

            @else
                <div class="ui blue message">You currently do not have any saved photos from your campaign. Add them below.</div>
            @endif
            <div class="ui divider"></div>
            {{ Form::open(array('url' => action('User\CampaignController@postPicture'), 'class' => 'ui form', 'files' => true)) }}
                <div class="field">
                    <div class="ui action input">
                        <input type="text" id="_picture" placeholder="Campaign Picture">
                        <label for="picture" class="ui icon button btn-file">
                            <i class="attachment basic icon"></i>
                            <input type="file" id="picture" name="picture" style="display: none">
                        </label>
                    </div>
                </div>
                {{ Form::submit('Add Picture', array('class' => 'ui blue submit button')) }}
            {{ Form::close() }}
        </div>
    </div>

    <!-- Campaign Description -->
    <div class="eight wide column">
        <div class="ui red tall stacked segment">
            <h2 class="ui header">Campaign Description</h2>
            {{ Form::textarea('camp_desc', $campaign->description, array('id' => 'camp_desc', 'class' => 'camp_desc')) }}
        </div>
    </div>

    <!-- Players -->
    <div class="ui hidden divider"></div>
    <div class="eight wide column">
        <div class="ui raised blue segment">
            <h2 class="ui header">Players <button class="ui blue right floated button" id="add_player">Invite Player</button></h2>
            <div class="ui divider"></div>
            <div class="slick-slider">
                @forelse ($campaign->campaigncharacter as $sheet)
                    <div>
                        <img src="{{ $sheet->charactersheet->char_pic }}" class="ui centered rounded image avatar-image">
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
            <h2 class="ui header">NPCs <button class="ui green right floated button" id="add_npc">Add NPC</button></h2>
            <div class="ui divider"></div>
            <div class="npc-container">
                @if(count($campaign->npc) > 0)
                    @foreach($campaign->npc as $npc)
                        <div class="ui vertical segment">
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
    @include('includes.modals.campaign.add_npc')
    @include('includes.modals.campaign.add_player')
@stop

@section('inline-js')
    <script type="text/javascript">
        $('.menu .item').tab();

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

            $("#camp_desc").on("change", save_desc);
        });

        $("#add_npc").on("click", function()
        {
            $("#npc_modal").modal('show');
        });

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
            $('#picture').attr('name', 'avatar'); // allow upload.

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
    </script>
@append

@section('extra-css')
    {{ HTML::style('css/slick-theme.css') }}
    {{ HTML::style('css/slick.css') }}
@append

@section('extra-js')
    {{ HTML::script('javascript/slick.min.js') }}
@append