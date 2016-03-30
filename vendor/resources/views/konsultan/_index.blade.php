@extends('default')
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('/assets/jquery-ui-1.12.0-beta.1.custom/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/jqgrid/css/ui.jqgrid.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/jquery-ui-1.12.0-beta.1.custom/jquery-ui.theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/jtable/themes/jqueryui/jtable_jqueryui.min.css') }}">
@stop
@section('content')
<div class="ui segment top attached toolbar">
	<form id="filter-grid" class="ui width small form">
		<div class="fields" style="margin-bottom: 5px">
			<div class="field">
				<label>Kolom:</label>
				<select placeholder="Cari Pada Kolom" name="filter-column" class="ui selection dropdown">
					<option value="">Pilih Kolom</option>
					<option value="no_index">No Index</option>
					<option value="nama_pasien">Nama Pasien</option>
				</select>
			</div>
			<div class="field">
				<label>Operator:</label>
				<select placeholder="Cari Pada Kolom" name="filter-operator" class="ui selection dropdown">
					<option value="">Pilih Operator</option>
					<option value="=">Sama dengan</option>
					<option value="%{o}%">Mengandung</option>
					<option value="{o}%">Diawali</option>
					<option value="%{o}">Diakhiri</option>
					<option value="(gt)">Lebih besar dari</option>
					<option value="(ge)">Lebih sama besar dari</option>
					<option value="(lt)">Lebih kecil dengan</option>
					<option value="(le)">Lebih sama kecil dari</option>
				</select>
			</div>
			<div class="field">
				<label>Cari:</label>
				<div class="ui input">
					<input type="text" name="filter-value">
					<button class="circular ui primary icon button">
					<i class="icon search"></i>
					</button>
				</div>
			</div>
		</div>
	</form>
	<div data-token="{{csrf_token()}}" class="attached" data-list="{{ url('konsultan/data-pasien-json') }}" data-update="{{ url('konsultan/simpan') }}" id="table-pasien">
	</div>
	<div id="pager"></div>
</div>
<script src="{{ asset('/assets/jquery-ui-1.12.0-beta.1.custom/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/jquery-ui/i18n/datepicker-id.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/jtable/jquery.jtable.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/jtable/localization/jquery.jtable.id.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$.datepicker.setDefaults($.datepicker.regional['id']);
	$('#table-pasien').jtable({
		title:'Tabel Pasien',
		paging: true,
		pageList: 'minimal',
		filtering: true,
		selecting: true,
		jqueryuiTheme: true,
		pageSize: 10,
		sorting: true,
		defaultSorting: 'no_index DESC',
		toolbar: {
			items: [{
				text: '<i class="icon file outline pdf"></i>Simpan ke Excel',
				tooltip: 'Simpan ke PDF',
				click: function(){
				}
			},{
				text: '<i class="icon file outline excel"></i>Simpan ke PDF',
				tooltip: 'Simpan ke Excel',
				click: function(){
				}
			}]
		},
		actions: {
			listAction: function(postData, jtParams){
				return $.Deferred(function($dfd){
					$.ajax({
						url: $('#table-pasien').data('list') +'?jtStartIndex='+ jtParams.jtStartIndex +'&jtPageSize='+jtParams.jtPageSize+'&jtSorting='+jtParams.jtSorting,
						type: 'POST',
						dataType: 'json',
						data: postData,
						success: function(data){
							$dfd.resolve(data)
						},
						error: function(data){
							$dfd.resolve(data)
						}
					});
				});
			},
			
		},
		fields: {
			no_index:{
				title: 'test',
				display: function(data){
					return '<button class="ui button primary"><i class="icon eye"></i></button>'
				}
			},
			no_index:{
				key: true,
				list: true,
				title: 'No Index'
			},
			nama_pasien:{
				title: 'Nama Pasien'
			},
			alamat:{
				title: 'Alamat'
			}
		},
				selectionChanged: function(event, data){
		}
	});
	
	$('#filter-grid').submit(function(e){
		e.preventDefault();
		$('#table-pasien').jtable('load',{
			filter_value: $('[name="filter-value"]').val(),
			filter_column: $('[name="filter-column"]').val(),
			filter_operator: $('[name="filter-operator"]').val(),
			_token: $('#table-pasien').data('token')
		});
	});
	$('#filter-grid').submit();
	$('.ui.dropdown').dropdown();
	
</script>
@stop