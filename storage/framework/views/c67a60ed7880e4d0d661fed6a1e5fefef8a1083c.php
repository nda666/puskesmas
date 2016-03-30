<div class="ui grid">
	<div class="sixteen wide column">
		<form id="form-rawat-jalan" class="ui form" method="POST"
			data-token="<?php echo e(csrf_token()); ?>" action="<?php echo e(url('administrasi/pendaftaran/daftar-rawat-jalan')); ?>">
			<?php echo csrf_field(); ?>

			<div class="two fields">
				<div class="field">
					<label>ID:</label>
					<input type="text" readonly data-name="id" name="pasien_id">
				</div>
				<div class="field">
					<label>Nama Pasien:</label>
					<input tabindex="1" readonly type="text" name="nama" placeholder="Nama Pasien">
				</div>
				</div>
				<div class="required field">
					<label>Jenis Kepesertaan</label>
					<div tabindex="2" id="jenis_kelamin_dropdown" class="ui fluid selection dropdown">
						<input type="hidden" name="kepesertaan">
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
				<div style="text-align: right" class="field modal-action-form">
          <button type="button" class="ui negative icon button">
            <i class="close icon"></i> Batal
          </button>
          <button type="submit" class="ui approve positive icon button">
            <i class="save icon"></i> Simpan
          </button>
        </div>
			</form>
		</div>
	</div>
