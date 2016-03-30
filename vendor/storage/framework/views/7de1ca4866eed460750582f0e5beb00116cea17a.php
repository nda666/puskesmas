 <?php $__env->startSection('title','Data obat'); ?> <?php $__env->startSection('content_title','Management Obat'); ?> <?php $__env->startSection('content_sub_title','Tambah, Ubah dan Hapus Data Obat'); ?> <?php $__env->startSection('content_title_icon'); ?>
<i class="big icons"><i class="first aid icon"></i></i>
<?php $__env->stopSection(); ?> <?php $__env->startSection('breadcrumbs'); ?>
<div class="ui top attached panel-header segment">
	<div class="ui grid">
		<div class="six wide column computer">
			<b>List Obat</b>
		</div>
		<div class="right aligned ten wide column computer">
			<div class="ui breadcrumb">
				<a href="<?php echo e(url('administrasi')); ?>" class="section">
					<i class="icon black home"></i>Home</a>
				<span class="divider">/</span>
				<div class="section">
					<i class="icon first aid"></i>Management Obat</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?> <?php $__env->startSection('stylesheet'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTablesMod.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Select/css/select.dataTables.min.css')); ?>">

<style type="text/css">
	.ui.small.modal>.close {
		top: 0.7rem !important;
		right: 0.5rem !important;
		z-index: 200 !important;
		color: #333 !important;
	}

</style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/dataTables.semantic.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/serialize-object.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/yadcf/jquery.dataTables.yadcf.js')); ?>">
</script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/administrasi/obat.min.js')); ?>"></script>
<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div class="sixteen wide column computer">

	<div class="datatable-container">
		<table data-token="<?php echo e(csrf_token()); ?>" data-source="<?php echo e(url('administrasi/obat/data-index')); ?>" data-token="<?php echo e(csrf_token()); ?>" data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>" data-update="<?php echo e(url('ajax/obat/update')); ?>"
				data-delete="<?php echo e(url('ajax/obat/delete')); ?>" id="data-obat" class="ui unstackable definition celled table" width="100%">
			<thead>
				<tr>
					<th class="collapsing"></th>
					<th class="collapsing">ID</th>
					<th>Kode</th>
					<th>Nama</th>
					<th class="text-center collapsing">Action</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>

</div>
<?php echo $__env->make('administrasi.obat.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrasi.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>