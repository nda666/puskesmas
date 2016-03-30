 <?php $__env->startSection('title','Profile'); ?> <?php $__env->startSection('content_title', 'Profile'); ?> <?php $__env->startSection('content_sub_title', 'Ubah data dan password pengguna'); ?> <?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
<i class="settings icon"></i>
</i>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
	<div class="ui top attached panel-header segment">
	  <div class="ui grid">
	    <div class="six wide column computer">
	      <h4 class="ui header" id="panel-title"></h4>
	    </div>
	    <div class="right aligned ten wide column computer">
	      <div class="ui breadcrumb">
					<?php $pegawai = auth()->guard('pegawai')->user(); ?>
	        <a href="<?php echo e(url(strtolower($pegawai->jabatan).'')); ?>" class="section">
	          <i class="icon black home"></i>Home</a>
	        <span class="divider">/</span>
	        <div class="section">
	          <i class="icon settings"></i>My Profile</div>
	      </div>
	    </div>
	  </div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-address/jquery.address-1.5.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('/assets/js/profile.js')); ?>"></script>
<script type="text/javascript">
	$('#tab-menu .item').tab({
		history: true,
		onLoad: function(e, f){
			switch (e){
				case 'my-profile':
				$('#panel-title').text('Profil Saya');
				break;
				case 'password':
				$('#panel-title').text('Ubah Password');
				break;
				default:
				break;
			}
		}
	});
	</script>
	<?php if(session('response')): ?>
	<script type="text/javascript">
		$(document).ready(function(e){
			$('a[data-tab="password"]').click();
		})
	</script>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $pegawai = auth()->guard('pegawai')->user(); ?>
<div class="sixteen wide column">
	<div id="tab-menu" class="ui stackable fluid menu">
		<a class="active item" data-tab="my-profile">Profil Saya</a>
		<a class="item" data-tab="password">Ubah Password</a>
	</div>
	<?php /* Message Flash */ ?>
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
	<?php /* End of Message Flash */ ?>
	<div class="ui tab vertical segment no-border-bottom" data-tab="my-profile">
		<div class="ui centered grid">
			<div class="eight wide mobile six wide computer column">
				<div style="margin: 0 auto;" class="ui special card">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
							<div class="content">
								<div class="center">
									<p>Max Ukuran: 2MB (.jpg, png, bmp)</p>
									<div class="ui ubah-foto inverted button">Ubah Foto</div>
									<form action="<?php echo e(url(strtolower($pegawai->jabatan).'/profile/update-foto')); ?>" enctype="multipart/form-data" class="form-ubah-foto">
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
	<div class="ui vertical tab segment no-border-bottom" data-tab="password">
		<?php echo $__env->make('auth.password', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(strtolower($pegawai->jabatan).'.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>