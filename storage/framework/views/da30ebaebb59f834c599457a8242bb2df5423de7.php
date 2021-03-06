<?php $__env->startSection('title','Pendaftaran Anggota & Rawat Jalan'); ?>
<?php $__env->startSection('content_title','Pendaftaran Anggota & Rawat Jalan'); ?>
<?php $__env->startSection('content_sub_title', 'Pendaftaran Anggota Baru dan Pendaftaran Rawat Jalan'); ?>
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

<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/sweetalert2/sweetalert2.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/css/proc.datatable.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/FixedHeader/css/fixedHeader.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/yadcf/jquery.dataTables.yadcf.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Select/css/select.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Scroller/css/scroller.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/ColReorder/css/colReorder.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/css/animate.css')); ?>">
<style type="text/css">
.ui.modal>.close {
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
<script type="text/javascript" src="<?php echo e(asset('/assets/jszip/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/dataTables.semantic.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Scroller/js/dataTables.scroller.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.print.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.colVis.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Select/js/dataTables.select.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/serialize-object.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/yadcf/jquery.dataTables.yadcf.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/jquery.inputmask.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.date.extensions.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/administrasi/pendaftaran-rawat-jalan.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="datatable-container">
	<table  id="data-pasien" class="ui striped single line celled table compact"
		data-token="<?php echo e(csrf_token()); ?>" data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
		data-source="<?php echo e(url('administrasi/pendaftaran/list-pasien')); ?>">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama</th>
				<th>Kepala Keluarga</th>
				<th>No. KK</th>
				<th>Pekerjaan</th>
				<th>Tgl. Lahir</th>
				<th>Agama</th>
				<th>Gender</th>
				<th>Alamat</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<!-- Modal Pendaftaran Baru -->
<div id="pendaftaran-baru" class="ui modal">
	<div class="header">Pendaftaran Baru</div>
	<i class="link close icon"></i>
	<div class="content">
		<?php echo $__env->make('administrasi.pendaftaran.form-baru', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<div class="actions">
		<div class="ui cancel negative button"><i class="close icon"></i>Batal</div>
		<div class="ui approve positive button"><i class="save icon"></i>Simpan</div>
	</div>
</div>

<!-- Modal Ubah data pasien -->

<div id="ubah-data" class="ui modal">
	<div class="header">Pendaftaran Baru</div>
	<i class="link close icon"></i>
	<div class="content">
		<?php echo $__env->make('administrasi.pendaftaran.form-ubah', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<div class="actions">
		<div class="ui cancel negative button"><i class="close icon"></i>Batal</div>
		<div class="ui approve positive button"><i class="save icon"></i>Simpan</div>
	</div>
</div>

<!-- Modal Daftar Rawat Jalan pasien -->

<div id="daftar-rawat-jalan" class="ui small modal">
	<div class="header">Pendaftaran Rawat Jalan</div>
	<i class="link close icon"></i>
	<div class="content">
		<?php echo $__env->make('administrasi.pendaftaran.form-rawat-jalan', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<div class="actions">
		<div class="ui cancel negative button"><i class="close icon"></i>Batal</div>
		<div class="ui approve positive button"><i class="save icon"></i>Simpan</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrasi.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>