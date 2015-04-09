@extends('layouts.default')
@section('content')
	<header>
		<h1>Patterns</h1>
		<a href="/repository/patterns">all</a> |
		<a href="/repository/patterns/design">design</a> |
		<a href="/repository/patterns/requirements">requirement</a> |
		<a href="/repository/patterns/architectural">architectural</a> |
		<a href="/repository/patterns/implementation">implementation</a> |
        <a href="/repository/patterns/procedural">procedural</a>
		<hr/>
	</header>
	
		<section>
    		<h2>{{ $pattern->title }} {{ $pattern->mini ? "<small>(mini pattern)</small>" : "" }}</h2>
			<h3> (source: <a href="/repository/references/{{$pattern->reference_id}}">{{ $pattern->short_name}}</a>)</h3>
			
			<strong>Description</strong>
			@if (Auth::check() && Auth::user()->role == 1)
				{{ Form::open(array('url'=>'patterns/'.$pattern->pattern_id, 'class'=>'searchform', 'files' => true)) }}
				{{ Form::textarea('description', $pattern->description, array('class'=>'animated'))}}
                <br/><br/>
                <!--<strong>Source</strong><br/>
                <p>{{ Form::text('source', $pattern->source, array('class'=>'animated'))}}</p>
				<br /> -->
				<strong>Keywords</strong>
<br />
				{{ Form::text('keywords', $pattern->keywords, array(/*'class'=>'hidden',*/ 'id' => 'keywordsField'))}}
<br />
                <!-- <div id="keywordList" class="input_fields_wrap">
                </div>    
                <button class="add_field_button btn btn-small btn-info edit">Add More Keywords</button><br /> --> 
                <br /><strong>{{ $pattern->source != null ? "Replace <a href=\"".$pattern->source."\">existing</a> pdf" : "Upload pdf"; }}</strong><br />
                {{ Form::file('pattern_file')}} <br />
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
			
			@if ($cwes)
			<p><strong>Related CWEs</strong><br />
			<ul>
			@foreach ($cwes as $cwe)
				<li><a href="https://cwe.mitre.org/data/definitions/{{$cwe->cwe_id}}.html" target="_blank">{{$cwe->cwe_name}}</a></li>
			@endforeach
			</ul>
			@endif
            
            <div class="visipattern">
            <div class="header">
                {{ HTML::image('images/logo2.png', $alt="VisiPattern", $attributes = array()) }}
            </div>
                <div class="legend">
            {{ HTML::image('images/legend2.png', $alt="VisiPattern", $attributes = array()) }}
                    </div>
            <div id="mynetwork"></div>

            <div id="info"></div>
            
                
            <script src='/repository/js/visipattern.js'></script>
            <script src='/repository/js/pattern.js'></script>
            <script src='/repository/js/libs/vis/vis.js'></script>

        </div>
            
            
            
            
            
            

			@if (Auth::check() && $pattern->source != null)
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

