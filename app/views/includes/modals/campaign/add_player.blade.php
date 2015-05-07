<div class="ui modal" id="add_player_modal">
    <i class="close icon"></i>
    <div class="ui blue header">Add Player</div>
    <div class="content">
        {{ Form::open(array('url' => action('User\CampaignController@postAddPlayer'), 'class' => 'ui form')) }}
            {{ Form::hidden('campaign', $campaign->id) }}
            <div class="field">
                {{ Form::label('email', 'User email') }}
                {{ Form::text('email', '', array('placeholder' => 'User email', 'id' => 'email')) }}
            </div>
            <div class="ui blue message">If the email exists as a user in our database, we will send them an invite.</div>
            {{ Form::submit('Invite Player', array('class' => 'ui blue submit button')) }}
        {{ Form::close() }}
    </div>
</div>