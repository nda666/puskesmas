<h3 class="ui header dividing">ubah Password</h3>
<form id="form-password" class="ui equal width form" method="POST" 
	action="<?php echo e(url('auth/profile/update-password')); ?>">
	<?php echo csrf_field(); ?>


	<input type="hidden" value="<?php echo e(auth()->guard('pegawai')->user()->id); ?>" name="id">
	<div class="required six wide field">
		<label>Password</label>
		<input type="password" name="password">
	</div>
	<div class="required six wide field">
		<label>Konfirmasi Password</label>
		<input type="password" name="password_confirmation">
	</div>

	<div class="field">
		<button type="reset" class="ui orange icon button "><i class="undo icon"></i>Reset</button>
		<button type="submit" class="ui positive icon button "><i class="icon save"></i>Simpan</button>
	</div>

</form>
<script type="text/javascript">
	$('.ui.dropdown').dropdown();
	$('#form-password').form({
		inline: true,
		on: 'submit',
		fields: {
      password    : ['minLength[6]', 'empty'],
      password_confirmation   : 'match[password]',
  }
	});
</script>