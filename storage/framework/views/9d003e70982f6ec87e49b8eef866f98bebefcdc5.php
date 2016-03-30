<?php $__env->startSection('title','Ruang Resep'); ?>
<?php $__env->startSection('content_title','Data Pasien'); ?>
<?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
<i class="icon black user"></i>
<i class="icon corner red heart"></i>
</i>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_sub_title', 'List pasien belum menerima resep obat'); ?>
<?php $__env->startSection('javascript'); ?>
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
<script type="text/javascript" src="<?php echo e(asset('/assets/js/dokter/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('stylesheet'); ?>
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
<?php $__env->startSection('content'); ?>
<div class="datatable-container">
	<table id="data-pasien" class="ui unstackable teal single line celled table" width="100%"
		data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
		data-source="<?php echo e(url('dokter/json/pasien_butuh_resep')); ?>">
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
				<th>Resep</th>
				<th>Petugas Admin.</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dokter.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>