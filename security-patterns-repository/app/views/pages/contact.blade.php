@extends('layouts.default')
@section('content')
	<header>
		<h1>Contact</h1>
		<hr/>
	</header>
	
	<section>
    	<h2>Jean-Michel Lehker</h2>
		<p>email: <a href="mailto:rpl599@my.utsa.edu">rpl599@my.utsa.edu</a></p>
	</section>
	<br />
	
	<section>
    	<h2>Rocky Slavin</h2>
		<p>email: <a href="mailto:koq441@my.utsa.edu">koq441@my.utsa.edu</a></p>
	</section>
	<br />
	
	<section>
    	<h2>Jianwei Niu</h2>
		<p>email: <a href="mailto:niu@cs.utsa.edu">niu@cs.utsa.edu</a> </p>
	</section>
	<br />
@stop
@section('count')
<?php echo $pattern_count; ?>
@stop