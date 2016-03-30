@extends('apoteker.default') @section('title','Data obat') @section('content_title','Data obat') @section('content_sub_title','Tambah, ubah, hapus data obat') @section('content_title_icon')
<i class="big icons"><i class="first aid icon"></i></i>
@stop @section('breadcrumbs')
<div class="ui top attached panel-header segment">
	<div class="ui grid">
		<div class="six wide column computer">
			<b>List obat</b>
		</div>
		<div class="right aligned ten wide column computer">
			<div class="ui breadcrumb">
				<a href="{{ url('apoteker') }}" class="section">
					<i class="icon black home"></i>Home</a>
				<span class="divider">/</span>
				<div class="section">
					<i class="icon first aid"></i>Obat
				</div>
			</div>
		</div>
	</div>
</div>
@stop @section('stylesheet')

<link rel="stylesheet" type="text/css" href="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/media/css/jquery.dataTablesMod.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css') }}">

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
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js') }}"></script>

<script type="text/javascript" src="{{ asset('/assets/jquery-address/jquery.address-1.5.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('/assets/yadcf/jquery.dataTables.yadcf.js') }}">
</script>
<script type="text/javascript" src="{{ asset('/assets/js/administrasi/obat.min.js') }}"></script>
@stop @section('content')
<div class="sixteen wide column computer">

	<div class="datatable-container">
		<table data-token="{{csrf_token()}}" data-source="{{ url('apoteker/obat/data-index') }}" data-token="{{ csrf_token() }}" data-lang="{{ asset('/assets/datatables/i18n/indonesian.json') }}" id="data-obat" class="ui unstackable definition celled table" width="100%">
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
@include('apoteker.obat.form')
@stop
