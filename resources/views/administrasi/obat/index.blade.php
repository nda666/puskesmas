@extends('administrasi.default') @section('title','Data obat') @section('content_title','Management Obat') @section('content_sub_title','Tambah, Ubah dan Hapus Data Obat') @section('content_title_icon')
<i class="big icons"><i class="first aid icon"></i></i>
@stop @section('breadcrumbs')
<div class="ui top attached panel-header segment">
	<div class="ui grid">
		<div class="six wide column computer">
			<b>List Obat</b>
		</div>
		<div class="right aligned ten wide column computer">
			<div class="ui breadcrumb">
				<a href="{{ url('administrasi') }}" class="section">
					<i class="icon black home"></i>Home</a>
				<span class="divider">/</span>
				<div class="section">
					<i class="icon first aid"></i>Management Obat</div>
			</div>
		</div>
	</div>
</div>
@stop @section('stylesheet')

<link rel="stylesheet" type="text/css" href="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/media/css/jquery.dataTablesMod.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Select/css/select.dataTables.min.css') }}">

<style type="text/css">
	.ui.small.modal>.close {
		top: 0.7rem !important;
		right: 0.5rem !important;
		z-index: 200 !important;
		color: #333 !important;
	}

</style>
@stop @section('javascript')
<script type="text/javascript" src="{{ asset('/assets/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/media/js/dataTables.semantic.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/serialize-object.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/yadcf/jquery.dataTables.yadcf.js') }}">
</script>
<script type="text/javascript" src="{{ asset('/assets/js/administrasi/obat.min.js') }}"></script>
@stop @section('content')
<div class="sixteen wide column computer">

	<div class="datatable-container">
		<table data-token="{{csrf_token()}}" data-source="{{ url('administrasi/obat/data-index') }}" data-token="{{ csrf_token() }}" data-lang="{{ asset('/assets/datatables/i18n/indonesian.json') }}" data-update="{{ url('ajax/obat/update') }}"
				data-delete="{{ url('ajax/obat/delete') }}" id="data-obat" class="ui unstackable definition celled table" width="100%">
			<thead>
				<tr>
					<th class="collapsing"></th>
					<th class="collapsing">ID</th>
					<th>Kode</th>
					<th>Nama</th>
					<th class="text-center collapsing">Action</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>

</div>
@include('administrasi.obat.form')
@stop
