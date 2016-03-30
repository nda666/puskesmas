<?php $__env->startSection('title', 'View Pasien'); ?>
<?php $__env->startSection('content_title','<i class="big icons"><i class="user thin icon"></i><i class="red mini corner heart icon"></i></i>View Pasien'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui breadcrumb">
	<div class="ui breadcrumb">
		<a class="section">Home</a>
		<i class="right chevron icon divider"></i>
		<a href="<?php echo e(route('pasien')); ?>" class="section">Data Pasien</a>
		<i class="right arrow icon divider"></i>
		<div class="active section">View Pasien</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('stylesheet'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('/assets/jquery-ui/jquery-ui.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('/assets/jquery-ui/jquery-ui.theme.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('/assets/jqgrid/css/ui.jqgrid.css')); ?>">
	
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<table data-action="<?php echo e(url('pasien/jview')); ?>" id="table-pasien" class="ui vertical segment">
</table>
<div id="pager"></div>
<script src="<?php echo e(asset('/assets/jquery-ui/jquery-ui.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/assets/jqgrid/js/i18n/grid.locale-id.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/jqgrid/js/minified/jquery.jqGrid.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/assets/jqgrid/js/jqDnR.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
	$('#table-pasien').css('width',$('#main-content').width() - 20+ 'px');
	$('#table-pasien').jqGrid({
		datatype: 'json',
		url: $('#table-pasien').data('action'),
		height: '100%',
		colNames: ['ID','Nama Pasien', 'Kepala Keluarga','Gender','Pekerjaan','Alamat','Tanggal Lahir','Umur','Agama','Kunjungan','Kepesertaan'],
		colModel: [
					{
						name:'no_index', index:'no_index', width: 40,
					},
					{
						name:'nama_pasien', index:'nama_pasien'
					},
					{
						name:'nama_kepala_keluarga', index:'nama_kepala_keluarga'
					},
					{
						name:'jenis_kelamin', index:'jenis_kelamin',width: 80, align: 'center'
					},
					{
						name:'pekerjaan', index: 'pekerjaan'
					},
					{
						name:'alamat', index: 'alamat', width: 300
					},
					{
						name:'tgl_lahir', index: 'tgl_lahir'
					},
					{
						name:'umur', index: 'umur', width: 80, align: 'center'
					},
					{
						name:'agama', index: 'agama', width: 80, align: 'center'
					},
					{
						name:'jenis_kunjungan', index: 'jenis_kunjungan', width: 70, align: 'center'
					},
					{
						name:'jenis_kepesertaan', index: 'jenis_kepesertaan'
					},
				],
		viewrecords: true,
		sortname: 'no_index',
		pager: '#pager',
		autowidth: true,
		shrinkToFit: false,
		gridview: true,
		rowNum: 20,
		rowList: [10, 20, 50, 100, 200],
		loadComplete: function(data){
			$('#sticky-sidebar').sticky('refresh');
		}
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>