<?php $__env->startSection('title', 'Input Baru Pasien'); ?>
<?php $__env->startSection('content_title','<i class="big icons"><i class="user thin icon"></i><i class="red mini corner heart icon"></i></i>Input Pasien Baru'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui breadcrumb">
	<div class="ui breadcrumb">
		<a class="section">Home</a>
		<i class="right chevron icon divider"></i>
		<a href="<?php echo e(route('pasien')); ?>" class="section">Data Pasien</a>
		<i class="right arrow icon divider"></i>
		<div class="active section">Buat Baru</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/pickdate.js/themes/default.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/pickdate.js/themes/default.date.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('assets/pickdate.js/picker.js')); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo e(asset('assets/pickdate.js/picker.date.js')); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo e(asset('assets/pickdate.js/translations/id_ID.js')); ?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	$('.ui.button').popup();
	var $input = $( '.datepicker' ).pickadate({
			format: 'dd mmmm yyyy',
			formatSubmit: 'yyyy-mm-dd',
			container: '#date-picker-container',
			selectYears: true,
			selectMonths: true,
			hiddenSuffix: '_suffix',
			hiddenName: true
		});
	var picker = $input.pickadate('picker');
	$('.ui.dropdown').dropdown();
	$('.ui.form').form({
	fields: {
			nama_pasien     : 'empty',
				jenis_kelamin 	: 'empty',
				alamat	: 'empty',
				pekerjaan 	: 'empty',
				tgl_lahir	: 'empty',
				jenis_kepesertaan	: 'empty',
				jenis_kunjungan	: 'empty',
		}
	});
	$('#get_umur').click(function(e){
		e.preventDefault();
		var tgl_lahir = $('[name="tgl_lahir"]').val(),
		target = $(this).data('target'),
		element = $(this);
		if (tgl_lahir === ""){
			return false;
		}
		element.addClass('disabled').parent().addClass('left icon disabled');
		element.parent().append('<i id="loading-fix" class="icon"></i>').addClass('loading');
		$.ajax({
			url: target,
			type: 'GET',
			dataType: 'json',
			data: {tgl_lahir: tgl_lahir},
		})
		.done(function(data) {
			$('[name="umur"]').val(data['umur']);
		})
		.fail(function() {
			alert('Maaf terjadi error');
		})
		.always(function() {
			element.removeClass('disabled').parent().removeClass('left icon disabled loading');
			element.parent().find('#loading-fix').remove();
			
		});
		
	})
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="ui segment">
	<form class="ui form" method="POST" action="<?php echo e(route('pasien/submit')); ?>">
		<?php echo csrf_field(); ?>

		<div class="fields">
			<div class="eight wide field">
				<label>Nama Pasien</label>
				<input type="text" name="nama_pasien" placeholder="Nama Pasien">
			</div>
			<div class="eight wide field">
				<label>Nama Kepala Keluarga</label>
				<input type="text" name="nama_kepala_keluarga" placeholder="Nama Kepala Keluarga">
			</div>
		</div>
		
		<div class="fields">
			<div class="eight wide field">
				<label>Tanggal Lahir</label>
				<input type="text" class="datepicker" name="tgl_lahir" placeholder="Tanggal Lahir">
				
			</div>
			<div class="eight wide field">
				<label>Umur</label>
				<div class="ui right action input">
					<input type="text" name="umur" placeholder="Umur">
					<button id="get_umur" data-content="Hitung umur berdasarkan tanggal lahir" data-target="<?php echo e(url('pasien/get_umur')); ?>" class="ui positive button">Hitung Umur</button>
				</div>
			</div>
		</div>
		<div class="fields">
			<div class="eight wide field">
				<label>Jenis Kelamin</label>
				<div class="ui fluid selection dropdown">
					<input type="hidden" name="jenis_kelamin">
					<i class="dropdown icon"></i>
					<div class="default text">Jenis Kelamin</div>
					<div class="menu">
						<div class="item" data-value="1">Laki-Laki</div>
						<div class="item" data-value="2">Perempuan</div>
					</div>
				</div>
			</div>
			<div class="eight wide field">
				<label>Pekerjaan</label>
				<input type="text" name="pekerjaan" placeholder="Pekerjaan">
				
			</div>
		</div>
		<div class="field">
			<label>Agama</label>
			
			<input type="text" name="agama" placeholder="Agama">
		</div>
		
		<div class="field">
			<label>Alamat</label>
			<textarea name="alamat" rows="3" placeholder="Alamat"></textarea>
		</div>
		
		<div class="field">
			<label>Kunjungan</label>
			<div class="ui fluid selection dropdown">
				<input type="hidden" name="jenis_kunjungan">
				<i class="dropdown icon"></i>
				<div class="default text">Jenis Kunjungan</div>
				<div class="menu">
					<div class="item" data-value="1">Baru</div>
					<div class="item" data-value="2">Lama</div>
				</div>
			</div>
		</div>
		<div class="field">
			<label>Kepersertaan</label>
			<div class="ui fluid selection dropdown">
				<input type="hidden" name="jenis_kepesertaan">
				<i class="dropdown icon"></i>
				<div class="default text">Jenis Kepesertaan</div>
				<div class="menu">
					<div class="item" data-value="1">Umum & BPJS</div>
					<div class="item" data-value="2">AKSESOS</div>
					<div class="item" data-value="3">AKSESIN</div>
					<div class="item" data-value="4">AKSES</div>
					<div class="item" data-value="5">BUMIL</div>
					<div class="item" data-value="6">ASPRAS</div>
				</div>
			</div>
		</div>
		
		<button class="ui button primary right labeled icon" type="submit"><i class="icon send"></i>Submit</button>
	</form>
</div>
<div id="date-picker-container"></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>