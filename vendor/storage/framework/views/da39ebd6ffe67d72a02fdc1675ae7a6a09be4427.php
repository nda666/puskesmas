<?php $__env->startSection('title','Hasil Konsultasi Pasien'); ?>
<?php $__env->startSection('content_title', 'Hasil Konsultasi Pasien'); ?>
<?php $__env->startSection('content_sub_title','Pasien ini sudah melakukan konsultasi, dan membutuhkan resep obat dari dokter'); ?>
<?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
<i class="icon black user"></i>
<i class="icon corner red heart"></i>
</i>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-address/jquery.address-1.5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/serialize-object.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/dataTables.semantic.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.print.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.colVis.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Select/js/dataTables.select.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/dokter/view-pasien.js')); ?>"></script>
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
	table.dataTable tbody tr {
		cursor: pointer;
	}
	.dataTables_wrapper .dataTables_info {
		float: right;
	}
</style>
<link rel="stylesheet" type="text/css" href="/assets/sweetalert2/sweetalert2.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="tab-dokter" class="ui pointing secondary menu">
	<a class="item" href="#/data-pasien" data-tab="data-pasien">Data Administrasi</a>
	<a class="item" href="#/data-konsultasi" data-tab="data-konsultasi">Data Konsultasi & Resep</a>
</div>
<div class="ui tab vertical segment" data-tab="data-pasien">
<h3 class="ui dividing header">Data Administrasi</h3>
	<table class="ui basic compact definition table">
		<tbody>
			<tr>
				<td width="30%">Nama</td>
				<td><?php echo e($pasien->nama_pasien); ?></td>
			</tr>
			<tr>
				<td>Kepala Keluarga</td>
				<td><?php echo e($pasien->nama_kepala_keluarga); ?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td><?php echo e($pasien->pekerjaan); ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><?php echo e($pasien->alamat); ?></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td><?php echo e($pasien->tgl_lahir->format('d-m-Y')); ?></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><?php echo e($pasien->jenis_kelamin); ?></td>
			</tr>
			<tr>
				<td>Agama</td>
				<td><?php echo e($pasien->agama); ?></td>
			</tr>
			<tr>
				<td>umur</td>
				<td><?php echo e($pasien->umur); ?></td>
			</tr>
			<tr>
				<td>Jenis Kunjungan</td>
				<td><?php echo e($pasien->jenis_kunjungan); ?></td>
			</tr>
			<tr>
				<td>Jenis Kepesertaan</td>
				<td><?php echo e($pasien->jenis_kepesertaan); ?></td>
			</tr>
			<tr>
				<td>Tanggal Administrasi</td>
				<td><?php echo e($pasien->tgl_daftar); ?></td>
			</tr>
			<tr>
				<td>Petugas Administrasi</td>
				<td><?php echo e($pasien->petugas->nama_pegawai); ?></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="ui tab vertical segment" data-tab="data-konsultasi">
<?php echo $__env->make('dokter.resep.datatables.view-konsultasi',['id_pasien' => $pasien->id], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dokter.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>