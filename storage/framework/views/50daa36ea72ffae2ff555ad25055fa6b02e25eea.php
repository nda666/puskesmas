<div class="ui grid">
	<div class="sixteen wide column">
		<div id="response-message" class="ui icon hidden message">
			<i class="close link icon"></i>
			<i id="icon-message" class="icon"></i>
			<div class="content">
				<div class="header"></div>
				<p></p>
				<span class="counter"></span>
			</div>
		</div>
		<form id="form-pendaftaran" class="ui form" method="POST"
			data-token="<?php echo e(csrf_token()); ?>" action="<?php echo e(url('administrasi/pendaftaran/simpan-pendaftaran')); ?>">
			<?php echo csrf_field(); ?>

			<input type="hidden" name="id">
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
			<div class="ui segment field">
				<div class="ui checkbox" style="width: 100%;">
					<input type="checkbox" value="check" name="daftar_rawat_jalan" id="daftar_rawat_jalan">
					<label>Langsung daftarkan ke rawat jalan? (Optional)</label>
				</div>
			</div>
			<div id="rawat-jalan-field" class="hidden-field">
				<div class="required field">
					<label>Jenis Kepesertaan</label>
					<div tabindex="5" class="ui fluid selection dropdown">
						<input type="hidden" name="jenis_kepesertaan">
						<i class="dropdown icon"></i>
						<div class="default text">Jenis Kepesertaan</div>
						<div class="menu">
							<div class="item" data-value="BPJS / Umum">BPJS / Umum</div>
							<div class="item" data-value="ASKES">ASKES</div>
							<div class="item" data-value="BUMIL">BUMIL</div>
							<div class="item" data-value="ASPRAS">ASPRAS</div>
							<div class="item" data-value="Lain - Lain">Lain - Lain</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
