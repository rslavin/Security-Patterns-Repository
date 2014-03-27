@extends('layouts.default')
@section('content')
	<header>
		<h1>Patterns</h1>
		<a href="/repository/patterns">all </a>|
		<a href="/repository/patterns/design">design </a>|
		<a href="/repository/patterns/requirements">requirement </a>|
		<a href="/repository/patterns/architectural">architectural </a>|
		<a href="/repository/patterns/implementation">implementation </a>	
		<hr/>
	</header>
	
	<?php $count = $patterns->getFrom();  ?>
	@foreach ($patterns as $ndx => $pattern)
		<section>
    		<h2> {{ $count++ }})  {{ $pattern->title }} {{ $pattern->mini ? "<small>(mini pattern)</small>" : "" }}</h2>
			<h3> (source: <a href="/repository/references/{{$pattern->reference_id}}">{{ $pattern->short_name}}</a>)</h3>
			<p>{{ $pattern->description }}</p>
		</section>
	@endforeach
	{{ $patterns->links() }}

@stop
@section('count')
<?php echo $pattern_count; ?>
@stop
