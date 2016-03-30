<?php $__env->startSection('title', 'View Pasien'); ?>
<?php $__env->startSection('content_title'); ?>
<i class="big icons">
<i class="user thin icon"></i>
<i class="red mini corner heart icon"></i>
</i>
<div class="content">Table Pasien
	<div class="sub header">Management Data Pasien Puskesmas Patrang</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui breadcrumb">
	<div class="ui breadcrumb">
		<a class="section"><i class="icon home"></i>Home</a>
		<i class="right chevron icon divider"></i>
		<a class="section"><i class="icon table"></i>Tabel</a>
		<i class="right arrow icon divider"></i>
		<div class="active section"><i class="icon user"></i>Pasien</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/assets/jqgrid/css/ui.jqgrid.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/jquery-ui-1.12.0-beta.1.custom/jquery-ui.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/jquery-ui-1.12.0-beta.1.custom/jquery-ui.theme.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<table data-token="<?php echo e(csrf_token()); ?>" data-action="<?php echo e(url('tabel/pasien_json')); ?>" data-update="<?php echo e(url('pasien/update/submit')); ?>" id="table-pasien">
</table>
<div id="pager"></div>
<button type="button" id="show-form-pasien" class="ui button">Mod</button>
<div id="form-pasien" class="ui modal">
	<div class="header">Form Pasien</div>
	<div class="content">
		<form class="ui small equal width form">
			<?php echo csrf_field(); ?>

			<div class="fields">
				<div class="eight wide field">
					<label>Nama Pasien</label>
					<input tabindex="1" type="text" name="nama_pasien" placeholder="Nama Pasien">
				</div>
				<div class="eight wide field">
					<label>Nama Kepala Keluarga</label>
					<input tabindex="2" type="text" name="nama_kepala_keluarga" placeholder="Nama Kepala Keluarga">
				</div>
			</div>
			
			<div class="fields">
				<div class="eight wide field">
					<label>Tanggal Lahir:</label>
					<div class="ui action input">
						<input tabindex="3" type="text" class="datepicker" name="tgl_lahir" placeholder="Tanggal Lahir">
						<button type="button" id="tgl_lahir_picker" class="ui default icon button"><i class="icon calendar"></i></button>
					</div>
					<div class="help-form">Contoh: 14/02/1991</div>
				</div>
				<div class="eight wide field">
					<label>Umur</label>
					<div class="ui right action input">
						<input tabindex="4" type="text" name="umur" placeholder="Umur">
						<button type="button" id="get_umur" data-content="Hitung umur berdasarkan tanggal lahir" data-target="<?php echo e(url('pasien/get_umur')); ?>" class="ui positive button">Hitung Umur</button>
					</div>
				</div>
			</div>
			<div class="three fields">
				<div class="field">
					<label>Jenis Kelamin</label>
					<div tabindex="5" id="jenis_kelamin_dropdown" class="ui fluid selection dropdown">
						<input type="hidden" name="jenis_kelamin">
						<i class="dropdown icon"></i>
						<div class="default text">Jenis Kelamin</div>
						<div class="menu">
							<div class="item" data-value="1">Laki-Laki</div>
							<div class="item" data-value="2">Perempuan</div>
						</div>
					</div>
				</div>
				<div class="field">
					<label>Pekerjaan</label>
					<input tabindex="6" type="text" name="pekerjaan" placeholder="Pekerjaan">
				</div>
				<div class="field">
					<label>Agama</label>
					<input tabindex="7" type="text" name="agama" placeholder="Agama">
				</div>
			</div>
			
			
			<div class="field">
				<label>Alamat</label>
				<textarea tabindex="8" name="alamat" rows="3" placeholder="Alamat"></textarea>
			</div>
			<div class="fields">
				<div class="field">
					<label>Kunjungan</label>
					<div tabindex="9" id="jenis_kunjungan_dropdown" class="ui fluid selection dropdown">
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
					<div tabindex="10" id="kepesertaan-dropdown" class="ui fluid selection dropdown">
						<input type="hidden" name="jenis_kepesertaan">
						<i class="dropdown icon"></i>
						<div class="default text">Jenis Kepesertaan</div>
						<div class="menu">
							<div class="item" data-value="Umum & BPJS">Umum & BPJS</div>
							<div class="item" data-value="AKSESOS">AKSESOS</div>
							<div class="item" data-value="AKSESIN">AKSESIN</div>
							<div class="item" data-value="AKSES">AKSES</div>
							<div class="item" data-value="BUMIL">BUMIL</div>
							<div class="item" data-value="ASPRAS">ASPRAS</div>
							<div class="item" data-value="0">Lain - Lain</div>
						</div>
					</div>
					<input tabindex="11" style="margin-top:5px;" type="hidden" placeholder="Sebutkan Jenis Kunjungannya" name="_jenis_kepesertaan">
				</div>
			</div>
		</form>
	</div>
	<div class="actions">
		<div class="ui approve button">Approve</div>
		<div class="ui cancel button">Cancel</div>
	</div>
