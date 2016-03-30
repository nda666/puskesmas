<!doctype html>
<head>
	<meta charset="utf-8"/>
	<title>Konsultan - <?php echo $__env->yieldContent('title'); ?></title>
	<script src="<?php echo e(asset('assets/pace/pace.min.js')); ?>"type="text/javascript" charset="utf-8">
	</script>
	<link rel="stylesheet" href="<?php echo e(asset('assets/pace/pace-minimal.css')); ?>"/>
	<link rel="stylesheet" href="<?php echo e(asset('assets/semantic-ui/semantic.min.css')); ?>"/>
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/master.css')); ?>"/>
	<?php echo $__env->yieldContent('stylesheet'); ?>
	<style type="text/css">
		body, html, .main.content {
			height: 100%;
		}
		.main.content {
			min-height: 100%;
		}
		.main.content .ui.row.grid {
			margin-bottom: 40px !important;
		}
		.ui[class*="top attached"].segment {
			border-radius:0 !important ;
		}
	body.pushable {
	background: #fff !important;
	}
	div#navbar {
	border-radius: 0;
	}
	.ui.vertical.menu .item>
	img.logo:not(.ui):only-child {
	display: inline-block !important;
	}
	.table.dataTable{
	width: 100% !important;
	}
	.pusher.content{
	background: #fff;
	}
	.pusher .ui.row.grid{
	margin: 0 !important;
	}
	.pushable > .pusher{
		overflow-y: auto;
	}
	</style>
	<script src="<?php echo e(asset('/assets/js/jquery.min.js')); ?>"type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo e(asset('assets/semantic-ui/semantic.min.js')); ?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo e(asset('assets/js/konsultan/konsultan.js')); ?>" type="text/javascript" charset="utf-8"></script>
</head>
<body class="pushable" id="master">
	<?php echo $__env->make('konsultan.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="pusher context-sidebar">
		<div class="main content">
			<div id="navbar" class="ui inverted blue menu">
				<a class="sidebar-toggle item">
					<i class="sidebar icon">
					</i>
				</a>
				<div class="item">
					<b><?php echo e('howdy!!! '. session()->get('data_pegawai')['nama_pegawai']); ?></b>
				</div>
				<div class="right menu">
					<a class="active red item" href="#">
						<i class="icon sign out">
						</i>
						Logout
					</a>
				</div>
			</div>
			<div id="loaded-content" class="ui row grid">
				<?php echo $__env->yieldContent('content_stylesheet'); ?>
				<?php echo $__env->yieldContent('javascript'); ?>
				<div class="sixteen wide column">
					<?php echo $__env->yieldContent('content'); ?>
					
				</div>
			</div>
			<div class="footer">
				<div class="ui black inverted vertical center aligned segment">
					<img class="logo" src="http://puskesmas.com/assets/img/logo_100.png">
					<p>Puskesmas Patrang<br>Jl. Kaca Piring No. 5 Patrang Kab. Jember, Jawa Timur<br>Hubungi Kami di:</p>
					<div class="ui horizontal divided relaxed inverted list">
						<div class="item"><i class="icon phone"></i>0331-484848</div>
						<a href="http://fb.com/Puskesmas_Patrang" class="item"><i class="facebook outline icon"></i> Puskesmas Patrang</a>
						<a href="http://twitter.com/@puskesmas_patrang" class="item"><i class="twitter outline icon"></i> @puskesmas_patrang</a>
						<a href="mailto:email@puskesmas_patrang.com" class="item"><i class="mail icon"></i> email@puskesmas_patrang.com</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>