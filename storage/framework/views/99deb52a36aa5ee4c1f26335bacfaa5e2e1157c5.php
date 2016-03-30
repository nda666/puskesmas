<h3 class="ui header dividing">Profil Saya</h3>

<form id="form-insert" class="ui equal width form" method="POST" 
	action="<?php echo e(url('auth/profile/update')); ?>">
	<?php echo csrf_field(); ?>


	<input type="hidden" value="<?php echo e(auth()->guard('pegawai')->user()->id); ?>" name="id">
	

	<div class="required three fields">

		<div class="required field">
			<label>Nama Pegawai:</label>
			<input type="text" value="<?php echo e(auth()->guard('pegawai')->user()->nama_pegawai); ?>" name="nama_pegawai"></input>
		</div>
		<div class="required field">
			<label>Gender:</label>
			<div class="ui selection dropdown">
				<input type="hidden" value="<?php echo e(auth()->guard('pegawai')->user()->jenis_kelamin); ?>" name="jenis_kelamin">
				<i class="dropdown icon"></i>
				<div class="default text">Gender</div>
				<div class="menu">
					<div class="item" data-value="Laki-Laki">Laki-Laki</div>
					<div class="item" data-value="Perempuan">Perempuan</div>
				</div>
			</div>
		</div>
		<div class="required field">
			<label>Agama:</label>
			<div class="ui selection dropdown">
				<input type="hidden" value="<?php echo e(auth()->guard('pegawai')->user()->agama); ?>" name="agama">
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
	<div class="required two fields">
		<div class="required field">
			<label>Tanggal Lahir:</label>
			<input placeholder="Tanggal Lahir" value="<?php echo e(auth()->guard('pegawai')->user()->tgl_lahir->format('d-m-Y')); ?>" type="text" name="tgl_lahir"></input>
		</div>
		
		
		<div class="required field">
			<label>No Telp:</label>
			<input placeholder="Nomor Telepon" value="<?php echo e(auth()->guard('pegawai')->user()->no_telp); ?>" type="text" name="no_telp"></input>
		</div>
	</div>
	<div class="required field">
		<label>Alamat:</label>
		<textarea name="alamat" rows="3"><?php echo e(auth()->guard('pegawai')->user()->alamat); ?></textarea>
	</div>
	<div class="field">
		<button type="reset" class="ui orange icon button "><i class="undo icon"></i>Reset</button>
		<button type="submit" class="ui positive icon button "><i class="icon save"></i>Simpan</button>
	</div>
</form>
<script type="text/javascript">
	$('.ui.dropdown').dropdown();
</script>