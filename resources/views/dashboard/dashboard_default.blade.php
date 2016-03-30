<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="{{ asset('/assets/img/favicon.ico') }}" type="image/x-icon">
		<link rel="icon" href="{{ asset('/assets/img/favicon.ico') }}" type="image/x-icon">
		<title>{{ auth()->guard('pegawai')->user()->jabatan }} - @yield('title')</title>
		<style type="text/css">
			.state-hide {
				display: none !important;
			}
		</style>
		<link rel="stylesheet" href="{{ asset('assets/semantic-ui/semantic.min.css') }}"/>
		<link rel="stylesheet" href="{{ asset('assets/css/master.css') }}"/>
		@yield('stylesheet')
		<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/assets/noty/packaged/jquery.noty.packaged.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/assets/noty/layouts/inline.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/semantic-ui/semantic.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/assets/js/master.js') }}"></script>
	</head>
	<body id="master">
		@yield('sidebar')
		<div class="pusher context-sidebar">
			<div class="main content">
				<div class="toc">
					@yield('left-menu')
				</div>
				<div id="loaded-content" class="ui row grid">
					@yield('navbar')
					<div style="min-height: 700px;" class="sixteen wide column">
							<div class="ui grid">
								@yield('content')
							</div>
					</div>
					<div id="footer" class="ui grid">
						<div class="six wide computer column">
							@variable('copyright_year', \Carbon\Carbon::now()->format('Y'))
							<p>
							@if ($copyright_year > 2016)
								Copyright © 2016 - {{$year}}
								@else
								Copyright © 2016
							@endif
							Puskesmas Patrang<br>Jl. Kaca Piring No. 5 Patrang Kab. Jember, Jawa Timur</p>
						</div>
						<div id="contacts" class="right aligned ten wide computer column">
							<div class="ui horizontal divided list">
								<div class="item"><i class="icon phone"></i>0331-484848</div>
								<a href="http://fb.com/Puskesmas_Patrang" class="item">
									<i class="facebook violet icon"></i> Puskesmas Patrang
								</a>
								<a href="http://twitter.com/@puskesmas_patrang" class="item">
									<i class="twitter blue icon"></i> @puskesmas_patrang
								</a>
								<a href="mailto:email@puskesmas_patrang.com" class="item">
									<i class="mail red icon"></i> email@puskesmas_patrang.com
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			@yield('javascript')
		</div>
	</body>
</html>
