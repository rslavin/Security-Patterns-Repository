@extends('layouts.default')
@section('content')
	<header>
		<h1>Researchers</h1>
		<hr/>
	</header>
	
	
	<section>
		<h2>Rocky Slavin</h2>
		<p>homepage: <a href="http://galadriel.cs.utsa.edu/~rslavin/">galadriel.cs.utsa.edu/~rslavin</a></p>
		<p>email: <a href="mailto:koq441@my.utsa.edu">koq441@my.utsa.edu</a></p>
	</section>
	<br />
	
	<section>
    	<h2>Jianwei Niu</h2>
		<p>homepage: <a href="http://cs.utsa.edu/~niu/">cs.utsa.edu/~niu</a></p>
		<p>email: <a href="mailto:jianwei.niu@utsa.edu">jianwei.niu@utsa.edu</a> </p>
	</section>

	<br />
<hr />
<h1>Related Publications</h1>
<ol>
        <p><li>Rocky Slavin, Jean-Michel Lehker, Jianwei Niu, and Travis D. Breaux. "Managing Security Requirements Patterns using Feature Diagram Hierarchies", <i> 22nd IEEE International Requirements Engineering Conference</i>, 2014, Sweden. <a href="http://galadriel.cs.utsa.edu/~rslavin/publications/re14_pattern_hierarchy.pdf">(pdf)</a></li></p>
        <p><li>Jean-Michel Lehker, Rocky Slavin,  and Jianwei Niu. "Integration of Security Pattern Selection Practices with Pattern Storage", <i>Symposium and Bootcamp on the Science of Security (HotSoS)</i>, 2014, Raleigh. <a href="phttp://galadriel.cs.utsa.edu/~rslavin/publications/hotsos14.pdf">(pdf)</a></li></p>
        <p><li>Rocky Slavin, Hui Shen, and Jianwei Niu. "Characteristics and Boundaries of Security Requirements Patterns", <i>Second International Workshop on Requirements Patterns (RePa)</i>, 2012, Chicago. <a href="phttp://galadriel.cs.utsa.edu/~rslavin/publications/repa12.pdf">(pdf)</a></li></p>
    </ol>

@stop
@section('count')
<?php echo $pattern_count; ?>
@stop
