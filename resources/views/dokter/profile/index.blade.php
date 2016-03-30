@extends('dokter.default')
@section('javascript')
<script type="text/javascript" src="{{ asset('/assets/jquery-address/jquery.address-1.5.min.js') }}"></script>
<script type="text/javascript">
	$('#tab-menu .item').tab({
		history: true
	})
</script>
@stop
@section('content')
<div id="tab-menu" class="ui top attached tabular menu">
	<a class="active item" data-tab="my-profile">Profil Saya</a>
	<a class="item" data-tab="password">Ubah Password</a>
</div>
<div class="ui bottom attached active tab segment" data-tab="my-profile">
@if (session('response'))
<div class="ui @if (session('response') == false) error @endif icon message">
	@if (session('response'))
	<i class="icon check"></i>
	@else
	<i class="icon close"></i>
	@endif
	<div class="content">
		<p>{!! session('message') !!}</p>
	</div>
</div>
@endif
@if (count($errors) > 0)
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
	@include('auth.profile')
</div>
<div class="ui bottom attached tab segment" data-tab="password">
	@include('auth.password')
</div>
@stop