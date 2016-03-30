<nav id="sidebar" style="overflow: visible !important;" class="ui sidebar blue-black inverted vertical menu">
	<div class="header logo-sidebar item">
		<img class="ui image circular" src="<?php echo e(asset('assets/img/logo.png')); ?>">
		Sistem Rawat Jalan - Apoteker
	</div>
	
	<a href="<?php echo e(url('administrasi')); ?>" class="item xhr-req counter-belum-konsultasi">
		<i class="menu-icon user icon"></i>List Pasien
	</a>

	<a class="item" href="<?php echo e(url('apoteker/profile')); ?>">
		<i class="menu-icon user icon"></i>Profil Saya
	</a>

	<a href="<?php echo e(url('apoteker/logout')); ?>" class="item">
		<i class="menu-icon sign out icon"></i>Logout
	</a>
</nav>