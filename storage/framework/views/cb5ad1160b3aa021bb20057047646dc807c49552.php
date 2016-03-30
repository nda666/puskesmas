<?php $__env->startSection('title','Management Data Pasien'); ?>
<?php $__env->startSection('content_title','Management Data Pasien'); ?>
<?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
<i class="icon black user"></i>
<i class="icon corner red heart"></i>
</i>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_sub_title', 'Management dan Laporan'); ?>
<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/sweetalert2/sweetalert2.css')); ?>">
<style type="text/css">
	table.nowarp tr > th, table.nowarp tr > td {
		white-space: nowrap;
	}
	div.dt-buttons {
		float: none !important;
	}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrasi.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>