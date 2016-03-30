@extends('administrasi.default')
@section('title','Pendaftaran')
@section('content_title','Form Pendataran')
@section('content_title_icon')
<i class="big icons">
<i class="icon black user"></i>
<i class="icon corner red heart"></i>
</i>
@stop
@section('content_sub_title', 'Form pendaftaran dan list pendaftar hari ini')
@section('breadcrumbs')
<div class="ui blue top attached segment breadcrumb">
	<div class="ui breadcrumb">
		<a href="{{ url('administrasi') }}" class="section"><i class="icon home"></i>Home</a>
		<i class="right chevron icon divider"></i>
		<div class="active section">
			<i class="file outline icon"></i> Form Pendaftaran Pasien
		</div>
	</div>
</div>
@stop
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/sweetalert2/sweetalert2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/media/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Select/css/select.dataTables.min.css') }}">
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
@stop
@section('javascript')
<script type="text/javascript" src="{{ asset('/assets/pdfmake/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/pdfmake/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jszip/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/media/js/dataTables.semantic.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/buttons.print.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/buttons.colVis.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Select/js/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-address/jquery.address-1.5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/serialize-object.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-input-mask/min/inputmask/inputmask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-input-mask/min/inputmask/jquery.inputmask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-input-mask/min/inputmask/inputmask.date.extensions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/administrasi/pendaftaran.js') }}"></script>
@stop
@section('content')
<div class="ui grid">
	<div class="sixteen wide mobile thirteen wide tablet ten wide computer centered column">
		<div id="response-message" class="ui icon hidden message">
			<i class="close link icon"></i>
			<i id="icon-message" class="icon"></i>
			<div class="content">
				<div class="header"></div>
				<p></p>
				<span class="counter"></span>
			</div>
		</div>
		<form id="form-pendaftaran" class="ui form" method="POST" action="{{ url('administrasi/ajax/simpan-pendaftaran') }}">
			<h3 class="ui blue dividing header"><i class="file outline icon"></i>Form Pendaftaran</h3>
			{!! csrf_field() !!}
			<div class="three fields">
				<div class="required field">
					<label>Nama Pasien:</label>
					<input tabindex="1" type="text" name="nama" placeholder="Nama Pasien">
				</div>
				<div class="required field">
					<label>Nama Kepala Keluarga:</label>
					<input tabindex="2" type="text" name="kepala_keluarga" placeholder="Nama Kepala Keluarga">
				</div>
				<div class="required field">
					<label>Nomor Kartu Keluarga:</label>
					<input tabindex="3" type="text" name="no_kartu_keluarga" placeholder="Nomor Kartu Keluarga">
				</div>
			</div>
			
			<div class="fields">
				<div class="eight wide required field">
					<label>Tanggal Lahir:</label>
					<div class="ui icon input">
						<input tabindex="3" type="text" class="datepicker" name="tgl_lahir" placeholder="Tanggal Lahir">
						<i class="circular calendar pick-me-date link icon"></i>
					</div>
					<div class="help-form">Contoh: 14-02-1991</div>
				</div>
				<div class="eight wide required field">
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
			</div>
			<div class="two fields">
				<div class="required field">
					<label>Pekerjaan:</label>
					<input tabindex="6" type="text" name="pekerjaan" placeholder="Pekerjaan">
				</div>
				<div class="required field">
					<label>Agama:</label>
					<div tabindex="7" id="agama_dropdown" class="ui fluid selection dropdown">
						<input type="hidden" name="agama">
						<i class="dropdown icon"></i>
						<div class="default text">Agama</div>
						<div class="menu">
							<div class="item" data-value="Islam">Islam</div>
							<div class="item" data-value="Kristen">Kristen</div>
							<div class="item" data-value="Katholik">Katholik</div>
							<div class="item" data-value="Hindu">Hindu</div>
							<div class="item" data-value="Budha">Budha</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="required field">
				<label>Alamat:</label>
				<textarea tabindex="8" name="alamat" rows="3" placeholder="Alamat"></textarea>
			</div>
			
			<button tabindex="9" class="ui submit positive right labeled icon button" type="submit"><i class="icon send"></i>Daftarkan Pasien?</button>
		</form>
	</div>
</div>
@stop