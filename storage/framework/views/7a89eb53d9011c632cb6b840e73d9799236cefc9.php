<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="<?php echo e(asset('/assets/img/favicon.ico')); ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo e(asset('/assets/img/favicon.ico')); ?>" type="image/x-icon">
		<title>Administrasi - <?php echo $__env->yieldContent('title'); ?></title>
		<style type="text/css">
			.state-hide {
				display: none !important;
			}
		</style>
		<link rel="stylesheet" href="<?php echo e(asset('assets/semantic-ui/semantic.min.css')); ?>"/>
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/master.css')); ?>"/>
		<?php echo $__env->yieldContent('stylesheet'); ?>
	</head>
	<body id="master">
		<?php echo $__env->make('administrasi.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="pusher context-sidebar">
			<div class="main content">
				<div class="toc blue-black">
					<?php echo $__env->make('administrasi.left-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div id="loaded-content" class="ui row grid">
					<?php echo $__env->make('administrasi.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->yieldContent('content_stylesheet'); ?>
					<div style="min-height: 700px;" class="sixteen wide column">
						<h3 class="ui header">
						<?php echo $__env->yieldContent('content_title_icon'); ?>
						<div class="content"><?php echo $__env->yieldContent('content_title'); ?>
							<div class="sub header"><?php echo $__env->yieldContent('content_sub_title'); ?></div>
						</div>
						</h3>
						<?php echo $__env->yieldContent('breadcrumbs'); ?>
						<div style="min-height: 600px;" class="ui attached segment">
							<div class="ui grid">
								<?php echo $__env->yieldContent('content'); ?>
							</div>
						</div>
					</div>
					<div id="footer" class="ui grid">
						<div class="six wide computer column">
							<?php $copyright_year =  \Carbon\Carbon::now()->format('Y'); ?>
							<p>
							<?php if($copyright_year > 2016): ?>
								Copyright © 2016 - <?php echo e($year); ?>

								<?php else: ?>
								Copyright © 2016
							<?php endif; ?>
							Puskesmas Patrang<br>Jl. Kaca Piring No. 5 Patrang Kab. Jember, Jawa Timur</p>
						</div>
						<div id="contacts" class="right aligned ten wide computer column">
							<div class="ui horizontal divided list">
								<div class="item"><i class="icon phone"></i>0331-484848</div>
								<a href="http://fb.com/Puskesmas_Patrang" class="item">
									<i class="facebook violet icon"></i> Puskesmas Patrang
								</a>
								<a href="http://twitter.com/@puskesmas_patrang" class="item">
									<i class="twitter blue icon"></i> @puskesmas_patrang
								</a>
								<a href="mailto:email@puskesmas_patrang.com" class="item">
									<i class="mail red icon"></i> email@puskesmas_patrang.com
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-address/samples/api/jquery-1.8.2.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('/assets/noty/packaged/jquery.noty.packaged.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('/assets/noty/layouts/inline.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('assets/semantic-ui/semantic.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('/assets/js/master.min.js')); ?>"></script>
	<?php echo $__env->yieldContent('javascript'); ?>
</html>
