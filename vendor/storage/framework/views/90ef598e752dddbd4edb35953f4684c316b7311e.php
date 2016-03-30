<div id="navbar" class="ui inverted top fixed menu">
	<div class="ui container">
		<div class="item">
			<a><i class="icon hospital"></i>Puskesmas</a>
			
		</div>
	</div>
	<?php if($data_pegawai = session('data_pegawai')): ?>
	<?php if(isset($data_pegawai['nama_pegawai']) && isset($data_pegawai['id_pegawai'])): ?>
	<div class="right menu">
		<a href="<?php echo e(url('myprofile/'. $data_pegawai['id_pegawai'])); ?>" class="ui item">
			<?php echo e($data_pegawai['nama_pegawai']); ?>

		</a>
		<a href="<?php echo e(url('logout')); ?>" class="ui item">
			Logout
		</a>
	</div>
	<?php endif; ?>
	<?php endif; ?>
</div>