<nav id="sidebar" data-counter="<?php echo e(url('dokter/counter_json')); ?>" class="ui sidebar left-menu blue-black inverted left fixed vertical menu">
	<div class="header logo-sidebar item">
		<img class="ui image circular" src="<?php echo e(asset('assets/img/logo.png')); ?>">
		Sistem Rawat Jalan - Poli
	</div>
	<a href="<?php echo e(url('dokter')); ?>" class="item">
		<i class="icon menu-icon file text outline"></i> Resep Pasien
		<div class="ui hidden counter-need-resep teal left label">0</div>
	</a>
	<a href="<?php echo e(url('dokter/resep-sudah')); ?>" class="item xhr-req counter-sudah-konsultasi">
		<i class="icon menu-icon check"></i> Pekerjaan Selesai
	</a>
	<a class="item" href="<?php echo e(url('dokter/profile')); ?>">
		<i class="icon menu-icon doctor"></i> Profil Saya
	</a>
	<a href="<?php echo e(url('dokter/logout')); ?>" class="item">
		<i class="icon menu-icon sign out"></i> Logout
	</a>
</nav>