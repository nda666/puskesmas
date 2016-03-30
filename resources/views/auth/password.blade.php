<?php $pegawai = auth()->guard('pegawai')->user();?>
<div class="ui centered grid">
	<div class="twelve wide mobile eight wide tablet six wide computer column">
		<form id="form-password" class="ui equal width form" method="POST" action="{{ url(strtolower($pegawai->jabatan).'/profile/update-password') }}">
			{!! csrf_field() !!}
			<input type="hidden" value="{{ $pegawai->id }}" name="id">
			<div class="required field">
				<label>Password</label>
				<input type="password" name="password">
			</div>
			<div class="required field">
				<label>Konfirmasi Password</label>
				<input type="password" name="password_confirmation">
			</div>

			<div class="field">
				<button type="reset" class="ui orange icon button "><i class="undo icon"></i>Reset</button>
				<button type="submit" class="ui positive icon button "><i class="icon save"></i>Simpan</button>
			</div>
		</form>
	</div>
</div>
