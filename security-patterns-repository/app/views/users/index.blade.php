@section('content')

<div class="loginForm">
    <h2 class="form-signin-heading">Members</h2>
  <div class="searchform">
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
	    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

<table class="table table-striped table-bordered form-signin-field">
	<thead>
		<tr>
			<td>ID</td>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Email</td>
			<td>Role</td>
		</tr>
	</thead>
	<tbody>
	@foreach($user as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->firstname }}</td>
			<td>{{ $value->lastname }}</td>
			<td>{{ $value->email }}</td>
            <td>{{ $value->role }}</td>

			<td>

				<a class="btn btn-small btn-info edit" href="{{ URL::to('users/edit/' . $value->id) }}">Edit</a>            

			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<a class="addMember" id="links" href="{{ URL::to('users/register') }}">Add new member</a>  
</div>
     
</div>
@stop