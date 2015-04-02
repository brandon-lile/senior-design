@section('content')
    <h1 class="ui header">Rolla DND Club's Campaign Page</h1>
    <div class="eight wide column">
        <div class="ui top attached tabular menu">
            <a class="active item" data-tab="diary">Diary</a>
            <a class="item" data-tab="pictures">Pictures</a>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="diary">
            <div class="ui segment" style="max-height: 100px; overflow-y: scroll;">
                <div class="ui divided list">
                    <div class="item">
                        <div class="ui header">3/31/2015</div>
                        <p>Entered the final cavern. Had an amazing battle. Everyone died.</p>
                    </div>
                    <div class="item">
                        <div class="ui header">3/25/2015</div>
                        <p>Mostly nonsense today.</p>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="ui fluid action input">
                    {{ Form::text('diary', '', array('placeholder' => 'New Diary Entry')) }}
                    <button class="ui green button">Save</button>
                </div>
            </div>
        </div>
        <div class="ui bottom attached tab segment" data-tab="pictures">

        </div>
    </div>
    <div class="eight wide column">
        <div class="ui red tall stacked segment">
            <h2 class="ui header">Campaign Description</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>
    <div class="ui hidden divider"></div>
    <div class="eight wide column">
        <div class="ui raised blue segment">
            <h2 class="ui header">Players</h2>
        </div>
    </div>
    <div class="eight wide column">
        <div class="ui raised green segment">
            <h2 class="ui header">NPCs</h2>
            <div class="ui vertical segment">
                <img class="ui left floated tiny image npc" src="{{ asset('images/dnd_character.jpg') }}">
                This is Fred and he works at the Tavern and serves beer to all the underaged kids.
            </div>
            <div class="ui vertical segment">
                <img class="ui left floated tiny image npc" src="{{ asset('images/lizardman_001cf.jpg') }}">
                This is the lizardman. He lives under the bridge and eats people.
            </div>
        </div>
    </div>
@stop

@section('inline-js')
    <script type="text/javascript">
        $('.menu .item').tab();
    </script>
@append