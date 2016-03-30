<?php $__env->startSection('title', 'Data Pasien'); ?>
<?php $__env->startSection('content_title'); ?>
<i class="big icons"><i class="user thin icon"></i><i class="red mini corner heart icon"></i></i>
<div class="content">
	Data Pasien
	<div class="sub header">Kartu Rawat Jalan Pasien - Puskesmas Patrang</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui breadcrumb">
	<a href="<?php echo e(url('/')); ?>" class="section">Home</a>
	<i class="right chevron icon divider"></i>
	<a href="<?php echo e(route('pasien')); ?>" class="section">Data Pasien</a>
	<i class="right arrow icon divider"></i>
	<div class="active section">View Pasien</div>
</div>
<?php $__env->stopSection(); ?>
<?php /* Section Content */ ?>
<?php $__env->startSection('content'); ?>
<div style="padding-top: 0;" class="ui vertical segment">
	<div id="export-tool" class="ui small basic right floated icon buttons">
		<button data-content="Cetak ke printer" onclick="PrintPage('.content-wrapper')" class="ui button"><i class="print icon"></i></button>
		<button data-content="Simpan ke PDF" class="ui button"><i class="file pdf outline icon"></i></button>
		<button data-content="Simpan ke Office Word" class="ui button"><i class="file word outline icon"></i></button>
	</div>
	<?php foreach($obj_pasien as $pasien): ?>
	<h3 class="ui header">Data Pasien</h3>
	<table class="ui definition table">
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
	</table>
	<div class="ui horizontal section icon divider"><i class="icon user"></i></div>
	<?php if(count($pasien->ruang_konsul) > 0): ?>
	<h3 class="ui header">Data Konsultasi</h3>
	<?php foreach($pasien->ruang_konsul as $ruang_konsul): ?>
	<table class="ui definition table">
		<?php /* TANGGAL */ ?>
		<tr>
			<td class="six wide">Tanggal</td>
			<td><?php echo e($ruang_konsul->tanggal->format('d/m/Y')); ?></td>
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
	<?php endforeach; ?>
	<div class="ui horizontal section icon divider"><i class="icon treatment"></i></div>
	<?php endif; ?>
	<?php endforeach; ?>
</div>
<?php $__env->stopSection(); ?>
<?php /* End Section Content */ ?>
<?php echo $__env->make('default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>