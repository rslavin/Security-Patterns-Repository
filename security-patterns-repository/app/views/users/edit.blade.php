@section('content')

<div class="loginForm">
    <div class="searchform">
    {{ Form::model($user, array('action' => array('UsersController@update', $user->id), 'method' => 'POST')) }}
    <h2 class="form-signin-heading">Edit User</h2>
    
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
    	{{ Form::select('role', array('Admin' => 'Admin', 'User' => 'User'), 'User', ['class' => 'form-dropdown']) }}
    </div>   
    
    <div class="form-signin-field">
		{{ Form::submit('Save Edit', array('class'=>'btn btn-large btn-primary btn-block'))}}
    </div>
	{{ Form::close() }}
    </div>
</div>
@stop