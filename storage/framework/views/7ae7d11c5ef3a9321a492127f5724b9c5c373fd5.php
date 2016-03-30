<?php $__env->startSection('title','Data Pasien:'.$pasien->nama_pasien); ?>
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
<script type="text/javascript" src="<?php echo e(asset('/assets/js/konsultan/view_pasien_sudah_konsul.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_title', 'Management Konsultasi'); ?>
<?php $__env->startSection('content_sub_title', 'Data administrasi pasien dan Form konsultasi'); ?>
<?php $__env->startSection('content_title_icon'); ?>
<i class="big icons"><i class="treatment icon"></i><i class="icon corner red heart"></i></i>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="tab-konsultasi" class="ui top attached tabular menu">
		<a class="item" data-tab="data-pasien">Data Administrasi</a>
		<a class="active item" data-tab="form-konsultasi">Form Konsultasi</a>
	</div>
	<div class="ui bottom attached tab segment" data-tab="data-pasien">
<h5 class="ui header dividing">Data Pasien <a class="toggler" href="#hidde-data-pasien" data-target="#data-pasien"><i class="icon double angle down"></i></a></h5>
<table id="data-pasien" class="ui definition table">
	<?php /* NAMA PASIEN */ ?>
	<tr>
		<td class="six wide">Nama Pasien</td>
		<td><?php echo e($pasien->nama_pasien); ?></td>
	</tr>
	<?php /* NAMA KEPALA KELUARGA */ ?>
	<tr>
		<td>Nama Kepala Keluarga</td>
		<td><?php echo e($pasien->nama_kepala_keluarga); ?></td>
	</tr>
	<?php /* JENIS KELAMIN */ ?>
	<tr>
		<td>Jenis Kelamin</td>
		<td><?php echo e($pasien->jenis_kelamin); ?></td>
	</tr>
	<?php /* TANGGAL LAHIR */ ?>
	<tr>
		<td>Tanggal Lahir</td>
		<td><?php echo e($pasien->tgl_lahir->format('d-m-Y')); ?></td>
	</tr>
	<?php /* PEKERJAAN */ ?>
	<tr>
		<td>Pekerjaan</td>
		<td><?php echo e($pasien->pekerjaan); ?></td>
	</tr>
	<?php /* UMUR */ ?>
	<tr>
		<td>Umur</td>
		<td><?php echo e($pasien->umur); ?></td>
	</tr>
	<?php /* ALAMAT */ ?>
	<tr>
		<td>Alamat</td>
		<td><?php echo e($pasien->alamat); ?></td>
	</tr>
	<?php /* AGAMA */ ?>
	<tr>
		<td>Agama</td>
		<td><?php echo e($pasien->agama); ?></td>
	</tr>
	<?php /* KUNJUNGAN */ ?>
	<tr>
		<td>Kunjungan</td>
		<td><?php echo e($pasien->jenis_kunjungan); ?></td>
	</tr>
	<?php /* KUNJUNGAN */ ?>
	<tr>
		<td>Kepesertaan</td>
		<td><?php echo e($pasien->jenis_kepesertaan); ?></td>
	</tr>
	<tr>
		<td>Petugas</td>
		<td><?php echo e($pasien->petugas->nama_pegawai); ?></td>
	</tr>
</table>
</div>
	<div class="ui bottom attached active tab segment" data-tab="form-konsultasi">
	<div class="datatable-container">
	<table id="data-konsultasi" class="ui unstackable red single line celled table" width="100%"
			data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
			data-token="<?php echo e(csrf_token()); ?>" data-pasien="<?php echo e($pasien->id); ?>"
			data-source="<?php echo e(url('konsultan/json/view-konsultasi/'. $pasien->id)); ?>">
			<thead>
			<tr>
				<th>ID</th>
				<th>Pemeriksaan Fisik</th>
				<th>Diagnosa</th>
				<th>Tindakan</th>
				<th>Petugas</th>
				<th>Tgl Konsultasi</th>
			</tr>
			</thead>
		<tbody></tbody>
	</table>
	</div>

<script type="text/javascript">
	$('.toggler').on('click', function(e) {
	e.preventDefault();
	$($(this).data('target')).transition('fade up');
	$(this).find('i').hasClass('down') ? $(this).find('i').removeClass('down').addClass('up') : $(this).find('i').removeClass('up').addClass('down');
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('konsultan.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>