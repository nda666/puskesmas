<nav id="sidebar" style="overflow: visible !important;" class="ui sidebar blue-black inverted vertical menu">
	<div class="header logo-sidebar item">
		<img class="ui image circular" src="<?php echo e(asset('assets/img/logo.png')); ?>">
		Sistem Rawat Jalan - Administrasi
	</div>

	<a href="<?php echo e(url('administrasi')); ?>" class="icon item xhr-req counter-sudah-konsultasi">
		<i class="menu-icon dashboard icon"></i>Dashboard
	</a>

	<a href="<?php echo e(url('administrasi/pendaftaran')); ?>" class="item xhr-req counter-belum-konsultasi">
		<i class="menu-icon file icon"></i>Form Pendaftaran
	</a>
	
	<div class="ui left pointing simple dropdown link item">
		<i class="dropdown icon"></i>
		<i class="menu-icon treatment icon"></i>Konsultasi
		<div class="menu">
			<a href="<?php echo e(url('administrasi/belum-konsultasi')); ?>" class="item">
				<i class="minus icon"></i>Belum
			</a>
			<a href="<?php echo e(url('administrasi/sudah-konsultasi')); ?>" class="item">
				<i class="check icon"></i>Sudah
			</a>
		</div>
	</div>
	<div class="ui left pointing simple dropdown link item">
		<i class="dropdown icon"></i>
		<i class="menu-icon file text outline icon"></i>Resep Pasien
		<div class="menu">
			<a href="<?php echo e(url('administrasi/resep-belum')); ?>" class="item">
				<i class="minus icon"></i>Belum
			</a>
			<a href="<?php echo e(url('administrasi/resep-sudah')); ?>" class="item">
				<i class="check icon"></i>Sudah
			</a>
		</div>
	</div>
	<a href="<?php echo e(url('administrasi/obat')); ?>" class="item">
		<i class="menu-icon first aid icon"></i>Obat
	</a>
	<div class="ui left pointing simple dropdown link item">
		<i class="dropdown icon"></i>
		<i class="menu-icon bar chart icon"></i>Management Laporan
		<div class="menu">
			<a href="<?php echo e(url('administrasi/management/pasien')); ?>" class="item">
				<i class="user icon"></i>Pasien
			</a>
			<a href="<?php echo e(url('administrasi/management/ruang-konsultasi')); ?>" class="item">
				<i class="treatment icon"></i>Ruang Konsultasi
			</a>
			<a href="<?php echo e(url('administrasi/management/poli')); ?>" class="item">
				<i class="doctor icon"></i>Poli
			</a>
			<!-- 
			<a href="<?php echo e(url('administrasi/management/pegawai')); ?>" class="item">
				<i class="users icon"></i>Pegawai
			</a>
			 -->
		</div>
	</div>
	<a class="item" href="<?php echo e(url('administrasi/pegawai')); ?>">
		<i class="menu-icon users icon"></i>Pegawai
	</a>
	<a class="item" href="<?php echo e(url('administrasi/profile')); ?>">
		<i class="menu-icon user icon"></i>Profil Saya
	</a>
	<a href="<?php echo e(url('administrasi/logout')); ?>" class="item">
		<i class="menu-icon sign out icon"></i>Logout
	</a>
</nav>