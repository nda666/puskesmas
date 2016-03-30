<div class="ui grid">
	<div class="sixteen wide column">
		<form id="form-ubah" class="ui form" method="POST"
			data-token="{{ csrf_token() }}" action="{{ url('administrasi/pendaftaran/ubah-data-pasien') }}">
			{!! csrf_field() !!}
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
		</form>
	</div>
</div>
