<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<title>Ruang Konsultasi - <?php echo $__env->yieldContent('title'); ?></title>
		<link rel="stylesheet" href="<?php echo e(asset('assets/semantic-ui/semantic.min.css')); ?>"/>
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/master.css')); ?>"/>
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/dokter.css')); ?>"/>
		<?php echo $__env->yieldContent('stylesheet'); ?>
		<script src="<?php echo e(asset('/assets/jquery-address/samples/api/jquery-1.8.2.min.js')); ?>"type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo e(asset('assets/semantic-ui/semantic.min.js')); ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo e(asset('assets/js/master.js')); ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo e(asset('assets/js/konsultan/konsultan.js')); ?>" type="text/javascript" charset="utf-8"></script>
	</head>
	<body class="pushable" id="master">
		<?php echo $__env->make('konsultan.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="pusher context-sidebar">
			<div class="main content">
				<div class="toc">
					<?php echo $__env->make('konsultan.left-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div id="loaded-content" class="ui row grid">
					<?php echo $__env->make('konsultan.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->yieldContent('content_stylesheet'); ?>
					<div style="min-height: 740px;" class="sixteen wide column">
						<h3 class="ui header dividing">
						<?php echo $__env->yieldContent('content_title_icon'); ?>
						<div class="content"><?php echo $__env->yieldContent('content_title'); ?>
							<div class="sub header"><?php echo $__env->yieldContent('content_sub_title'); ?></div>
						</div>
						</h3>
						<div style="min-height: 550px;" class="ui segment">
						<?php echo $__env->yieldContent('content'); ?>
						</div>
						<div id="footer">
						<div class="ui vertical red center aligned segment">
							<img class="logo" src="<?php echo e(asset('assets/img/logo_100.png')); ?>">
							<p>Puskesmas Patrang<br>Jl. Kaca Piring No. 5 Patrang Kab. Jember, Jawa Timur</p>
							<div class="ui horizontal divided relaxed list">
								<div class="item"><i class="icon phone"></i>0331-484848</div>
								<a href="http://fb.com/Puskesmas_Patrang" class="item"><i class="facebook outline icon"></i> Puskesmas Patrang</a>
								<a href="http://twitter.com/@puskesmas_patrang" class="item"><i class="twitter outline icon"></i> @puskesmas_patrang</a>
								<a href="mailto:email@puskesmas_patrang.com" class="item"><i class="mail icon"></i> email@puskesmas_patrang.com</a>
							</div>
						</div>
					</div>
					</div>
					
				</div>
			</div>
			
		</div>
		<?php echo $__env->yieldContent('javascript'); ?>
	</body>
</html>