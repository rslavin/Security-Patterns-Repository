<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	@include('includes.head')
</head>
<body>
	<div id="header-container">
		@include('includes.header')
	</div>
	<div id="main-container">
		<div id="main" class="wrapper clearfix">
			<article>
				@yield('content')		
			</article>
			<aside>
				@include('includes.aside')
			</aside>
			<br />
			<aside>
				@yield('count', '<p></p>')
			</aside>
		</div> <!-- #main -->
	</div> <!-- #main-container -->
	<div id="footer-container">
		@include('includes.footer')
	</div>
</body>
</html>