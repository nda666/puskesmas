<?php $__env->startSection('title','Data Pasien: '.$pasien->nama_pasien); ?>
<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTables.css')); ?>">
<link rel="stylesheet" type="text/css" href="/assets/sweetalert2/sweetalert2.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	load_script([
		'/assets/js/serialize-object.js',
		'/assets/datatables/media/js/jquery.dataTables.js',
		'/assets/datatables/media/js/dataTables.semantic.js',
		'/assets/js/konsultan/view_pasien.js',
		'/assets/sweetalert2/sweetalert2.min.js'
	])
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<h3 class="ui header dividing blue">
<i class="big icons"><i class="treatment icon"></i><i class="icon corner red heart"></i></i><div class="content">Data Pasien
	<div class="sub header">Data Pasien Yang Akan Konsultasi</div>
</div>
</h3>
<button type="button" class="ui icon labeled negative button" onclick="window.history.back();"><i class="left arrow icon"></i>Kembali</button>
<button type="button" class="ui modal-insert icon primary button"><i class="plus icon"></i>Input Konsultasi</button>
<button type="button"
data-content="Kirim data pasien ke Dokter"
data-url="<?php echo e(url('konsultan/data-pasien/'.$pasien->no_index.'/cek-konsultasi')); ?>"
data-token="<?php echo e(csrf_token()); ?>" data-pasien="<?php echo e($pasien->no_index); ?>"
class="ui icon right labeled positive button simpan-data-pasien">
<i class="save icon"></i>Simpan
</button>
<div id="tab-konsultasi" class="ui top attached tabular menu">
	<a class="item" data-tab="first">Data Pasien</a>
	<a class="active item" data-tab="second">Data Konsultasi</a>
</div>
<div class="ui bottom attached tab segment" data-tab="first">
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
<div class="ui bottom attached active tab segment" data-tab="second">
	<table id="data-konsultasi" class="ui table"
		data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
		data-token="<?php echo e(csrf_token()); ?>"
		data-source="<?php echo e(url('konsultan/konsultasi/view_konsultasi_json/'. $pasien->no_index)); ?>">
		<thead>
			<th>ID</th>
			<th>Pemeriksaan Fisik</th>
			<th>Diagnosa</th>
			<th>Tindakan</th>
			<th>Petugas</th>
			<th>Action</th>
		</thead>
	<tbody></tbody>
</table>
</div>
<div class="ui vertical segment">
<button type="button" class="ui icon labeled negative button" onclick="window.history.back();"><i class="left arrow icon"></i>Kembali</button>
<button type="button" class="ui modal-insert icon primary button"><i class="plus icon"></i>Input Konsultasi</button>
<button type="button"
data-content="Kirim data pasien ke Dokter"
data-url="<?php echo e(url('konsultan/data-pasien/'.$pasien->no_index.'/cek-konsultasi')); ?>"
data-token="<?php echo e(csrf_token()); ?>" data-pasien="<?php echo e($pasien->no_index); ?>"
class="ui icon right labeled positive button simpan-data-pasien">
<i class="save icon"></i>Simpan
</button>
</div>
<!-- Modal Insert -->
<div class="ui small modal" id="modal-notifikasi">
<div class="header">Notifikasi</div>
<div class="image content">
	<div class="image">
		<i class="archive icon"></i>
	</div>
	<div class="description">
		<p></p>
	</div>
</div>
<div class="actions">
	<div class="ui approve positive button">Oke</div>
</div>
</div>
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
	<form id="form-konsultasi" class="ui form" action="<?php echo e(url('konsultan/simpan')); ?>" method="POST">
		<?php echo csrf_field(); ?>

		<input type="hidden" name="id_konsultasi">
		<input type="hidden" value="<?php echo e($pasien->no_index); ?>" id="id-pasien" name="id_pasien">
		<div class="field">
			<label>Nama Pasien:</label>
			<input type="text" value="<?php echo e($pasien->nama_pasien); ?>" readonly="" id="input-nama-pasien">
		</div>
		<div class="required field">
			<label>Anamesa / Pemeriksaan Fisik:</label>
			<textarea placeholder="Anamesa / Pemeriksaan Fisik" rows="3" name="pemeriksaan_fisik"></textarea>
		</div>
		<div class="two column fields">
			<div class="required field">
				<label>Diagnosa:</label>
				<textarea rows="3" name="diagnosa" placeholder="Diagnosa"></textarea>
			</div>
			
			<div class="required field">
				<label>Pengobatan / Tindakan:</label>
				<textarea rows="3" name="tindakan" placeholder="Pengobatan / Tindakan"></textarea>
			</div>
		</div>
	</form>
</div>
<div class="actions">
	<div class="ui cancel negative button"><i class="icon dont"></i>Cancel</div>
	<button id="submit-form-konsultasi" class="ui approve primary button"><i class="icon save"></i>Simpan</button>
</div>
</div>
<!-- Modal Update-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('konsultan.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>