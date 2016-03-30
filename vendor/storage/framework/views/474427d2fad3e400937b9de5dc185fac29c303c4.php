<nav data-counter="<?php echo e(url('konsultan/json/counter')); ?>" class="ui left-menu blue-black inverted left fixed vertical menu">
	<div class="header logo-sidebar item">
		<img class="ui image circular" src="<?php echo e(asset('assets/img/logo.png')); ?>">
		Sistem Rawat Jalan - Ruang Konsultasi
	</div>
	<a href="<?php echo e(url('konsultan')); ?>" class="item">
		Sedang Konsultasi
		<div class="ui hidden counter-belum-konsultasi red left label">0</div>
	</a>
	<a href="<?php echo e(url('konsultan/sudah-konsultasi')); ?>" class="item">
		Sudah Konsultasi
		<div class="ui hidden counter-sudah-konsultasi teal left label">0</div>
	</a>
	<a class="item" href="<?php echo e(url('konsultan/profile')); ?>">
		Profil Saya
	</a>
	<a href="<?php echo e(url('konsultan/logout')); ?>" class="item">
		Logout
	</a>
</nav>