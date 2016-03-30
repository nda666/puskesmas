<nav data-counter="<?php echo e(url('konsultan/json/counter')); ?>" class="ui left-menu blue-black inverted left fixed vertical menu">
	<div class="header logo-sidebar item">
		<img class="ui image circular" src="<?php echo e(asset('assets/img/logo.png')); ?>">
		Sistem Rawat Jalan - Konsultan
	</div>

	<a href="<?php echo e(url('konsultan')); ?>" class="icon item">
		<i class="menu-icon dashboard icon"></i>Dashboard
	</a>

	<a href="<?php echo e(url('konsultan/rawat-jalan')); ?>" class="item xhr-req counter-belum-konsultasi">
		<i class="menu-icon heart icon"></i>Rawat Jalan
	</a>
	<a class="item" href="<?php echo e(url('konsultan/profile')); ?>">
		<i class="menu-icon settings icon"></i>Profil Saya
	</a>
	<a href="<?php echo e(url('konsultan/logout')); ?>" class="item">
		<i class="menu-icon sign out icon"></i>Logout
	</a>
</nav>
