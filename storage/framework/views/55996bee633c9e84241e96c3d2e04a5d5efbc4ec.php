<?php $__env->startSection('title','Konsultasi Pasien: '.$pasien->nama_pasien); ?>
<?php $__env->startSection('content_title','Manage Konsultasi Pasien'); ?>
<?php $__env->startSection('content_sub_title', 'Tambah, ubah, hapus dan kirim data konsultasi pasien'); ?>
<?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
<i class="icon treatment"></i>
<i class="icon corner green check"></i>
</i>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui blue top attached segment breadcrumb">
	<div class="ui breadcrumb">
		<a href="<?php echo e(url('administrasi')); ?>" class="section"><i class="icon home"></i>Home</a>
		<i class="right chevron icon divider"></i>
		<a href="<?php echo e(url('administrasi/belum-konsultasi/')); ?>" class="section"><i class="icon treatment"></i>Belum Konsultasi</a>
		<i class="right chevron icon divider"></i>
		<div class="active section"><i class="icon edit"></i>Manage</div>
	</div>
</div>
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
<link rel="stylesheet" type="text/css" href="/assets/sweetalert2/sweetalert2.css">
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
<script type="text/javascript" src="<?php echo e(asset('/assets/js/administrasi/belum-konsultasi-view.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div id="tab-konsultasi" class="ui blue menu">
		<a class="item" data-tab="data-pasien">Data Administrasi</a>
		<a class="active item" data-tab="form-konsultasi">Form Konsultasi</a>
	</div>
	<div class="ui vertical tab segment" data-tab="data-pasien">
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

	<div class="ui active tab vertical segment" data-tab="form-konsultasi">
		<table id="data-konsultasi" class="ui table"
			data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
			data-pasien = <?php echo e($pasien->id); ?>

			data-token="<?php echo e(csrf_token()); ?>"
			data-source="<?php echo e(url('administrasi/belum-konsultasi/json/view-konsultasi/'. $pasien->id)); ?>">
			<thead>
				<th>ID</th>
				<th>Pemeriksaan Fisik</th>
				<th>Diagnosa</th>
				<th>Tindakan</th>
				<th>Petugas</th>
				<th>Tgl Konsultasi</th>
			</thead>
		<tbody></tbody>
	</table>
</div>
<!-- Modal Insert -->
<div class="ui small modal" id="modal-insert">
	<div class="header">Form Konsultasi Pasien</div>
	<div class="content">
		<div class="ui icon message hidden">
			<i class="close icon"></i>
			<i id="response-icon" class="warning sign red icon"></i>
			<div class="content">
				<div class="header"></div>
				<p></p>
			</div>
		</div>
		<form id="form-konsultasi" class="ui form" action="<?php echo e(url('/administrasi/belum-konsultasi/ajax/simpan-konsultasi')); ?>" method="POST">
			<?php echo csrf_field(); ?>

			<input type="hidden" name="id">
			<input type="hidden" value="<?php echo e($pasien->id); ?>" id="id-pasien" name="id_pasien">
			<div class="field">
				<label>Nama Pasien:</label>
				<input type="text" value="<?php echo e($pasien->nama_pasien); ?>" readonly="" id="input-nama-pasien">
			</div>
			<div class="required field">
				<label>Anamesa / Pemeriksaan Fisik:</label>
				<textarea placeholder="Anamesa / Pemeriksaan Fisik" rows="3" name="pemeriksaan_fisik"></textarea>
			</div>
			<div class="required field">
				<label>Diagnosa:</label>
				<textarea rows="3" name="diagnosa" placeholder="Diagnosa"></textarea>
			</div>
			
			<div class="required field">
				<label>Pengobatan / Tindakan:</label>
				<textarea rows="3" name="tindakan" placeholder="Pengobatan / Tindakan"></textarea>
			</div>
			
		</form>
	</div>
	<div class="actions">
		<div class="ui cancel negative button"><i class="icon dont"></i>Cancel</div>
		<button id="submit-form-konsultasi" class="ui approve submit primary button"><i class="icon save"></i>Simpan</button>
	</div>
</div>
<!-- Modal Update-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrasi.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>