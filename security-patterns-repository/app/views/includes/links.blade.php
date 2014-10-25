<section>
	<h1>Navigation</h1>
	<ul id="links">
		@if (!Auth::check())
			<li>{{ HTML::link('/login', 'Login') }}</li>
		@else
			<li>{{ HTML::link('/logout', 'Logout') }}  ({{Auth::user()->email}})</li>
            
            @if (Auth::user()->role == "Admin" )
			    <li>{{ HTML::link('/admin', 'Admin') }}</li>
		    @endif   
		@endif

		<li><a href="/repository/patterns">Patterns</a></li>
		<li><a href="/repository/types">Pattern Types</a></li>
		<li><a href="/repository/references">References</a></li>
		<li><a href="/repository/contact">Contact</a></li>
	</ul>
	
</section>