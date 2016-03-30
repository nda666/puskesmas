<?php $__env->startSection('content_title'); ?>
<i class="treatment huge icon"></i>
<div class="content">
	Ruang Konsul
	<div class="sub header">Detail Konsultasi Pasien</div>
</div>
<?php $__env->stopSection(); ?>
<?php /* BREADCRUBMS */ ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui breadcrumb">
	<div class="ui breadcrumb">
		<a class="section">Home</a>
		<i class="right chevron icon divider"></i>
		<a href="<?php echo e(route('ruang-konsul')); ?>" class="section">Ruang Konsultasi</a>
		<i class="right arrow icon divider"></i>
		<div class="active section">Details</div>
	</div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="ui vertical segment">
	<?php foreach($obj_ruang_konsul as $ruang_konsul): ?>
	<h3 class="ui header">Data Pasien</h3>
	<table class="ui definition table">
		<?php /* NAMA PASIEN */ ?>
		<tr>
			<td class="six wide">Nama Pasien</td>
			<td><?php echo e($ruang_konsul->pasien->nama_pasien); ?></td>
		</tr>
		<?php /* NAMA KEPALA KELUARGA */ ?>
		<tr>
			<td>Nama Kepala Keluarga</td>
			<td><?php echo e($ruang_konsul->pasien->nama_kepala_keluarga); ?></td>
		</tr>
		<?php /* JENIS KELAMIN */ ?>
		<tr>
			<td>Jenis Kelamin</td>
			<td><?php echo e($ruang_konsul->pasien->jenis_kelamin); ?></td>
		</tr>
		<?php /* TANGGAL LAHIR */ ?>
		<tr>
			<td>Tanggal Lahir</td>
			<td><?php echo e($ruang_konsul->pasien->tgl_lahir->format('d-m-Y')); ?></td>
		</tr>
		<?php /* PEKERJAAN */ ?>
		<tr>
			<td>Pekerjaan</td>
			<td><?php echo e($ruang_konsul->pasien->pekerjaan); ?></td>
		</tr>
		<?php /* UMUR */ ?>
		<tr>
			<td>Umur</td>
			<td><?php echo e($ruang_konsul->pasien->umur); ?></td>
		</tr>
		<?php /* ALAMAT */ ?>
		<tr>
			<td>Alamat</td>
			<td><?php echo e($ruang_konsul->pasien->alamat); ?></td>
		</tr>
		<?php /* AGAMA */ ?>
		<tr>
			<td>Agama</td>
			<td><?php echo e($ruang_konsul->pasien->agama); ?></td>
		</tr>
	</table>
	<div class="ui horizontal section icon divider"><i class="icon user"></i></div>
	<h3 class="ui header">Data Konsultasi</h3>
	<table class="ui definition table">
		<?php /* TANGGAL */ ?>
		<tr>
			<td class="six wide">Tanggal</td>
			<td><?php echo e($ruang_konsul->tanggal); ?></td>
		</tr>
		<?php /* JAM */ ?>
		<tr>
			<td>Jam</td>
			<td><?php echo e($ruang_konsul->jam); ?></td>
		</tr>
		<?php /* PEMERIKSAAN FISIK */ ?>
		<tr>
			<td>Pemeriksaan Fisik</td>
			<td><?php echo e($ruang_konsul->pemeriksaan_fisik); ?></td>
		</tr>
		<?php /* DIAGNOSA */ ?>
		<tr>
			<td>Diagnosa</td>
			<td><?php echo e($ruang_konsul->diagnosa); ?></td>
		</tr>
		<?php /* TINDAKAN */ ?>
		<tr>
			<td>Tindakan</td>
			<td><?php echo e($ruang_konsul->tindakan); ?></td>
		</tr>
	</table>
	<div class="ui horizontal section icon divider"><i class="icon treatment"></i></div>
	<?php endforeach; ?>
	
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>