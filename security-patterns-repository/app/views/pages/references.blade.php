@extends('layouts.default')
@section('content')
	<header>
		<h1>References</h1>
		<hr/>
	</header>
	@foreach ($references as $ndx => $reference)
		<section>
 			<h2>{{ $reference->title }} ({{ $reference->year }})</h2>
			<p>by {{ $reference->authors }}</p>
		@if (isset($titles))
			<span>Included patterns:</span>
			<ul>
			@foreach ($titles as $title)
				<li><a href="/repository/patterns/{{$title->pattern_id}}">{{ $title->title }}</a>{{ $title->mini ? "<small> (mini pattern)</small>" : "" }}</li>
			@endforeach
			</ul>
		@else
			<a href="/repository/references/{{$reference->reference_id}}">more>></a>
		@endif
		</section>
		<br />
	@endforeach
	{{ $references->links() }}
@stop
