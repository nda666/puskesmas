<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-address/jquery.address-1.5.min.js')); ?>"></script>
<script type="text/javascript">
	$('#tab-menu .item').tab({
		history: true
	})
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="tab-menu" class="ui top attached tabular menu">
	<a class="active item" data-tab="my-profile">Profil Saya</a>
	<a class="item" data-tab="password">Ubah Password</a>
</div>
<div class="ui bottom attached active tab segment" data-tab="my-profile">
<?php if(session('response')): ?>
<div class="ui <?php if(session('response') == false): ?> error <?php endif; ?> icon message">
	<?php if(session('response')): ?>
	<i class="icon check"></i>
	<?php else: ?>
	<i class="icon close"></i>
	<?php endif; ?>
	<div class="content">
		<p><?php echo session('message'); ?></p>
	</div>
</div>
<?php endif; ?>
<?php if(count($errors) > 0): ?>
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
	<?php echo $__env->make('auth.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="ui bottom attached tab segment" data-tab="password">
	<?php echo $__env->make('auth.password', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('konsultan.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>