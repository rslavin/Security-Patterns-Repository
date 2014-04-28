@extends('layouts.default')
@section('content')
	<header>
		<h1>Patterns</h1>
		<a href="/repository/patterns">all </a>|
		<a href="/repository/patterns/design">design </a>|
		<a href="/repository/patterns/requirements">requirement </a>|
		<a href="/repository/patterns/architectural">architectural </a>|
		<a href="/repository/patterns/implementation">implementation </a>|
        <a href="/repository/patterns/procedural">procedural </a>
		<hr/>
	</header>
	
		
		<section>
    		<h2>{{ $pattern->title }} {{ $pattern->mini ? "<small>(mini pattern)</small>" : "" }}</h2>
			<h3> (source: <a href="/repository/references/{{$pattern->reference_id}}">{{ $pattern->short_name}}</a>)</h3>
			
			<strong>Description</strong>
			<p>{{ $pattern->description }}</p>
			
			<p><strong>Pattern Type</strong><br />
			{{ $pattern->design_type ? "Design<br />" : "" }}
			{{ $pattern->requirements_type ? "Requirements<br />" : "" }}
			{{ $pattern->architectural_type ? "Architectural<br />" : "" }}
			{{ $pattern->implementation_type ? "Implementation<br />" : "" }}
			{{ $pattern->procedural_type ? "Procedural<br />" : "" }}
			</p>
			
			<strong>Keywords</strong>
			<p>{{ $pattern->keywords }}</p>
			
			<strong>Body</strong>
			<p>{{ $pattern->body }}</p>
			
			<strong>Download</strong>
			<p>TODO</p>
			
		</section>
	
@stop
@section('count')
<?php echo $pattern_count; ?>
@stop

