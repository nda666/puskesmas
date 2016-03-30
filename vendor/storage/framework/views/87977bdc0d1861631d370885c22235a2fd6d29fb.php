<?php $__env->startSection('title','Pasien Belum Konsultasi'); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/jquery.dataTables.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/dataTables.semantic.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/konsultan/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTables.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<h3 class="ui header dividing blue">
<i class="big icons"><i class="treatment icon"></i><i class="icon corner red heart"></i></i><div class="content">Konsultasi
	<div class="sub header">Data Pasien Yang Akan Konsultasi</div>
</div>
</h3>
<div>
	<table class="ui celled table"
		data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
		data-token="<?php echo e(csrf_token()); ?>"
		data-source="<?php echo e(url('konsultan/belum-konsultasi/pasien-json')); ?>" id="table-job-list">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Umur</th>
				<th>Tanggal Daftar</th>
				<th class="ui center aligned">Actions</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>
</div>
<div class="ui small modal" id="modal-insert">
<i class="close circular inverted red icon"></i>
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
	<form class="ui form" id="form-konsultasi" action="<?php echo e(url('konsultan/simpan')); ?>" method="POST">
		<?php echo csrf_field(); ?>

		<input type="hidden" id="id-pasien" name="id_pasien">
		<div class="field">
			<label>Nama Pasien:</label>
			<input type="text" readonly="" id="input-nama-pasien">
		</div>
		<div class="required field">
			<label>Anamesa / Pemeriksaan Fisik:</label>
			<textarea rows="3" name="pemeriksaan_fisik"></textarea>
		</div>
		
		<div class="required field">
			<label>Diagnosa:</label>
			<textarea rows="3" name="diagnosa" placeholder="Diagnosa"></textarea>
		</div>
		
		<div class="required field">
			<label>Pengobatan / Tindakan:</label>
			<textarea rows="3" name="tindakan" placeholder="Pengobatan / Tindakan"></textarea>
		</div>
		
		<div class="ui segment">
			<div class="ui checkbox">
				<input type="checkbox" value="1" name="sudah_konsultasi">
				<label>Check Sudah Konsultasi <b>(Apabila memang sudah selesai konsultasi)</b></label>
			</div>
		</div>

	</form>
</div>
<div class="actions">
	<div class="ui cancel negative button"><i class="icon dont"></i>Cancel</div>
	<button id="submit-form-konsultasi" class="ui approve primary button"><i class="icon save"></i>Simpan</button>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('konsultan.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>