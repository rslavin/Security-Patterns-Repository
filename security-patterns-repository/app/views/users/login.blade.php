{{ Form::open(array('url'=>'users/login', 'class'=>'searchform')) }}
    <h2 class="form-signin-heading">Please Login</h2>
 
    {{ Form::email('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address', 'required'=>true)) }}
    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password', 'required'=>true)) }}
 
    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}