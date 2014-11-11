@extends('layouts.default')
@section('content')
	<h2>Welcome</h2>
	<p>
	This security pattern repository is part of an ongoing project to 
provide expert and novice software developers with a centralized source of security patterns.	
</p>
<p>
	Please use the search box to the left to explore the repository. The search engine will return brief 
	summaries of patterns, the pattern type, and the publication source. Links to the actual patterns are 
	available to users on the UTSA network. 
</p>

<p>
	For more information on our research, please visit our <a href="research">Research</a> page.</p>
	
@stop
@section('count')
<?php echo $pattern_count; ?>
@stop
