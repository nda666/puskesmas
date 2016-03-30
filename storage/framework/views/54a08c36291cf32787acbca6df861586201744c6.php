<!doctype html>
<head>
	<meta charset="utf-8">
	<title><?php echo $__env->yieldContent('title'); ?></title>
	<script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"
	type="text/javascript" charset="utf-8"></script>
	<style type="text/css" media="screen">
	.no-js #loader {
		display: none;
	}
	.js #loader {
		display: block;
		position: fixed;
		background: #333;
		height: 100%;
		width: 100%;
	}
	</style>
	<script type="text/javascript" charset="utf-8">
			$(window).load(function(){
				$('.dimming').addClass('active');
			});
	</script>
	<link rel="stylesheet"
		href="<?php echo e(asset('assets/semantic-ui/semantic.min.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/master.css')); ?>">
		<?php echo $__env->yieldContent('stylesheet'); ?>
	</head>
	<body id="master">
		<div class="dimming"></div>
		<?php echo $__env->make('navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="master-container">
			<div id="container-sidebar" class="master-sidebar computer only column">
				<?php echo $__env->make('sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
			<div id="main-content" class="main sixteen wide column">
				<div class="content-wrapper">
					<?php echo $__env->yieldContent('breadcrumbs'); ?>
					<h2 class="ui dividing header"><?php echo $__env->yieldContent('content_title'); ?></h2>
					<?php echo $__env->make('message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->yieldContent('content'); ?>
				</div>
						
			</div>
		</div>
		<?php echo $__env->make('footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
		<script src="<?php echo e(asset('assets/semantic-ui/semantic.min.js')); ?>"
		type="text/javascript" charset="utf-8"></script>
		<?php echo $__env->yieldContent('javascript'); ?>
		<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$(window).resize(function(){
				var h = $('#sticky-sidebar').height();
				$('#container-sidebar').css('min-height',h+'px');
				$('.master-container').css('min-height', ($(window).height() - $('#footer').height()) + 'px');
			})
			$(window).trigger('resize');
			$('#sticky-sidebar').sticky({
				context: '#container-sidebar',
				offset: 50,
			});

			$('.message .close').on('click', function() {
    			$(this).closest('.message').transition('fade');
  			});

		});
		</script>
	</body>