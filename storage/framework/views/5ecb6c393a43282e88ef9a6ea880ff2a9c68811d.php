<?php $__env->startSection('title','Pasien Sudah Konsultasi'); ?>
<?php $__env->startSection('content_stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/dataTables.semantic.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/jquery.dataTables.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/dataTables.semantic.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/konsultan/sudah-konsultasi.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<h3 class="ui header dividing blue">
<i class="big icons"><i class="treatment icon"></i><i class="icon corner green outline check"></i></i><div class="content">Sudah Konsultasi
	<div class="sub header">Data pasien yang sudah Konsultasi.</div>
</div>
</h3>
<div >
	<table id="table-sudah-konsultasi" class="ui compact selectable striped celled table"
		data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
		data-token="<?php echo e(csrf_token()); ?>"
		data-source="<?php echo e(url('konsultan/sudah-konsultasi/pasien-json')); ?>">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Umur</th>
				<th>Tanggal Daftar</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('konsultan.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>