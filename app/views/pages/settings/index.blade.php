@section('content')
    <div class="ui blue segment">
        <h2 class="ui dividing header">Update settings</h2>
        {{ Form::open(array('url' => 'update_settings', 'class' => 'ui form')) }}
            <div class="fluid ui button">
                Username
                <!-- {{ Form::label('username', 'Username') }}
                {{ Form::text('username', '', array('placeholder' => 'Username', 'id' => 'username')) }} -->
            </div>
            <div class="fluid ui button">
                Password
                <!-- {{ Form::label('email', 'Email') }}
                {{ Form::text('email', '', array('placeholder' => 'example@mail.com', 'id' => 'email')) }} -->
            </div>
            <div class="fluid ui button">
                Email
                <!-- {{ Form::label('password', 'Password') }}
                {{ Form::password('password', array('id' => 'password')) }} -->
            </div>
    <!--         <div class="field">
                {{ Form::label('password_confirm', 'Confirm Password') }}
                {{ Form::password('password_confirm', array('id' => 'password_confirm')) }}
            </div> -->
            {{ Form::submit('Register', array('class' => 'ui green submit button')) }}
        {{ Form::close() }}
    </div>
@stop