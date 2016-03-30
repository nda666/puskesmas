
<?php $__env->startSection('title','Pendaftaran'); ?>
<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Select/css/select.dataTables.min.css')); ?>">
<style type="text/css">
	table.nowarp tr > th, table.nowarp tr > td {
		white-space: nowrap;
	}
	div.dt-buttons {
		float: none !important;
	}
	table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting {
padding-right: 30px;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/dataTables.semantic.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/flot/jquery.flot.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/flot/jquery.flot.pie.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/flot/jquery.flot.categories.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('assets/flot/jquery.flot.navigate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/flot/jquery.flot.threshold.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('assets/js/dashboard.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="ui grid">
	<!-- Pasien -->
	<div class="four columns row">
		<?php
		$color = ['blue', 'red', 'violet', 'teal'];
		$yNow = \Carbon\Carbon::now()->format('Y');
		$yPast = \Carbon\Carbon::now()->subMonths(12)->format('Y');
		?>
		<?php for($i = 0; $i < count($count); $i++): ?>
			<div class="column">
			<div style="padding: 0; border-radius: 0; margin-bottom: 5px;" class="ui segment">
				<div class="dashboard statistic">
					<?php $j = $i; ?>
					<?php while($j > count($color)): ?>
						<?php $j = $j - count($color); ?>
					 <?php endwhile; ?>
					<div class="<?php echo e($color[$j]); ?> box-icon">
						<i class="<?php echo e($count[$i]['icon']); ?> icon"></i>
					</div>
					<div class="content">
						<div class="label">
							<?php echo e($count[$i]['title']); ?>

						</div>
						<div class="value">
							<?php echo e($count[$i]['content']); ?>

						</div>
					</div>
				</div>
			</div>
	</div>
	<?php endfor; ?>
</div>
<div class="sixteen wide computer column">
	<h4 class="ui header top attached segment">Aktivitas Rawat Jalan</h4>
	<div class="ui attached segment">
		<p>Terdata dari Tahun <?php echo e($yPast); ?> - <?php echo e($yNow); ?></p>
		<div>
			<div id="bar-chart" data-source="<?php echo e(url('administrasi/dashboard/rawat-jalan')); ?>" style="height: 300px;"></div>
		</div>
	</div>
</div>
<div class="sixteen wide mobile sixteen wide tablet ten wide computer column">
	<h4 class="ui header top attached header">Pasien Sedang Rawat Jalan</h4>
	<div class="ui attached segment">
		<table id="table-pasien" width="100%" class="ui striped unstackable table" data-token="<?php echo e(csrf_token()); ?>" data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>" data-source="<?php echo e(url('administrasi/dashboard/pasien-rawat-jalan')); ?>">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nama</th>
					<th>Gender</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="sixteen wide mobile sixteen wide tablet six wide computer column">
	<h4 class="ui header top attached header">Persentase Usia Rawat Jalan Pasien</h4>
	<div class="ui attached segment">
		<p>Terdata dari Tahun <?php echo e($yPast); ?> - <?php echo e($yNow); ?></p>
		<div style="margin: 0 auto;">
			<div data-source="<?php echo e(url('administrasi/dashboard/usia-per-tahun')); ?>" id="pie-chart" style="height: 300px;">
			</div>
		</div>
	</div>
</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrasi.dashboard_default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>