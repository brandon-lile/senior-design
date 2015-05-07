@section('content')
    <div class="ui blue segment">
        <h2 class="ui blue dividing header">Login</h2>
        {{ Form::open(array('url' => 'login', 'class' => 'ui form')) }}
            <div class="field">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', '', array('placeholder' => 'Email', 'id' => 'email')) }}
            </div>
            <div class="field">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', array('placeholder' => 'Password', 'id' => 'password')) }}
            </div>
            {{ Form::submit('Login', array('class' => 'ui green submit button')) }}
        {{ Form::close() }}
    </div>
@stop