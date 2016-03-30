<style>
a.item.actived, .item.actived {
    background: rgba(255,255,255,.08) !important;
    color: #fff !important;
		font-weight: bold !important;
}
</style>
<?php
if(!isset($active)){
	$active = '';
}
if(!isset($active_item)){
	$active_item = '';
}
?>

<nav data-counter="{{ url('dokter/json/counter') }}" class="ui left-menu blue-black inverted left fixed vertical menu">
	<div class="header logo-sidebar item">
		<img class="ui image circular" src="{{ asset('assets/img/logo.png') }}">
		Sistem Rawat Jalan - Administrasi
	</div>

	<a href="{{ url('administrasi') }}" class="icon @if($active == 'dashboard'){{'actived'}}@endif item">
		<i class="menu-icon dashboard icon"></i><span class="menu-label">Dashboard</span>
	</a>

	<a href="{{ url('administrasi/pendaftaran') }}" class="@if($active == 'pendaftaran'){{'actived'}}@endif item">
		<i class="menu-icon user icon"></i><span class="menu-label">Pasien</span>
	</a>

	<a href="{{ url('administrasi/rawat-jalan') }}" class="@if($active == 'rawat-jalan'){{'actived'}}@endif item">
		<i class="menu-icon heart icon"></i><span class="menu-label">Rawat Jalan</span>
	</a>

	<div class="ui @if($active != 'management'){{'left pointing simple dropdown link'}}@endif item">
		<i class="dropdown icon"></i>
		<i class="menu-icon plus icon"></i><span class="menu-label">Management Puskesmas</span>
		<div class="@if($active== 'management'){{'child'}}@endif menu">
			<a href="{{ url('administrasi/poli') }}" class="@if($active_item == 'poli'){{'actived'}}@endif item">
				<i class="hospital icon"></i>Poli
			</a>
			<a href="{{ url('administrasi/obat') }}" class="@if($active_item == 'obat'){{'actived'}}@endif item">
				<i class="first aid icon"></i>Obat
			</a>
			<a href="{{ url('administrasi/pegawai') }}" class="@if($active_item == 'pegawai'){{'actived'}}@endif item">
				<i class="users icon"></i>Pegawai
			</a>
			<a href="{{ url('administrasi/dokter') }}" class="@if($active_item == 'dokter'){{'actived'}}@endif item">
				<i class="doctor icon"></i>Dokter
			</a>
		</div>
	</div>
  <a class="@if($active == 'laporan'){{'actived'}}@endif item" href="{{ url('administrasi/laporan')}}">
		<i class="menu-icon bar chart icon"></i><span class="menu-label">Rekap Rawat Jalan</span>
	</a>
	<a class="@if($active == 'profile'){{'actived'}}@endif item" href="{{ url('administrasi/profile')}}">
		<i class="menu-icon settings icon"></i><span class="menu-label">Profil Saya</span>
	</a>
	<a href="{{ url('administrasi/logout') }}" class="item">
		<i class="menu-icon sign out icon"></i><span class="menu-label">Logout</span>
	</a>
</nav>
