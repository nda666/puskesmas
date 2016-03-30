<?php $__env->startSection('title', 'Ruang Konsul'); ?>
<?php $__env->startSection('content_title'); ?>
<i class="treatment huge icon"></i>
<div class="content">
	Ruang Konsul
	<div class="sub header">Input Konsultasi Pasien</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/pickdate.js/themes/default.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/pickdate.js/themes/default.date.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/pickdate.js/themes/default.time.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('assets/pickdate.js/picker.js')); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo e(asset('assets/pickdate.js/picker.date.js')); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo e(asset('assets/pickdate.js/picker.time.js')); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo e(asset('assets/pickdate.js/translations/id_ID.js')); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
var $input = $( '.datepickere' ).pickadate({
			format: 'dd mmmm yyyy',
			formatSubmit: 'yyyy-mm-dd',
			container: '#datepicker-container',
			selectYears: true,
			selectMonths: true,
			hiddenSuffix: '_suffix',
			hiddenName: true
		});
	var picker = $input.pickadate('picker');
</script>
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
<div id="datepicker-container"></div>
<div class="ui centered grid">
	<div class="ui sixteen wide doubling column">
		<form id="form-pasien" class="ui form" action="<?php echo e(url('ruang-konsul/submit')); ?>" method="POST">
			<?php echo csrf_field(); ?>

			<div class="fields">
				<div class="field">
					<label>No Index</label>
					<div class="ui action input">
						<input type="text" placeholder="Masukkan Nomor Index" name="no_index">
						<button type="button" id="find-pasien" class="ui teal right labeled icon button">
						<i class="search icon"></i>Cari
						</button>
					</div>
				</div>
			</div>
			<div class="fields">
				<div class="eight wide field">
					<label>Tanggal</label>
					<div class="ui input">
						<input type="date" placeholder="Tanggal" class="datepicker" name="tanggal">
					</div>
				</div>
				<div class="eight wide field">
					<label>Jam</label>
					<div class="ui input">
						<input type="time" class="timepicker" placeholder="Jam" name="jam">
					</div>
				</div>
			</div>
			
			<div class="field">
				<label>Anamesa / Pemeriksaan Fisik</label>
				<textarea rows="3" name="pemeriksaan_fisik"></textarea>
			</div>
			
			<div class="fields">
				<div class="field">
					<label>Diagnosa</label>
					<p class="help-form">*Ketik <b>Kode Diagnosa</b> jika ada</p>
					<div class="ui action input">
						<input type="text" placeholder="Kode Diagnosa">
						<button type="button" id="#find_diagnosa" class="ui teal right labeled icon button">
						<i class="search icon"></i>Cari
						</button>
					</div>
				</div>
			</div>
			<div class="field">
				<textarea rows="3" name="diagnosa" placeholder="Diagnosa"></textarea>
			</div>
			<div class="field">
				<label>Pengobatan / Tindakan</label>
				<textarea rows="3" name="tindakan" placeholder="Pengobatan / Tindakan"></textarea>
			</div>
			<button type="button" class="ui right labeled icon primary button submit-form">
			<i class="right send icon"></i>Simpan Data
			</button>
			<a class="submit-form">Test</a>
		</form>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>