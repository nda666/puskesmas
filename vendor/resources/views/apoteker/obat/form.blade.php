<div class="ui small basic modal" id="modal-insert">
	<div class="content">
    <div style="width: 350px; margin: 0 auto;" class="ui segment">
      <h3 class="ui dividing header"></h3>
      <i class="close black link icon closer-modal"></i>
      <form id="form-insert" data-delete="{{ url('apoteker/obat/delete') }}" data-update="{{ url('apoteker/obat/obat-detail') }}" class="ui equal width form"
  			data-token="{{ csrf_token() }}"
  			action="{{ url('apoteker/obat/create') }}">
  			{!! csrf_field() !!}
  			<input type="hidden" name="id">
				<div class="action required field">
          <label>Kode:</label>
          <input type="text" name="kode" />
        </div>
				<div class="action required field">
          <label>Nama:</label>
          <input type="text" name="nama" />
        </div>
        <div style="text-align: right" class="field modal-action-form">
          <div type="button" class="ui negative icon button">
            <i class="close icon"></i> Batal
          </div>
          <div type="submit" class="ui approve positive icon button">
            <i class="save icon"></i> Simpan
          </div>
        </div>
  		</form>
    </div>

	</div>
</div>
