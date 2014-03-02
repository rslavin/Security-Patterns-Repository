<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Security Pattern Repository</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="/css/style.css">

	<script src="/js/libs/modernizr-2.0.6.min.js"></script>
</head>
<body>

	<div id="header-container">
		<header class="wrapper clearfix">
			<h1 id="title">Security Pattern Repository</h1>
			<nav>
				<ul>
					<li><a href="/patterns">Patterns</a></li>
					<li><a href="/references">References</a></li>
					<li><a href="/contact">Contact</a></li>
				</ul>
			</nav>
		</header>
	</div>
	<div id="main-container">
		<div id="main" class="wrapper clearfix">
			
			<article>
			@if (isset($patterns))
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
			@elseif (isset($references))
				<header>
					<h1>References</h1>
					<hr/>
				</header>
			@foreach ($references as $ndx => $reference)
				<section>
    					<h2>{{ $reference->title }} ({{ $reference->year }})</h2>
					<p>{{ $reference->authors }}</p>
				</section>
				<br />
			@endforeach
				{{ $references->links() }}
			@else
				<header>
					<h1>Contact</h1>
					<hr/>
				</header>
				<section>
    					<h2>Jean-Michel Lehker</h2>
					<p>email: rpl599@my.utsa.edu</p>
				</section>
				<br />
				<section>
    					<h2>Rocky Slavin</h2>
					<p>email: @my.utsa.edu</p>
				</section>
				<br />
				<section>
    					<h2>Jianwei Niu</h2>
					<p>email: @my.utsa.edu</p>
				</section>
				<br />
			@endif
			
				<section>
				<footer>
				</footer>
			</article>
			
			<aside>
				<h3>security pattern</h3>
				<p>Security patterns are reusable solutions to security problems.</p>
			</aside>
			
		</div> <!-- #main -->
	</div> <!-- #main-container -->

	<div id="footer-container">
		<footer class="wrapper">
			<pre>Please contact Jean-Michel Lehker at rpl599@my.utsa.edu with problems or questions about this repository.</pre>
		</footer>
	</div>

</body>
</html>