</div>
<script src="<?php echo e(asset('/assets/jquery-ui-1.12.0-beta.1.custom/jquery-ui.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/assets/datepicker-id.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/assets/jqgrid/js/i18n/grid.locale-id.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/assets/jqgrid/js/minified/jquery.jqGrid.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/assets/jqgrid/js/jqModal.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/assets/jqgrid/js/jqDnR.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
	$('#table-pasien').css('width',$('#main-content').width() - 20+ 'px');
	var lastSelectedId;
	$.datepicker.setDefaults($.datepicker.regional['id']);
	$('#table-pasien').jqGrid({
		width: $('#main-content').width() - 44,
		datatype: 'json',
		url: $('#table-pasien').data('action'),
		height: '100%',
		colNames: ['ID','Nama Pasien', 'Kepala Keluarga','Gender','Pekerjaan','Alamat','Tanggal Lahir','Umur','Agama','Kunjungan','Kepesertaan'],
		colModel: [
					{
						name:'id', index:'id', width: 40
					},
					{
						name:'nama_pasien', index:'nama_pasien', editable: true
					},
					{
						name:'nama_kepala_keluarga', index:'nama_kepala_keluarga', editable: true
					},
					{
						name:'jenis_kelamin', index:'jenis_kelamin',width: 80, align: 'center', editable: true, edittype:'select',editoptions: {value:'Laki-Laki:Laki-Laki;Perempuan:Perempuan'}
					},
					{
						name:'pekerjaan', index: 'pekerjaan', editable: true
					},
					{
						name:'alamat', index: 'alamat', width: 300, editable: true, edittype:'textarea'
					},
					{
						name:'tgl_lahir', index: 'tgl_lahir', editable: true,
						editoptions: {dataInit:function(el){setTimeout(function(){
							$(el).datepicker({dateFormat: 'd MM yy'});
						}, 200)
					}
				}
						,formatter: 'date', formatoptions: {srcformat: 'Y-m-d', newformat: 'j F Y'}
					},
					{
						name:'umur', index: 'umur', width: 80, align: 'center', editable: true
					},
					{
						name:'agama', index: 'agama', width: 80, align: 'center', editable: true
					},
					{
						name:'jenis_kunjungan', index: 'jenis_kunjungan', width: 70, align: 'center', editable: true,  edittype:'select',editoptions: {value:'Baru:Baru;Lama:Lama'}
					},
					{
						name:'jenis_kepesertaan', index: 'jenis_kepesertaan', editable: true
					},
				],
		viewrecords: true,
		sortname: 'id',
		sortorder: 'desc',
		pager: '#pager',
		toppager: true,
		autowidth: true,
		shrinkToFit: false,
		gridview: true,
		rowNum: 20,
		rowList: [10, 20, 50, 100, 200],
		editurl: $('#table-pasien').data('update'),
		loadComplete: function(data){
			$('#sticky-sidebar').sticky('refresh');
		}
	})
	.jqGrid('navGrid','#pager',{addicon: 'plus icon', editicon: 'pencil icon', delicon: 'trash icon', searchicon: 'search icon',refreshicon: 'icon refresh',cloneToTop: true},
		{
			afterSubmit: function(xhr, te){
					var resjson = JSON.parse(xhr.responseText);
					if (resjson.success){
						$('.topinfo').html('<div class="ui-state-highlight">'+resjson.message+'</div>');
						$('.tinfo').show();
						$('.tinfo').delay(3000).fadeOut();
						return [true,'']
					} else {
						$('.topinfo').html('<div class="ui-state-error">'+resjson.message+'</div>');
						$('.tinfo').show();
						$('.tinfo').delay(3000).fadeOut();
					
					}
				
			},
			editData: {_token:$('#table-pasien').data('token')},
			width: $(window).width()/3
		},
		{
			afterSubmit: function(xhr){
				var resjson = JSON.parse(xhr.responseText);
					if (resjson.status){
						$('.topinfo').html(resjson.message);
						$('.tinfo').show();
						$('.tinfo').delay(3000).fadeOut();
						return [true,'']
					}
				return [true,'error message']
			},
			editData: {_token:$('#table-pasien').data('token')},
			width: $(window).width()/3
		}
		)
	.jqGrid('filterToolbar');
	function rowdata(id){
		return $('#table-pasien').jqGrid().getRowData(id);
	}
	$('.navtable .ui-pg-div>span').replaceWith(function() {
		return $('<i>',{
			class: $(this).attr('class')
		}).removeClass('ui-icon');
	});
	function onSaveSuccess(xhr){
			if (xhr.response == 1){
				return true;
				return false;
			}
		}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrasi.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>