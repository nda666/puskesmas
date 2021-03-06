 <?php $__env->startSection('title','Data Pegawai'); ?> <?php $__env->startSection('content_title','Management Pegawai'); ?> <?php $__env->startSection('content_sub_title','Tambah dan Ubah Data Pegawai'); ?> <?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
<i class="users icon"></i>
<i class="icon corner file text outline"></i>
</i>
<?php $__env->stopSection(); ?> <?php $__env->startSection('breadcrumbs'); ?>
<div class="ui top attached panel-header segment">
	<div class="ui grid">
		<div class="six wide column computer">
			<b>List Pegawai</b>
		</div>
		<div class="right aligned ten wide column computer">
			<div class="ui breadcrumb">
				<a href="<?php echo e(url('administrasi')); ?>" class="section">
					<i class="icon black home"></i>Home</a>
				<span class="divider">/</span>
				<div class="section">
					<i class="icon users"></i>Management Pegawai</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?> <?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css')); ?>">
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
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-address/jquery.address-1.5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/serialize-object.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/jquery.inputmask.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.date.extensions.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/yadcf/jquery.dataTables.yadcf.js')); ?>">
</script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/administrasi/pegawai.min.js')); ?>"></script>
<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div class="sixteen wide column computer">

	<div class="datatable-container">
		<table data-token="<?php echo e(csrf_token()); ?>" data-source="<?php echo e(url('administrasi/pegawai/data-pegawai')); ?>" data-token="<?php echo e(csrf_token()); ?>" data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>" data-update="<?php echo e(url('ajax/management-pegawai/update')); ?>"
				data-delete="<?php echo e(url('ajax/management-pegawai/delete')); ?>" id="data-pegawai" class="ui unstackable definition celled table" width="100%">
			<thead>
				<tr>
					<th class="collapsing"></th>
					<th class="collapsing">ID</th>
					<th>Username</th>
					<th>Nama Pegawai</th>
					<th>Gender</th>
					<th>Jabatan</th>
					<th class="text-center collapsing">Action</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>

</div>
<?php echo $__env->make('administrasi.pegawai.form.add-edit-pegawai', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="ui long small modal" id="modal-view">
	<i class="close icon"></i>
	<div class="header"></div>
	<div class="image content">
		<div class="image">
		<img class="ui medium image" data-name="foto" data-url="<?php echo e(asset('/')); ?>" data-male="<?php echo e(asset('foto-profil/default-l.jpg')); ?>" data-female="<?php echo e(asset('foto-profil/default-p.jpg')); ?>">
				</div>
		<div class="description">
		<table class="ui borderless bold-first table">
			<tr>
				<td width="30%">ID</td>
				<td data-name="id"></td>
			</tr>
			<tr>
				<td>Username</td>
				<td data-name="username"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td data-name="nama"></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td data-name="jenis_kelamin"></td>
			</tr>
			<tr>
				<td>Agama</td>
				<td data-name="agama"></td>
			</tr>
			<tr>
				<td>Tgl. Lahir</td>
				<td data-name="tgl_lahir"></td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td data-name="jabatan"></td>
			</tr>
			<tr>
				<td>No Telp</td>
				<td data-name="no_telp"></td>
			</tr>

		</table>
	</div>
	</div>
	<div class="actions">
		<button class="ui negative button"><i class="close icon"></i>Keluar</button>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrasi.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>