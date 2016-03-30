<nav class="ui left-menu blue-black inverted left fixed vertical menu">
	<div class="header logo-sidebar item">
		<img class="ui image circular" src="<?php echo e(asset('assets/img/logo.png')); ?>"> Sistem Rawat Jalan - apoteker
	</div>
	<a href="<?php echo e(url('apoteker')); ?>" class="icon item">
		<i class="menu-icon dashboard icon"></i>Dashboard
	</a>
	<a href="<?php echo e(url('apoteker/rawat-jalan')); ?>" class="item">
		<i class="menu-icon heart icon"></i>Rawat Jalan
	</a>
	<a href="<?php echo e(url('apoteker/obat')); ?>" class="item">
		<i class="menu-icon first aid icon"></i>Obat
	</a>
	<a class="item" href="<?php echo e(url('apoteker/profile')); ?>">
		<i class="menu-icon settings icon"></i>Profil Saya
	</a>
	<a href="<?php echo e(url('apoteker/logout')); ?>" class="item">
		<i class="menu-icon sign out icon"></i>Logout
	</a>
</nav>
