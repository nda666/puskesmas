<?php $__env->startSection('title','Data Obat Pasien'); ?>
<?php $__env->startSection('content_title','Data Obat Pasien'); ?>
<?php $__env->startSection('content_sub_title', 'Data obat pasien'); ?>
<?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
<i class="icon first aid outline"></i>
</i>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui blue top attached segment breadcrumb">
	<div class="ui breadcrumb">
	<a href="<?php echo e(url('apoteker')); ?>" class="section"><i class="icon home"></i>Home</a>
		<i class="right chevron icon divider"></i>
		<div class="active section"><i class="icon first aid outline"></i>Data Obat Pasien</div>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="tab-konsultasi" class="ui tabular secondary pointing menu">
	<a class="item" data-tab="data-pasien">Data Administrasi</a>
	<a class="active item" data-tab="data-resep">Data Resep</a>
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
<div class="ui active tab vertical segment" data-tab="data-konsultasi">
	<?php $i = 0; $color=['blue','red','teal','orange']; ?>
	<div class="ui grid">
		<?php foreach($ruang_konsul as $r_konsul): ?>
		<div class="eight wide column">
			<h4 class="ui dividing header"><i class="icon file outline text"></i>List Resep <?php echo e($i + 1); ?></h4>
			<?php $j = $i ?>
				<?php while($j >= count($color)): ?>
					<?php $j -= count($color); ?>
				<?php endwhile; ?>
			<table class="ui <?php echo e($color[$j]); ?> definition table">
				<tr>
					<td class="five wide">Petugas</td>
					<td><?php echo e($r_konsul->poli_resep->petugas->nama_pegawai); ?></td>
				</tr>
				<tr>
					<td>Tanggal</td>
					<td><?php echo e($r_konsul->poli_resep->tanggal->format('d-m-Y H:i')); ?></td>
				</tr>
				<tr>
					<td>Poli</td>
					<td><?php echo e($r_konsul->poli_resep->nama_poli); ?></td>
				</tr>
				<tr>
					<td>Resep Obat</td>
					<td><textarea readonly disabled rows="6" style="width: 100%;max-width: 600px;"><?php echo e($r_konsul->poli_resep->resep); ?></textarea></td>
				</tr>
			</table>
		</div>
		<?php $i++; ?>
		<?php endforeach; ?>
		<div class="sixteen wide column">
			<button type="button" data-token="<?php echo e(csrf_token()); ?>" data-pasien="<?php echo e($pasien->id); ?>" class="ui cek-obat icon positive button">
			<i class="check icon"></i> Cek Obat
			</button>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('textarea').css('max-width', $('textarea').parent().width() + 'px');

	$('.cek-obat').click(function(e) {
		if ($(this).hasClass('loading')) {
			return false;
		}
		var id = $(this).attr('data-pasien'),
			_token = $(this).attr('data-token'),
			ele = $(this);
		ele.addClass('loading');
		swal({
			title: 'Konfirmasi',
			text: 'Cek obat untuk pasien ini?',
			type: 'info',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Tidak',
			confirmButtonText: 'Iya',
		}, function() {
			swal.disableButtons();
			$.ajax({
				url: '/apoteker/ajax/check_resep',
				type: 'POST',
				dataType: 'json',
				data: {
					id: id,
					_token: _token
				},
				complete: function() {
					ele.removeClass('loading');
				},
				error: function(xhr) {
					swal('Error', xhr.status + ' ' + xhr.statusText);
				},
				success: function(response) {
					if (response.response == true) {
						swal({
							title: 'Sukses',
							type: 'success',
							text: response.message,
							timer: 5000
						}, function() {
							window.location.href = response.redirect;
						})
					} else {
						swal('Gagal', response.message, 'error');
					}
				}
			});
		});
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('apoteker.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>