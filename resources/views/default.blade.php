<!doctype html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	
	<script src="{{ asset('assets/js/jquery.min.js') }}"type="text/javascript" charset="utf-8"></script>
	<script src="{{ asset('assets/semantic-ui/semantic.min.js') }}" type="text/javascript" charset="utf-8"></script>
	<script src="{{ asset('assets/js/master.js') }}" type="text/javascript" charset="utf-8"></script>
	
	<style type="text/css" media="screen">
	.no-js #loader {
		display: none;
	}
	.js #loader {
		display: block;
		position: fixed;
		background: #333;
		height: 100%;
		width: 100%;
	}
	.item.logo{
		padding: 0.3em 0.8em !important;
	}
	.image.logo img{
		width: 37px;
		margin-right: 0.8em;
	}
	</style>
	<script type="text/javascript" charset="utf-8">
			$(window).load(function(){
				$('.dimming').addClass('active');
			});
	</script>
	<link rel="stylesheet"
		href="{{ asset('assets/semantic-ui/semantic.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/master.css') }}">
		@yield('stylesheet')
	</head>
	<body id="master">
		<div class="dimming"></div>
		@include('navbar')
		<div class="master-container">
			<div id="container-sidebar" class="master-sidebar computer only column">
				@include('sidebar')
			</div>
			<div id="main-content" class="main sixteen wide column">
				<div class="content-wrapper">
					@yield('breadcrumbs')
					<h2 class="ui dividing header">@yield('content_title')</h2>
					@include('message')
					@yield('content')
				</div>
				
			</div>
		</div>
		@include('footer')
		@yield('javascript')
		<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$('.ui.button').popup();
			$(window).resize(function(){
				var h = $('#sticky-sidebar').height();
				$('#container-sidebar').css('min-height',h+'px');
				$('.master-container').css('min-height', ($(window).height() - $('#footer').height()) + 'px');
			})
			$(window).trigger('resize');
			$('#sticky-sidebar').sticky({
				context: '#container-sidebar',
				offset: 46,
			});
			$('.message .close').on('click', function() {
			$(this).closest('.message').transition('fade');
			});
		});
		</script>
	</body>