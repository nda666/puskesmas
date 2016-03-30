<div id="sidebar" data-counter="<?php echo e(url('konsultan/counter_json')); ?>" class="ui sidebar visible vertical menu">
	<div class="active header item">
		<img class="logo" src="<?php echo e(asset('assets/img/logo_100.png')); ?>">
		Ruang Konsultasi
	</div>
	<a href="<?php echo e(url('konsultan')); ?>" class="item xhr-req counter-belum-konsultasi">
		Konsultasi Baru
	</a>
	<a href="<?php echo e(url('konsultan/sudah-konsultasi')); ?>" class="item xhr-req counter-sudah-konsultasi">
		Sudah Konsultasi
	</a>
	<a class="item" href="<?php echo e(url('konsultan/'. auth()->guard('pegawai')->user()->id_pegawai.'/profil-saya')); ?>">
		Profil Saya
	</a>
	<a href="<?php echo e(url('konsultan/logout')); ?>" class="item">
		Logout
	</a>
</div>