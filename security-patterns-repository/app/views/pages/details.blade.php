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
			@if (Auth::check() && Auth::user()->role == 1)
				{{ Form::open(array('url'=>'patterns/'.$pattern->pattern_id, 'class'=>'searchform')) }}
				{{ Form::textarea('description', $pattern->description, array('class'=>'animated'))}}
                <br/><br/>
                <strong>Source</strong><br/>
                <p>{{ Form::text('source', $pattern->source, array('class'=>'animated'))}}</p>
				<br />
				<strong>Keywords</strong>
				<p>{{ Form::text('keywords', $pattern->keywords, array('class'=>'animated'))}}</p>
				<br />
				{{ Form::submit('Save', array('class'=>'btn btn-large btn-primary btn-block'))}}
				{{ Form::close() }}
			@else
				<p>{{ $pattern->description }}</p>
			@endif

	
			<p><strong>Pattern Type</strong><br />
			{{ $pattern->design_type ? "Design<br />" : "" }}
			{{ $pattern->requirements_type ? "Requirements<br />" : "" }}
			{{ $pattern->architectural_type ? "Architectural<br />" : "" }}
			{{ $pattern->implementation_type ? "Implementation<br />" : "" }}
			{{ $pattern->procedural_type ? "Procedural<br />" : "" }}
			</p>
			
			<strong>Related CWEs</strong>
			<ul>
			@foreach($cwes as $cwe)
				<li>{{ $cwe->name }}</li>
			@endforeach
			@if (Auth::check() && Auth::user()->role == 1)
				{{ Form::open(array('url'=>'cwe_set/add', 'class'=>'searchform')) }}
				{{ Form::hidden('pattern_id', $pattern->pattern_id)}}
				{{ Form::text('cwe_name') }}
				{{ Form::submit('Add') }}
				{{ Form::close() }}
			@endif
			</ul>
			
			<strong>Body</strong>
			<p>{{ $pattern->body }}</p>
			
			@if (Auth::check())
			<strong>Download</strong>
			<p><a href="{{ $pattern->source}}">{{ $pattern->title}}</a></p>
			@endif
			
			@if(Auth::check() && Auth::user()->role == 3)
				{{ $study_button }}
			@endif
			
		</section>
	
@stop
@section('count')
<?php echo $pattern_count; ?>
@stop

