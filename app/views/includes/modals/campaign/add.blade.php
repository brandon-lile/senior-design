<div class="ui modal" id="add_campaign_modal">
    <i class="close icon"></i>
    <div class="ui blue header">Create Campaign</div>
    <div class="content">
        @if ($errors->campaign->all() != false)
            <div class="ui column sixteen wide red message">
                <i class="close icon"></i>

                <div class="header">
                    The following errors were encountered:
                </div>

                <ul class="ui list">
                    @foreach ($errors->campaign->all('<li>:message</li>') as $message)
                        {{ $message }}
                    @endforeach
                </ul>
            </div>
        @endif
        {{ Form::open(array('url' => action('User\DashboardController@postCreateCampaign'), 'class' => 'ui form')) }}
            <div class="field">
                {{ Form::label('name', 'Campaign Name') }}
                {{ Form::text('name', Input::old('name'), array('placeholder' => 'Campaign Name', 'id' => 'name')) }}
            </div>
            <div class="field">
                {{ Form::label('description', 'Campaign Description') }}
                {{ Form::textarea('description', Input::old('description'), array('placeholder' => 'Enter a description about the campaign', 'id' => 'description')) }}
            </div>
            {{ Form::submit('Create Campaign!', array('class' => 'ui blue submit button')) }}
        {{ Form::close() }}
    </div>
</div>

@section('inline-js')
    @if ($errors->campaign->all() != false)
        <script type="text/javascript">
            $("#add_campaign_modal").modal('show');
        </script>
    @endif
@append