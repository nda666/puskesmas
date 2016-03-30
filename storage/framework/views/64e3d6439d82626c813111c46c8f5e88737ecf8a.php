<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<title>Administrasi - <?php echo $__env->yieldContent('title'); ?></title>
		<link rel="stylesheet" href="<?php echo e(asset('assets/semantic-ui/semantic.min.css')); ?>"/>
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/master.css')); ?>"/>
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/dokter.css')); ?>"/>
		<?php echo $__env->yieldContent('stylesheet'); ?>
		<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-address/samples/api/jquery-1.8.2.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('/assets/noty/packaged/jquery.noty.packaged.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('/assets/noty/layouts/inline.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('assets/semantic-ui/semantic.min.js')); ?>"></script>
		
		<script type="text/javascript" src="<?php echo e(asset('/assets/js/master.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(asset('assets/js/administrasi/administrasi.js')); ?>"></script>
	</head>
	<body id="master">
		<?php echo $__env->make('administrasi.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="pusher context-sidebar">
			<div class="main content">
				<div class="toc">
					<?php echo $__env->make('administrasi.left-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div id="loaded-content" class="ui row grid">
					<?php echo $__env->make('administrasi.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->yieldContent('content_stylesheet'); ?>
					<div style="min-height: 700px;" class="sixteen wide column">
						<h3 class="ui header">Dashboard</h3>
						<?php echo $__env->yieldContent('content'); ?>
					</div>
					<div id="footer">
						<div class="ui vertical blue center aligned segment">
							<img class="logo" src="<?php echo e(asset('assets/img/logo_100.png')); ?>">
							<p>Puskesmas Patrang<br>Jl. Kaca Piring No. 5 Patrang Kab. Jember, Jawa Timur</p>
							<div class="ui horizontal divided relaxed list">
								<div class="item"><i class="icon phone"></i>0331-484848</div>
								<a href="http://fb.com/Puskesmas_Patrang" class="item">
									<i class="facebook outline icon"></i> Puskesmas Patrang
								</a>
								<a href="http://twitter.com/@puskesmas_patrang" class="item">
									<i class="twitter outline icon"></i> @puskesmas_patrang
								</a>
								<a href="mailto:email@puskesmas_patrang.com" class="item">
									<i class="mail icon"></i> email@puskesmas_patrang.com
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php echo $__env->yieldContent('javascript'); ?>
		</div>
	</body>
</html>
