<nav id="sidebar" data-counter="{{ url('dokter/counter_json') }}" class="ui sidebar left-menu blue-black inverted left fixed vertical menu">
	<div class="header logo-sidebar item">
		<img class="ui image circular" src="{{ asset('assets/img/logo.png') }}">
		Sistem Rawat Jalan - dokter
	</div>

	<a href="{{ url('dokter') }}" class="icon item">
		<i class="menu-icon dashboard icon"></i>Dashboard
	</a>

	<a href="{{ url('dokter/rawat-jalan') }}" class="item xhr-req counter-belum-konsultasi">
		<i class="menu-icon heart icon"></i>Rawat Jalan
	</a>
	<a class="item" href="{{ url('dokter/profile')}}">
		<i class="menu-icon settings icon"></i>Profil Saya
	</a>
	<a href="{{ url('dokter/logout') }}" class="item">
		<i class="menu-icon sign out icon"></i>Logout
	</a>
</nav>
