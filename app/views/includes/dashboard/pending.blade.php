<div class="ui yellow segment">
    <h2 class="ui yellow dividing header">Pending Invites</h2>
    @if ($pending != false)
        {{ Form::open(array('url' => action('User\DashboardController@postAcceptInvite'), 'class' => 'ui form')) }}
            <div class="field">
                {{ Form::label('campaign', 'Campaign') }}
                {{ Form::select('campaign', $pending, '', array('class' => 'ui dropdown', 'id' => 'campaign')) }}
            </div>
            <div class="field">
                {{ Form::label('character', 'Character Sheet') }}
                @if ($sheets_dropdown == false)
                    {{ Form::text('character', 'You need to make a sheet before you can join', array('disabled')) }}
                @else
                    {{ Form::select('character', $sheets_dropdown, '', array('class' => 'ui dropdown', 'id' => 'character')) }}
                @endif
            </div>
        @if ($sheets_dropdown != false)
            {{ Form::submit('Join!', array('class' => 'ui yellow submit button')) }}
        @endif
        {{ Form::close() }}
    @else
        <div class="ui yellow message">You currently have no invites to active campaigns</div>
    @endif
</div>

@section('inline-js')
    <script type="text/javascript">
        $(".ui.dropdown").dropdown();
    </script>
@append