<div class="ui modal" id="add_campaign_modal">
    <i class="close icon"></i>
    <div class="ui blue header">Create Campaign</div>
    <div class="content">
        {{ Form::open(array('url' => action('User\DashboardController@postCreateCampaign'), 'class' => 'ui form')) }}
            <div class="field">
                {{ Form::label('name', 'Campaign Name') }}
                {{ Form::text('name', '', array('placeholder' => 'Campaign Name', 'id' => 'name')) }}
            </div>
            <div class="field">
                {{ Form::label('description', 'Campaign Description') }}
                {{ Form::textarea('description', '', array('placeholder' => 'Enter a description about the campaign', 'id' => 'description')) }}
            </div>
            {{ Form::submit('Create Campaign!', array('class' => 'ui blue submit button')) }}
        {{ Form::close() }}
    </div>
</div>