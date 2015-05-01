@section('content')
    <div class="ui grid">
        <div class="sixteen wide column">
            <h2 class="ui dividing header">Update settings</h2>
            <div class="ui styled accordion">
                <div class = "title">
                    <div class = "ui three column grid">
                        <div class = "column">
                            <div class = "ui left aligned basic segment">
                                User name
                            </div>
                        </div>
                        <div class = "column">
                            <div class = "ui center aligned basic segment">
                                {{ $user->username }}
                            </div>
                        </div>

                        <div class = "column">
                            <div class = "ui right aligned basic segment">
                                Edit
                                <i class="edit icon"> </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    {{ Form::open(array('url' => action('User\SettingsController@postChangeUsername'), 'class' => 'ui form')) }}
                        <div class="field">
                            {{ Form::label('username', 'Username') }}
                            {{ Form::text('username', '', array('placeholder' => 'New username', 'id' => 'username')) }}
                        </div>
                        {{ Form::submit('Update user name', array('class' => 'ui green submit button')) }}
                    {{ Form::close() }}
                </div>
                <div class = "title">
                    <div class = "ui three column grid">
                        <div class = "column">
                            <div class = "ui left aligned basic segment">
                                Email
                            </div>
                        </div>
                        <div class = "column">
                            <div class = "ui center aligned basic segment">
                                {{ $user->email }}
                            </div>
                        </div>

                        <div class = "column">
                            <div class = "ui right aligned basic segment">
                                Edit
                                <i class="edit icon"> </i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    {{ Form::open(array('url' => action('User\SettingsController@postChangeEmail'), 'class' => 'ui form')) }}
                        <div class="field">
                            {{ Form::label('email', 'New Email') }}
                            {{ Form::text('email', '', array('placeholder' => 'New email', 'id' => 'email')) }}
                        </div>
                        {{ Form::submit('Update email', array('class' => 'ui green submit button')) }}
                    {{ Form::close() }}
                </div>
                <div class = "title">
                    <div class = "ui three column grid">
                        <div class = "column">
                            <div class = "ui left aligned basic segment">
                                Password
                            </div>
                        </div>
                        <div class = "column">
                            <div class = "ui center aligned basic segment">
                                <i class="protect icon"> </i>
                            </div>
                        </div>

                        <div class = "column">
                            <div class = "ui right aligned basic segment">
                                Edit
                                <i class="edit icon"> </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    {{ Form::open(array('url' => action('User\SettingsController@postChangePassword'), 'class' => 'ui form')) }}
                        <div class="fields">
                            <div class="field">
                                {{ Form::label('current_password', 'Current password') }}
                                {{ Form::password('current_password', array('id' => 'current_password')) }}
                            </div>
                            <div class="field">
                                {{ Form::label('password', 'Password') }}
                                {{ Form::password('password', array('id' => 'password')) }}
                            </div>
                            <div class="field">
                                {{ Form::label('password_confirm', 'Confirm Password') }}
                                {{ Form::password('password_confirm', array('id' => 'password_confirm')) }}
                            </div>
                        </div>
                        {{ Form::submit('Update password', array('class' => 'ui green submit button')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('inline-js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.ui.accordion').accordion();
        });
    </script>
@append

