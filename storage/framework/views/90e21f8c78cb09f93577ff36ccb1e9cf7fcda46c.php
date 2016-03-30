 <?php $__env->startSection('title','Profil Saya'); ?> <?php $__env->startSection('content_title', 'Profil Saya'); ?> <?php $__env->startSection('content_sub_title', 'Ubah data dan password pengguna'); ?> <?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
<i class="user icon"></i>
</i>
<?php $__env->stopSection(); ?> <?php $__env->startSection('breadcrumbs'); ?>
<div class="ui blue top attached segment breadcrumb">
	<div class="ui breadcrumb">
		<a href="<?php echo e(url('administrasi')); ?>" class="section"><i class="icon home"></i>Home</a>
		<i class="right chevron icon divider"></i>
		<div class="active section"><i class="icon user"></i>Profil Saya</div>
	</div>
</div>
<?php $__env->stopSection(); ?> <?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-address/jquery.address-1.5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/profile.js')); ?>"></script>
<script type="text/javascript">
	$('#tab-menu .item').tab({
		history: true
	})

</script>
<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<?php $pegawai = auth()->guard('pegawai')->user(); ?>
<div class="sixteen wide column">
	<div id="tab-menu" class="ui pointing fluid menu">
		<a class="active item" data-tab="my-profile">Profil Saya</a>
		<a class="item" data-tab="password">Ubah Password</a>
	</div>
	<div class="ui tab vertical segment" data-tab="my-profile">
		<?php if(session('response')): ?>
		<div class="ui <?php if(session('response') == false): ?> error <?php endif; ?> icon message">
			<?php if(session('response')): ?>
			<i class="icon check"></i> <?php else: ?>
			<i class="icon close"></i> <?php endif; ?>
			<div class="content">
				<p><?php echo session('message'); ?></p>
			</div>
		</div>
		<?php endif; ?> <?php if(count($errors) > 0): ?>
		<div class="ui error icon message">
			<i class="icon warning sign"></i>
			<p>
				<ul>
					<?php foreach($errors->all() as $error): ?>
					<li><?php echo e($error); ?></li>
					<?php endforeach; ?>
				</ul>
			</p>
		</div>
		<?php endif; ?>
		<div class="ui centered grid">
			<div class="eight wide mobile six wide computer column">
					<div style="margin: 0 auto;" class="ui special card">

						<div class="blurring dimmable image">
							<div class="ui dimmer">
								<div class="content">
									<div class="center">
										<p>Max Ukuran: 2MB (.jpg, png, bmp)</p>
										<div class="ui ubah-foto inverted button">Ubah Foto</div>
										<form action="<?php echo e(url('administrasi/update/update-foto')); ?>" enctype="multipart/form-data" class="form-ubah-foto">
											<?php echo e(csrf_field()); ?>

											<input type="hidden" name="id" value="<?php echo e($pegawai->id); ?>" />
											<input type="file" name="foto" style="height: 0.1px !important; width:0.1px !important;" />
										</form>
									</div>
								</div>
							</div>
							<?php if(!$pegawai->foto ||$pegawai->foto == null): ?> <?php if(auth()->guard('pegawai')->user()->jenis_kelamin == 'Laki-Laki'): ?>
							<img class="foto-profil" src="<?php echo e(url('foto-profil/default-l.jpg')); ?>" /> <?php else: ?>
							<img class="foto-profil" src="<?php echo e(url('foto-profil/default-p.jpg')); ?>" /> <?php endif; ?> <?php else: ?>
							<img class="foto-profil" src="<?php echo e(asset(auth()->guard('pegawai')->user()->foto)); ?>" /> <?php endif; ?>
						</div>
						<div class="content">
							<div class="header"><?php echo e($pegawai->nama); ?></div>
							<div class="meta">
								<a><?php echo e($pegawai->jabatan); ?></a>
							</div>
						</div>
					</div>
				</div>
			<div class="ten wide computer column">
				<?php echo $__env->make('auth.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div>
	<div class="ui bottom attached tab segment" data-tab="password">
		<?php echo $__env->make('auth.password', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrasi.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>