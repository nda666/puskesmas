<div class="ui long small modal" id="modal-konsultasi-insert">
  <i class="close icon"></i>
  <div class="header"></div>
  <div class="content">
    <form id="form-konsultasi" data-update="{{ url('/konsultan/rawat-jalan/data-konsultasi-form') }}" class="ui equal width form" data-token="{{ csrf_token() }}" data-id="{{ $rawat_jalan->id }}" action="{{ url('konsultan/rawat-jalan/simpan-konsultasi') }}">
      {!! csrf_field() !!}
      <input type="hidden" name="id">
      <input type="hidden" readonly value="{{ $rawat_jalan->id }}" name="rawat_jalan_id">
      <div class="required field">
        <label>Pemeriksaan Fisik:</label>
        <textarea placeholder="Pemeriksaan Fisik" rows="3" name="pemeriksaan_fisik"></textarea>
      </div>
      <div class="required field">
        <label>Anamesa / Diagnosa:</label>
        <textarea placeholder="Diagnosa / Anamesa" rows="3" name="diagnosa"></textarea>
      </div>
      <div class="two fields">
        <div class="required field">
          <label>Ke Poli:</label>
          <div id="poli-dropdown" data-source="{{ url('/konsultan/rawat-jalan/data-poli') }}" class="ui fluid search normal selection dropdown">
            <input type="hidden" class="hidden-dropdown" name="poli_id">
            <i class="dropdown icon"></i>
            <div class="default text">Masukkan Ke Poli</div>
          </div>
        </div>

        <div class="required field">
          <label>Kasus:</label>
          <div id="kasus-dropdown" class="ui fluid search normal selection dropdown">
            <input type="hidden" class="hidden-dropdown" name="kasus">
            <i class="dropdown icon"></i>
            <div class="default text">Pilih Kasus</div>
            <div class="menu">
              <div class="item" data-value="Baru">Baru</div>
              <div class="item" data-value="Lama">Lama</div>
            </div>
          </div>
        </div>

      </div>
      <div class="field">
        <label>Keterangan (Optional):</label>
        <textarea placeholder="Keterangan (Optional)" rows="3" name="keterangan"></textarea>
      </div>
    </form>
  </div>
  <div class="actions">
    <button class="ui negative button">
      <i class="close icon"></i>Batal</button>
    <button class="ui submit positive approve button">
      <i class="icon save"></i>Simpan</button>
  </div>
</div>
