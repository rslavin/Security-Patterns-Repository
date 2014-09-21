@section('content')

<div class="loginForm">
	{{ Form::open(array('url'=>'users/login', 'class'=>'searchform')) }}
    <h2 class="form-signin-heading">Please Login</h2>
 		<div class="form-signin-field">
    		{{ Form::email('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address', 'required'=>true)) }}
        </div>
        <div class="form-signin-field">
    		{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password', 'required'=>true)) }}
    	</div>
 		<div class="form-signin-field">
		    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
    	</div>
	{{ Form::close() }}
</div>
@stop
@section('count')
<?php echo $pattern_count; ?>
@stop