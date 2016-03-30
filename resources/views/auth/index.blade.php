@extends(strtolower($pegawai->jabatan).'.default') @section('title','Profile') @section('content_title', 'Profile') @section('content_sub_title', 'Ubah data dan password pengguna') @section('content_title_icon')
<i class="big icons">
<i class="settings icon"></i>
</i>
@stop
@section('breadcrumbs')
	<div class="ui top attached panel-header segment">
	  <div class="ui grid">
	    <div class="six wide column computer">
	      <h4 class="ui header" id="panel-title"></h4>
	    </div>
	    <div class="right aligned ten wide column computer">
	      <div class="ui breadcrumb">
					<?php $pegawai = auth()->guard('pegawai')->user(); ?>
	        <a href="{{ url(strtolower($pegawai->jabatan).'') }}" class="section">
	          <i class="icon black home"></i>Home</a>
	        <span class="divider">/</span>
	        <div class="section">
	          <i class="icon settings"></i>My Profile</div>
	      </div>
	    </div>
	  </div>
	</div>
@stop
@section('javascript')
<script type="text/javascript" src="{{ asset('/assets/jquery-address/jquery.address-1.5.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('/assets/js/profile.js') }}"></script>
<script type="text/javascript">
	$('#tab-menu .item').tab({
		history: true,
		onLoad: function(e, f){
			switch (e){
				case 'my-profile':
				$('#panel-title').text('Profil Saya');
				break;
				case 'password':
				$('#panel-title').text('Ubah Password');
				break;
				default:
				break;
			}
		}
	});
	</script>
	@if (session('response'))
	<script type="text/javascript">
		$(document).ready(function(e){
			$('a[data-tab="password"]').click();
		})
	</script>
	@endif
@stop
@section('content')
<?php $pegawai = auth()->guard('pegawai')->user(); ?>
<div class="sixteen wide column">
	<div id="tab-menu" class="ui stackable fluid menu">
		<a class="active item" data-tab="my-profile">Profil Saya</a>
		<a class="item" data-tab="password">Ubah Password</a>
	</div>
	{{-- Message Flash --}}
	@if (session('response'))
	<div class="ui @if (session('response') == false) error @endif icon message">
		@if (session('response'))
		<i class="icon check"></i> @else
		<i class="icon close"></i> @endif
		<div class="content">
			<p>{!! session('message') !!}</p>
		</div>
	</div>
	@endif @if (count($errors) > 0)
	<div class="ui error icon message">
		<i class="icon warning sign"></i>
		<p>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</p>
	</div>
	@endif
	{{-- End of Message Flash --}}
	<div class="ui tab vertical segment no-border-bottom" data-tab="my-profile">
		<div class="ui centered grid">
			<div class="eight wide mobile six wide computer column">
				<div style="margin: 0 auto;" class="ui special card">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
							<div class="content">
								<div class="center">
									<p>Max Ukuran: 2MB (.jpg, png, bmp)</p>
									<div class="ui ubah-foto inverted button">Ubah Foto</div>
									<form action="{{ url(strtolower($pegawai->jabatan).'/profile/update-foto') }}" enctype="multipart/form-data" class="form-ubah-foto">
										{{ csrf_field() }}
										<input type="hidden" name="id" value="{{$pegawai->id }}" />
										<input type="file" name="foto" style="height: 0.1px !important; width:0.1px !important;" />
									</form>
								</div>
							</div>
						</div>
						@if (!$pegawai->foto ||$pegawai->foto == null) @if (auth()->guard('pegawai')->user()->jenis_kelamin == 'Laki-Laki')
						<img class="foto-profil" src="{{ url('foto-profil/default-l.jpg') }}" /> @else
						<img class="foto-profil" src="{{ url('foto-profil/default-p.jpg') }}" /> @endif @else
						<img class="foto-profil" src="{{ asset(auth()->guard('pegawai')->user()->foto) }}" /> @endif
					</div>
					<div class="content">
						<div class="header">{{$pegawai->nama }}</div>
						<div class="meta">
							<a>{{$pegawai->jabatan }}</a>
						</div>
					</div>
				</div>
			</div>
			<div class="ten wide computer column">
				@include('auth.profile')
			</div>
		</div>
	</div>
	<div class="ui vertical tab segment no-border-bottom" data-tab="password">
		@include('auth.password')
	</div>
</div>
@stop
