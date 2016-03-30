<?php
if(!isset($active)){
	$active = '';
}
if(!isset($active_item)){
	$active_item = '';
}
?>
<nav id="sidebar" style="overflow: visible !important;" class="ui sidebar blue-black inverted vertical menu">
	<div class="header logo-sidebar item">
		<img class="ui image circular" src="<?php echo e(asset('assets/img/logo.png')); ?>">
		Sistem Rawat Jalan - Administrasi
	</div>

	<a href="<?php echo e(url('administrasi')); ?>" class="icon <?php if($active == 'dashboard'): ?><?php echo e('actived'); ?><?php endif; ?> item">
		<i class="menu-icon dashboard icon"></i><span class="menu-label">Dashboard</span>
	</a>

	<a href="<?php echo e(url('administrasi/pendaftaran')); ?>" class="<?php if($active == 'pendaftaran'): ?><?php echo e('actived'); ?><?php endif; ?> item">
		<i class="menu-icon user icon"></i><span class="menu-label">Pasien</span>
	</a>

	<a href="<?php echo e(url('administrasi/rawat-jalan')); ?>" class="<?php if($active == 'rawat-jalan'): ?><?php echo e('actived'); ?><?php endif; ?> item">
		<i class="menu-icon heart icon"></i><span class="menu-label">Rawat Jalan</span>
	</a>

	<div class="ui <?php if($active != 'management'): ?><?php echo e('left pointing simple dropdown link'); ?><?php endif; ?> item">
		<i class="dropdown icon"></i>
		<i class="menu-icon plus icon"></i><span class="menu-label">Management Puskesmas</span>
		<div class="<?php if($active== 'management'): ?><?php echo e('child'); ?><?php endif; ?> menu">
			<a href="<?php echo e(url('administrasi/poli')); ?>" class="<?php if($active_item == 'poli'): ?><?php echo e('actived'); ?><?php endif; ?> item">
				<i class="hospital icon"></i>Poli
			</a>
			<a href="<?php echo e(url('administrasi/obat')); ?>" class="<?php if($active_item == 'obat'): ?><?php echo e('actived'); ?><?php endif; ?> item">
				<i class="first aid icon"></i>Obat
			</a>
			<a href="<?php echo e(url('administrasi/pegawai')); ?>" class="<?php if($active_item == 'pegawai'): ?><?php echo e('actived'); ?><?php endif; ?> item">
				<i class="users icon"></i>Pegawai
			</a>
			<a href="<?php echo e(url('administrasi/dokter')); ?>" class="<?php if($active_item == 'dokter'): ?><?php echo e('actived'); ?><?php endif; ?> item">
				<i class="doctor icon"></i>Dokter
			</a>
		</div>
	</div>
  <a class="<?php if($active == 'laporan'): ?><?php echo e('actived'); ?><?php endif; ?> item" href="<?php echo e(url('administrasi/laporan')); ?>">
		<i class="menu-icon bar chart icon"></i><span class="menu-label">Rekap Rawat Jalan</span>
	</a>
	<a class="<?php if($active == 'profile'): ?><?php echo e('actived'); ?><?php endif; ?> item" href="<?php echo e(url('administrasi/profile')); ?>">
		<i class="menu-icon settings icon"></i><span class="menu-label">Profil Saya</span>
	</a>
	<a href="<?php echo e(url('administrasi/logout')); ?>" class="item">
		<i class="menu-icon sign out icon"></i><span class="menu-label">Logout</span>
	</a>
</nav>
