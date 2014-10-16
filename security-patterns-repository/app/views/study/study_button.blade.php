<div class="loginForm">
	{{ Form::open(array('url' => '/selectPattern', 'class'=>'searchform')) }}
    <h2 class="form-signin-heading">Scenario {{$scenario}}</h2>
    <center><strong>Press the button below if you believe this pattern is best suited for scenario {{$scenario}}.</strong></center>

 		
   {{ Form::hidden('pattern_id', $pattern_id)}}
    
    <div class="form-signin-field">
		{{ Form::submit('Select Pattern', array('class'=>'btn btn-large btn-primary btn-block'))}}
    </div>
	{{ Form::close() }}
</div>