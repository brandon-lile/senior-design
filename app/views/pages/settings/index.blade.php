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
                Current Name
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
          {{ Form::open(array('url' => 'settings', 'class' => 'ui form')) }}
          {{ Form::label('username', 'Username') }}
          {{ Form::text('username', '', array('placeholder' => 'New username', 'id' => 'username')) }}
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
                Current Email
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
          {{ Form::open(array('url' => 'settings', 'class' => 'ui form')) }}
          {{ Form::label('email', 'Email') }}
          {{ Form::text('Email', '', array('placeholder' => 'New email', 'id' => 'email')) }}
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
          {{ Form::open(array('url' => 'settings', 'class' => 'ui form')) }}
          {{ Form::label('current_password', 'Current password') }}  
          {{ Form::password('current_password', array('id' => 'current_password')) }}
          {{ Form::label('password', 'Password') }}
          {{ Form::password('password', array('id' => 'password')) }}
          {{ Form::label('password_confirm', 'Confirm Password') }}
          {{ Form::password('password_confirm', array('id' => 'password_confirm')) }}
          {{ Form::submit('Update password', array('class' => 'ui green submit button')) }}
          {{ Form::close() }}
        </div>
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

