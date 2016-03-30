<?php $__env->startSection('title', 'Data Pasien'); ?>
<?php $__env->startSection('content_title','<i class="big icons"><i class="user thin icon"></i><i class="red mini corner heart icon"></i></i>Data Pasien'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui breadcrumb">
	<div class="ui breadcrumb">
		<a href="<?php echo e(url('/')); ?>" class="section">Home</a>
		<i class="right chevron icon divider"></i>
		<div class="active section">Data Pasien</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/pickdate.js/themes/default.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/pickdate.js/themes/default.date.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.ui.dropdown').dropdown();
		$('.ui.button').popup();
		$('#table-pasien th').click(function(event) {
			if (!$(this).data('name')){
				return false;
			}
			var sort = 'asc',
			key = $(this).data('name'),
			ele = $(this);
			if (ele.data('sort')){
				sort = ele.data('sort');
			}
			$.ajax({
				url: document.URL,
				dataType: 'html',
				data: {'sort[]': key+','+sort},
			})
			.done(function(data) {
				if (sort == 'asc'){
					ele.removeClass('sorted descending').addClass('sorted ascending')
					ele.data('sort', 'desc');
				} else {
					ele.removeClass('sorted ascending').addClass('sorted descending')
					ele.data('sort', 'asc')
				}
				
				$(ele).parents('table').find('tbody').html($(data).find('#table-pasien tbody').html())
			});
			
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if(isset($obj_pasien)): ?>
<div class="ui segments">
	<div class="ui segment">
		<div class="ui grid relaxed stackable">
			<div class="three column row">
				<div class="column">
					<div class="ui left labeled button" tabindex="0">
						<p class="ui basic right pointing label">
							Total Rows: <?php echo e($obj_pasien->total_rows); ?>

						</p>
						<a href="<?php echo e(url('pendaftaran')); ?>" class="ui positive button">
							<i class="plus icon"></i> Daftarkan
						</a>
					</div>
				</div>
				<div class="column">
					<form action="<?php echo e(url('pasien')); ?>">
					<div class="ui action left corner labeled input">
						<input type="text" name="nama_pasien" placeholder="Cari Pasien">
						<div class="ui left corner label">
							<i class="asterisk icon"></i>
						</div>
						<button type="submit" class="ui icon button">
							<i class="search icon"></i>
						</button>
					</div>
					</form>
				</div>
				<div class="column">
					<div class="ui selection icon dropdown">
						<input type="hidden" data-url="<?php echo e(route('pasien')); ?>" value="<?php echo e(session('show')); ?>" id="show-per-page">
						<i class="eye icon"></i>
						<div class="default text">Show Per-page: </div>
						<div class="menu">
							<div class="item" data-value="10">10 Views</div>
							<div class="item" data-value="20">20 Views</div>
							<div class="item" data-value="50">50 Views</div>
							<div class="item" data-value="100">100 Views</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="ui segment table-container">
		<table id="table-pasien" class="ui definition celled sortable single line selectable compact table">
			<thead>
				<tr>
					<th></th>
					<th>No Index</th>
					<th>Nama Pasien</th>
					<th>Alamat</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($obj_pasien as $pasien): ?>
				<tr data-url="<?php echo e(route('pasien/update', $pasien->no_index)); ?>">
					<td>
						<div class="ui small basic icon buttons">
							<a data-title="Lihat Data" data-content="<?php echo e($pasien->nama_pasien); ?>" class="ui button" href="<?php echo e(route('pasien/view', $pasien->no_index)); ?>"><i class="icon eye"></i></a>
							<a data-title="Ubah Data" data-content="<?php echo e($pasien->nama_pasien); ?>" class="ui button" href="<?php echo e(route('pasien/update', $pasien->no_index)); ?>"><i class="icon edit"></i></a>
							<a data-title="Hapus Data" data-content="<?php echo e($pasien->nama_pasien); ?>" href="<?php echo e(route('pasien/delete', $pasien->no_index)); ?>" class="ui button confirm-delete"><i class="icon trash"></i></a>
						</div>
					</td>
					<td><?php echo e($pasien->no_index); ?></td>
					<td><?php echo e($pasien->nama_pasien); ?></td>
					<td><?php echo e($pasien->alamat); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div id="pagination" class="ui center aligned segment">
		<?php echo (new Landish\Pagination\SemanticUI($obj_pasien))->render(); ?>

		<script type="text/javascript" charset="utf-8" async defer>
		$('.confirm-delete').click(function(e){
			e.preventDefault();
			var target = $(this).attr('href');
			$('.ui.modal').modal({
				closable: false,
				onApprove: function(){
					location.href = target;
				}
			}).modal('show');
		})
		$('#show-per-page').change(function(e){
			var val = $(this).val(),
			target = $(this).data('url');
			location.href = target + '?show=' + val;
		})
		function table_load(target, data) {
			$('#table-pasien').parents('.segments').append('<div class="ui active dimmer"><div class="ui indeterminate text loader">Menyiapkan Data</div></div>')
				$.ajax({
					url: target,
					dataType: 'html',
					data: data,
				})
				.done(function(data) {
					$('#table-pasien').html($(data).find('#table-pasien').html());
					$('#pagination').html($(data).find('#pagination').html())
				})
				.always(function(){
					$('#table-pasien').parents('.segments').find('.dimmer').remove();
				});
				
		}
		$('#pagination a').on('click', function(e){
				e.preventDefault();
				var target = $(this).attr('href'),
				tbl_ofset = $('#table-pasien').offset().top;
				$('html, body').stop().animate({scrollTop:tbl_ofset - 46},'500','swing');
				table_load(target);
			})
		</script>
	</div>
</div>

<div class="ui modal small">
	<div class="header"><i class="red warning sign big icon"></i>Peringatan</div>
	<div class="image content">
		<div class="image">
			<i class="huge icons"><i class="icon trash"></i><i class="icon corner gray unlink"></i></i>
		</div>
		<div class="description">
			<p>Menghapus data ini akan otomatis menghapus data <b>Konsultasi</b> pasien ini.</p>
			<p>Apakah anda yakin ingin menghapus data ini?</p>
		</div>
	</div>
	<div class="actions">
		<div class="ui cancel negative button">Tidak</div>
		<div class="ui approve positive button">Ya</div>
	</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>