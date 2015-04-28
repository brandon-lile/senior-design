@section('content')
    <header>
        @include('includes.globals.nonauthheader')
    </header>
    <div class="ui blue segment">
        {{ Form::open(array('url' => 'login', 'class' => 'ui form')) }}
            <h2 class="ui dividing header">Login</h2>
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