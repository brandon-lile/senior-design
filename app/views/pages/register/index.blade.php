@section('content')
    <div class="ui blue segment">
        <h2 class="ui dividing header">Register</h2>
        {{ Form::open(array('url' => 'register', 'class' => 'ui form')) }}
            <div class="field">
                {{ Form::label('username', 'Username') }}
                {{ Form::text('username', '', array('placeholder' => 'Username', 'id' => 'username')) }}
            </div>
            <div class="field">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', '', array('placeholder' => 'example@mail.com', 'id' => 'email')) }}
            </div>
            <div class="field">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', array('id' => 'password')) }}
            </div>
            <div class="field">
                {{ Form::label('password_confirm', 'Confirm Password') }}
                {{ Form::password('password_confirm', array('id' => 'password_confirm')) }}
            </div>
            {{ Form::submit('Register', array('class' => 'ui green submit button')) }}
        {{ Form::close() }}
    </div>
@stop