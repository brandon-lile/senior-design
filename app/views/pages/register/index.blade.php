@section('content')
    <div class="ui blue segment">
        <h2 class="ui dividing header">Register</h2>
        {{ Form::open(array('url' => 'logout', 'class' => 'ui form')) }}

        {{ Form::close() }}
    </div>
@stop