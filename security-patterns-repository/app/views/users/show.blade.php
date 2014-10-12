@section('content')

<div class="loginForm">
    <h2 class="form-signin-heading">{{ $user->name }}<</h2>


	
		<p>
			<strong>Email:</strong> {{ $user->email }}<br>
			<strong>Role:</strong> {{ $user->role }}
		</p>

</div>
@stop