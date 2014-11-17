@section('content')

<div class="loginForm">
	{{ Form::open(array('url'=>'/register', 'class'=>'searchform')) }}
    <h2 class="form-signin-heading">Register</h2>
    
    <ul>
        @foreach($errors->all() as $error)
            <li class="form-error">{{ $error }}</li><br/>
        @endforeach
    </ul>
 		
    <div class="form-signin-field">
        {{Form::text('firstname', null,array('class' => 'input-block-level', 'placeholder'=>'First Name', 'required'=>true))}}
    </div>
    
    <div class="form-signin-field">
        {{Form::text('lastname', null,array('class' => 'input-block-level', 'placeholder'=>'First Name', 'required'=>true))}}
    </div>
    
    <div class="form-signin-field">
    	{{ Form::email('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address', 'required'=>true)) }}
    </div>
        
    <div class="form-signin-field">
    	{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password', 'required'=>true)) }}
    </div>
    
     <div class="form-signin-field">
    	{{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password', 'required'=>true)) }}
    </div>
    
     <div class="form-signin-field">
    	{{ Form::select('role', $roles, ['class' => 'form-dropdown']) }}
    </div>   
    
    <div class="form-signin-field">
		{{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
    </div>
	{{ Form::close() }}
</div>
@stop
