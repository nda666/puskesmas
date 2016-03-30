<?php $__env->startSection('title','Management & Laporan: Pasien'); ?>
<?php $__env->startSection('content_title','Management & Laporan: Pasien'); ?>

<?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
<i class="icon user"></i>
<i class="icon corner file text outline"></i>
</i>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui blue top attached segment breadcrumb">
	<div class="ui breadcrumb">
		<a href="<?php echo e(url('administrasi')); ?>" class="section"><i class="icon home"></i>Home</a>
		<i class="right chevron icon divider"></i>
		<div class="active section">
			<i class="icons">
			<i class="icon user"></i>
			<i class="icon corner file text outline"></i></i>Management & Laporan: Pasien
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_sub_title', 'Management dan Laporan'); ?>
<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/sweetalert2/sweetalert2.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Select/css/select.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/ColReorder/css/colReorder.dataTables.min.css')); ?>">
<style type="text/css">
.ui.small.modal>.close {
top: 0.7rem !important;
right: 0.5rem !important;
z-index: 200 !important;
color: #333 !important;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<!--
<script type="text/javascript" src="<?php echo e(asset('/assets/pdfmake/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/pdfmake/vfs_fonts.js')); ?>"></script>
-->
<script type="text/javascript" src="<?php echo e(asset('/assets/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jszip/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/dataTables.semantic.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.print.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.colVis.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Select/js/dataTables.select.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-address/jquery.address-1.5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/serialize-object.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/jquery.inputmask.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.date.extensions.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/administrasi/management-pasien.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="datatable-container">
	<table data-token="<?php echo e(csrf_token()); ?>"
		data-source="<?php echo e(url('administrasi/json/management-pasien')); ?>"
		data-token="<?php echo e(csrf_token()); ?>"
		data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
		data-update="<?php echo e(url('ajax/management-pasien/update')); ?>" data-delete="<?php echo e(url('ajax/management-pasien/delete')); ?>"
		id="data-pasien" class="ui unstackable blue single line celled table" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama</th>
				<th>Kepala Keluarga</th>
				<th>Pekerjaan</th>
				<th>Tgl. Lahir</th>
				<th>Agama</th>
				<th>Gender</th>
				<th>Alamat</th>
				<th>Kunjungan</th>
				<th>Kepesertaan</th>
				<th>Jam</th>
				<th>Konsultasi</th>
				<th>Resep</th>
				<th>Obat</th>
				<th>Petugas Admin.</th>
			</tr>
		</thead>
	<tbody></tbody>
</table>
</div>
<?php echo $__env->make('administrasi.management.form.edit-pasien', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrasi.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>