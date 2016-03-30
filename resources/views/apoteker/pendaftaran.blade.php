@extends('administrasi.default')
@section('title', 'Input Baru Pasien')
@section('content_title')
<i class="big icons">
<i class="user thin icon"></i>
<i class="mini outline corner file text icon"></i>
</i>
<div class="content">
	Pendaftaran
	<div class="sub header">Form Pendaftaran Pasien Puskesmas Patrang</div>
</div>
@stop
@section('breadcrumbs')
	<div class="ui breadcrumb">
		<a class="section"><i class="icon home"></i>Home</a>
		<i class="right arrow icon divider"></i>
		<div class="active section"><i class="icon edit"></i>Pendaftaran</div>
	</div>
@stop
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('/assets/jquery-ui-custom/jquery-ui.min.css') }}">
@stop
@section('javascript')
<script type="text/javascript" src="/assets/jquery-ui-custom/jquery-ui.min.js"></script>
<script src="/assets/jquery-ui/i18n/datepicker-id.js" type="text/javascript"></script>
<script src="{{ asset('/assets/jquery-input-mask/min/inputmask/inputmask.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/jquery-input-mask/min/inputmask/jquery.inputmask.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/jquery-input-mask/min/inputmask/inputmask.date.extensions.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
	$('[name="tgl_lahir"]').inputmask('dd-mm-yyyy');
$('#tgl_lahir_picker').click(function(e) {
    e.preventDefault();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true
    }).datepicker('show');
});
$('.ui.button').popup();
$('#jenis_kunjungan_dropdown').dropdown();
$('#jenis_kelamin_dropdown').dropdown();
$('#kepesertaan-dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        if (value == 0) {
            $('[name="_jenis_kepesertaan"]').attr('type', 'text').fadeIn();
        } else {
            $('[name="_jenis_kepesertaan"]').attr('type', 'hidden').fadeOut();
            $('[name="_jenis_kepesertaan"]').val('');
        }
    }
});

$('#form-pasien').form({
    fields: {
        nama_pasien: 'empty',
        jenis_kelamin: 'empty',
        alamat: 'empty',
        pekerjaan: 'empty',
        tgl_lahir: 'empty',
        jenis_kepesertaan: 'empty',
        jenis_kunjungan: 'empty',
        agama: 'empty',
    }
});
$('#get_umur').click(function(e) {
    e.preventDefault();
    var tgl_lahir = $('[name="tgl_lahir"]').val(),
        target = $(this).data('target'),
        element = $(this);
    if (tgl_lahir === "") {
        return false;
    }
    element.addClass('disabled').parent().addClass('left icon disabled');
    element.parent().append('<i id="loading-fix" class="icon"></i>').addClass('loading');
    $.ajax({
        url: target,
        type: 'GET',
        dataType: 'json',
        data: {
            tgl_lahir: tgl_lahir
        },
    }).done(function(data) {
        $('[name="umur"]').val(data['umur']);
    }).always(function() {
        element.removeClass('disabled').parent().removeClass('left icon disabled loading');
        element.parent().find('#loading-fix').remove();
    });
});
</script>
@stop
@section('content')
<div class="ui segment">
	<form id="form-pasien" class="ui form" method="POST" action="{{ url('admin/pendaftaran') }}">
		{!! csrf_field() !!}
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
					<button type="button" id="get_umur" data-content="Hitung umur berdasarkan tanggal lahir" data-target="{{ url('pasien/get_umur') }}" class="ui positive button">Hitung Umur</button>
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
		<button tabindex="12" class="ui button primary right labeled icon" type="submit"><i class="icon send"></i>Submit</button>
	</form>
</div>
<div id="date-picker-container"></div>
<div id="confirm-submit" class="ui small basic modal">
	<div class="header">Konfirmasi</div>
	<div class="image content">
		<div class="image">
			<i class="huge icons"><i class="icon browser"></i><i class="icon corner gray save"></i></i>
		</div>
		<div class="description">
			Form ini akan disimpan ke Server. Anda yakin ingin menyimpan data ini?
		</div>
	</div>
	<div class="actions">
		<div class="ui cancel negative button">Tidak</div>
		<div class="ui approve positive button">Ya</div>
	</div>
</div>
@stop