<?php $__env->startSection('title','Data Pasien:'.$pasien->nama_pasien); ?>
<?php $__env->startSection('content'); ?>
<h3 class="ui header dividing blue">
<i class="big icons"><i class="treatment icon"></i><i class="icon corner red heart"></i></i><div class="content">Data Pasien Sudah Konsultasi
	<div class="sub header">Data pasien ini hanya rekapitulasi. Tidak akan muncul lagi ketika pasien sudah menerima Resep Obat dari Dokter.</div>
</div>
</h3>
<button type="button" class="ui icon labeled negative button" onclick="window.history.back();"><i class="left arrow icon"></i>Kembali</button>

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
<?php if(isset($pasien->ruang_konsul)): ?>
<h5 class="ui header dividing">Data Konsultasi<a class="toggler" href="#hidde-data-pasien" data-target=".data-konsultasi"><i class="icon double angle down"></i></a></h5>
<?php foreach($pasien->ruang_konsul as $konsultasi): ?>
<table class="ui data-konsultasi definition table">
	<tr>
		<td class="six wide">ID Konsultasi</td>
		<td><?php echo e($konsultasi->id); ?></td>
	</tr>
	<tr>
		<td class="six wide">Pemeriksaan Fisik</td>
		<td><?php echo e($konsultasi->pemeriksaan_fisik); ?></td>
	</tr>
	<tr>
		<td class="six wide">Diagnosa</td>
		<td><?php echo e($konsultasi->diagnosa); ?></td>
	</tr>
	<tr>
		<td class="six wide">Tindakan</td>
		<td><?php echo e($konsultasi->tindakan); ?></td>
	</tr>
	<tr>
		<td class="six wide">Tanggal</td>
		<td><?php echo e($konsultasi->tanggal->format('d-m-Y H:i')); ?></td>
	</tr>
	<tr>
		<td class="six wide">Petugas</td>
		<td><?php echo e($konsultasi->nama_pegawai); ?></td>
	</tr>
</table>
<?php endforeach; ?>
<?php endif; ?>
<button type="button" class="ui icon labeled negative button" onclick="window.history.back();"><i class="left arrow icon"></i>Kembali</button>

<script type="text/javascript">
	$('.toggler').on('click', function(e) {
	e.preventDefault();
	$($(this).data('target')).transition('fade up');
	$(this).find('i').hasClass('down') ? $(this).find('i').removeClass('down').addClass('up') : $(this).find('i').removeClass('up').addClass('down');
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('konsultan.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>