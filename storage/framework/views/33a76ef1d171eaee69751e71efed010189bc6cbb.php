<?php $__env->startSection('title','Pendaftaran'); ?>
<?php $__env->startSection('content_title','Form Pendataran'); ?>
<?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
<i class="icon black user"></i>
<i class="icon corner red heart"></i>
</i>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_sub_title', 'Form pendaftaran dan list pendaftar hari ini'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui blue top attached segment breadcrumb">
	<div class="ui breadcrumb">
		<a href="<?php echo e(url('administrasi')); ?>" class="section"><i class="icon home"></i>Home</a>
		<i class="right chevron icon divider"></i>
		<div class="active section">
			<i class="file outline icon"></i> Form Pendaftaran Pasien
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/sweetalert2/sweetalert2.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css')); ?>">
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
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.print.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.colVis.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Select/js/dataTables.select.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/flot/jquery.flot.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/flot/jquery.flot.categories.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/flot/jquery.flot.resize.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/flot/jquery.flot.navigate.min.js')); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	var table = $('#table-pasien').DataTable({
		ajax: {
			url: $('#table-pasien').data('source'),
		},
		language: {
			url: $('#table-pasien').data('lang')
		},
		dom: "<'sixteen wide column'tr>",
		processing: true,
		serverSide: true,
		filter: true,
		sort: true,
		info: true,
		columns: [{
			data: "id",
			name: 'id',
			orderable: false,
			searchable: false
		}, {
			data: 'pasien.nama',
			name: 'pasien.nama',
			orderable: false,
			searchable: false
		}, {
			data: 'pasien.alamat',
			name: 'pasien.alamat',
			orderable: false,
			searchable: false
		}, {
			data: 'progres',
			name: 'progres',
			orderable: false,
			searchable: false
		}, ],
	});
	$.ajax({
		url: 'administrasi/get-rawat-jalan',
		type: 'GET',
		dataType: 'json',
		beforeSend: function() {
			$('#chart-canvas').attr('width', $('#chart-canvas').parent().width() + 'px')
		},
		success: function(res) {
			var b_data = [];
			$.each(res, function(index, val) {
				b_data.push([index, val]);
			});
			var bar_data = {
				data: b_data,
				color: "#2185d0",
			};
			var chart = $.plot("#bar-chart", [bar_data], {
				
				grid: {
					borderWidth: 1,
					borderColor: "#efefef",
					tickColor: "#efefef",
					hoverable: true,
				},
				
				series: {
					lines: {
						show: true
					},
					points: {
						show: true
					},
				},
				lines: {
					lineWidth: 2,
					fill: true,
					steps: false
				},
				xaxis: {
					mode: "categories",
					tickLength: 0,
				}
			});
			$('<div class="ui inverted flowing top small center popup" id="bar-chart-tooltip"></div>').css({
				width: '80px',
				textAlign: 'center'
			}).appendTo("body");
			$("#bar-chart").bind("plothover", function(event, pos, item) {
				if (item) {
					var x = item.series.data[item.dataIndex][0],
						y = item.series.data[item.dataIndex][1];
						$("#bar-chart-tooltip").html('<div><b>'+x + ":</b> " + y+'</div>')
							.css({
								top: item.pageY - ($("#bar-chart-tooltip").height() + 35),
								left: item.pageX - 41
							})
							.show();
				
				} else {
					$("#bar-chart-tooltip").hide();
				}
			});
			$('.zoom-chart').click(function(){
				chart.zoom({ center: { left: 10, top: 20 }, });
			});
			$('.zoom-out-chart').click(function(){

				chart.zoomOut({ center: { left: 10, top: 20 }, });
			});
			
		}
	});
});
	
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
.dashboard.statistic{
	min-height: 80px;
}
.dashboard.statistic .label{
	margin-bottom: 5px;
	font-weight: bolder;
	font-size: 1em;
	text-overflow: ellipsis;
white-space: nowrap;
overflow: hidden;
}
.dashboard.statistic .label:hover{
white-space: normal;
}
.dashboard.statistic .value{
	position: absolute;
	bottom: 10px;
	font-size: 2em;
}
.dashboard.statistic .content {
	padding-left: 90px;
	padding-top: 5px;
	padding-right: 5px;
}
.box-icon {
width: 85px;
height: 85px;
display: block;
float: left;
}
.box-icon.blue{
	background: #2185D0;
	color: #fff;
}
.box-icon.teal{
	background: #00B5AD;
	color: #fff;
}
.box-icon.red{
	background: #DB2828;
	color: #fff;
}
.box-icon.violet{
	background: #6435C9;
	color: #fff;
}
.box-icon .icon {
font-size: 4rem;
line-height: 6rem;
position: relative;
left: 10px;
}
.ui.box.segment {
padding: 0;
}
.box-icon:after {
clear: both !important;
}
</style>
<div class="ui centered grid">
	<!-- Pasien -->
	<div class="column row">
		<?php $color =  ['blue', 'red', 'violet', 'teal']; ?>
		<?php for($i = 0; $i < count($count); $i++): ?>
		<div class="eight wide mobile seven wide tablet four wide computer column">
			<div style="padding: 0; border-radius: 0; margin-bottom: 5px;" class="ui segment">
				<div class="dashboard statistic">
					<?php $j =  $i; ?>
					<?php while($j > count($color)): ?>
					<?php /* */ $j = $j - count($color) /**/ ?>
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
		<h3 class="ui header blue top attached segment">Aktivitas Rawat Jalan</h3>
		<div class="ui attached segment">
			<div class="sixteen wide column">
				<h4 class="ui header">Terdata dari Tahun 2015 - 2016</h4>
				<div class="ui basic small buttons">
					<button type="button" class="ui zoom-chart icon button">
					<i class="search icon"></i>
					</button>
					<button type="button" class="ui zoom-out-chart icon button">
					<i class="search icon"></i>
					</button>
				</div>
				<div>
					<div id="bar-chart" style="height: 300px;"></div>
				</div>
			</div>
			
			<div class="ui divider"></div>
			<div class="sixteen wide mobile fourteen wide tablet eight wide computer column">
				<h4 class="ui header">Pasien Sedang Rawat Jalan</h4>
				<table id="table-pasien" class="ui striped blue celled table"
					data-token="<?php echo e(csrf_token()); ?>" data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
					data-source="<?php echo e(url('administrasi/get-pasien')); ?>">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Progress</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrasi.dashboard_default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>