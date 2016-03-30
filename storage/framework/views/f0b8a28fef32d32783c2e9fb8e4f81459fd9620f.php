<nav id="sidebar" data-counter="<?php echo e(url('konsultan/counter_json')); ?>" class="ui sidebar left-menu blue-black inverted left fixed vertical menu">
	<div class="header logo-sidebar item">
		<img class="ui image circular" src="<?php echo e(asset('assets/img/logo.png')); ?>">
		Sistem Rawat Jalan - Administrasi
	</div>
	<a href="<?php echo e(url('konsultan')); ?>" class="item">
		Sedang Konsultasi
		<div class="ui hidden counter-belum-konsultasi teal left label">0</div>
	</a>
	<a href="<?php echo e(url('konsultan/sudah-konsultasi')); ?>" class="item">
		Sudah Konsultasi
		<div class="ui hidden counter-sudah-konsultasi teal left label">0</div>
	</a>
	<a class="item" href="<?php echo e(url('konsultan/'. auth()->guard('pegawai')->user()->id_pegawai.'/profil-saya')); ?>">
		Profil Saya
	</a>
	<a href="<?php echo e(url('konsultan/logout')); ?>" class="item">
		Logout
	</a>
</nav>