@extends('layouts.default')
@section('content')
<header>
	<h1>Patterns</h1>
	<a href="/patterns">all </a>|
	<a href="/patterns/design">design </a>|
	<a href="/patterns/requirements">requirements </a>|
	<a href="/patterns/architectural">architectural </a>|
	<a href="/patterns/implementation">implementation </a>
	
	<hr/>
</header>
<?php $count = $patterns->getFrom();  ?>
@foreach ($patterns as $ndx => $pattern)
	<section>
    		<h2> {{ $count++ }})  {{ $pattern->title }}</h2>
		<h3> (source: <a href="/references/{{$pattern->reference_id}}">{{ $pattern->short_name}}</a>)</h3>
		<p>{{ $pattern->description }}</p>
	</section>
@endforeach
{{ $patterns->links() }}
@stop
