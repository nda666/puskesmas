<?php $__env->startSection('title','Profil Saya'); ?>
<?php $__env->startSection('content'); ?>
<h3 class="ui header divided">Pasien Belum Konsultasi</h3>
<div id="tab-profil" class="ui secondary pointing blue menu">
	<a class="active item" data-tab="biodata">Pofile Saya</a>
	<a class="item" data-tab="ubah-password">Ubah Password</a>
</div>
<div class="ui active bottom attached tab segment" data-tab="biodata">
	<div class="ui centered grid">
		<div class="ui ten wide column computer">
			<h4 class="ui dividing header blue"><i class="icon doctor"></i>Ubah Profil Saya</h4>
			<form class="ui form">
				<?php echo csrf_field(); ?>

				<div class="three wide fields">
					<div class="field">
						<label>Nama:</label>
						<input type="text" readonly="" value="<?php echo e($pegawai->nama_pegawai); ?>">
					</div>
					<div class="field">
						<label>NIP:</label>
						<input type="text" readonly="" value="<?php echo e($pegawai->nip); ?>">
					</div>
					<div class="field">
						<label>Posisi:</label>
						<input type="text" readonly="" value="<?php echo e($pegawai->jabatan); ?>">
					</div>
				</div>
				<div class="field">
					<label>Gender:</label>
					<div class="ui selection dropdown">
						<input type="hidden" value="<?php echo e($pegawai->jenis_kelamin); ?>" name="jenis_kelamin">
						<i class="dropdown icon"></i>
						<div class="default text">Gender</div>
						<div class="menu">
							<div class="item" data-value="Laki-Laki">Laki-Laki</div>
							<div class="item" data-value="Perempuan">Perempuan</div>
						</div>
					</div>
				</div>
				<div class="field">
					<label>Tanggal Lahir:</label>
					<input type="text" name="tgl-lahir" value="<?php echo e($pegawai->tgl_lahir); ?>">
				</div>
				<div class="field">
					<label>No Telp:</label>
					<input type="text" name="no_telp" value="<?php echo e($pegawai->no_telp); ?>">
				</div>
				<div class="field">
					<label>Alamat:</label>
					<textarea cols="3" name="alamat"><?php echo $pegawai->alamat; ?></textarea>
				</div>
					<div class="ui vertical segment right aligned">
						<button type="reset" class="ui button labeled negative icon"><i class="icon undo"></i> Reset</button>
						<button type="submit" class="ui button right labeled primary icon"><i class="icon save"></i> Simpan</button>
					</div>
				
			</form>
		</div>
	</div>
</div>
<div class="ui top attached tab segment" data-tab="ubah-password">
	<div class="ui centered grid">
		<div class="ui ten wide column computer">
			<h4 class="ui dividing red header"><i class="icon lock"></i>Ubah Password Saya</h4>
			<form class="ui form">
				<div class="field">
					<label>Password:</label>
					<input placeholder="Masukkan Password Baru" type="password" name="password">
				</div>
				<div class="field">
					<label>Konfirmasi Password</label>
					<input placeholder="Ketik Lagi Password Baru" type="password" name="passwordConf">
				</div>
				<div class="field">
					<div class="ui vertical segment right aligned">
						<button type="reset" class="ui button labeled negative icon"><i class="icon undo"></i> Reset</button>
						<button type="submit" class="ui button right labeled primary icon"><i class="icon save"></i> Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$.getScript('/assets/js/konsultan/profil.js');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('konsultan.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>