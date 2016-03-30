<div class="ui grid">
  <div class="four wide column">
    <div id="menu-tab" class="ui sticky menu-tab">
      <h4 class="ui top attached header"><i class="treatment icon"></i>List Konsultasi</h4>
      <div data-source="{{ url('/administrasi/rawat-jalan/data-id-konsultasi/'.$rawat_jalan->id) }}" id="tab-tindakan" class="ui attached vertical menu" data-token="{{ csrf_token() }}" data-id="{{ $rawat_jalan->id }}">
      </div>
    </div>
  </div>
  <div id="data-tab-tindakan" data-source="{{ url('/administrasi/rawat-jalan/data-detail-tindakan') }}" class="twelve wide stretched column">
    <form method="POST" action="{{ url('/administrasi/rawat-jalan/simpan-tindakan') }}" class="ui form form-tindakan">
      <div class="disabled field">
        <div id="data-konsultasi-tindakan">
          <h4 class="ui top attached header">Data Konsultasi</h4>
          <i style="position: absolute; right: 10px; top: 10px;" class="compress table-toggle link icon"></i>
          <table class="ui definition attached compact table">
            <tbody>
              <tr>
                <td width="30%">Pemeriksaan Fisik</td>
                <td data-name="pemeriksaan_fisik"></td>
              </tr>
              <tr>
                <td>Diagnosa</td>
                <td data-name="diagnosa"></td>
              </tr>
              <tr>
                <td>Kasus</td>
                <td data-name="kasus"></td>
              </tr>
              <tr>
                <td>Poli</td>
                <td data-name="nama_poli"></td>
              </tr>
              <tr>
                <td>Tgl. Konsultasi</td>
                <td data-name="tgl_konsultasi"></td>
              </tr>
              <tr>
                <td>Petugas</td>
                <td data-name="nama_petugas"></td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td data-name="keterangan_konsultasi"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="disabled field">

        <div id="data-result-tindakan">
          <i style="float: right; margin-top: 10px; margin-right: 10px;" class="compress table-toggle link icon"></i>
          <h4 class="ui top attached header">Data Tindakan</h4>
          <table class="ui definition attached compact table">
            <tbody>
              <tr>
                <td width="30%">Pengobatan</td>
                <td data-name="pengobatan"></td>
              </tr>
              <tr>
                <td>Petugas</td>
                <td data-name="petugas_tindakan"></td>
              </tr>
              <tr>
                <td>Tgl. Konsultasi</td>
                <td data-name="tgl_tindakan"></td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td data-name="keterangan_tindakan"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <h4 class="ui top attached header">Form Tindakan</h4>
    <div class="ui attached segment">
      {{ csrf_field() }}
      <input type="hidden" name="ruang_konsul_id">
      <input type="hidden" name="id">
      <div class="disabled required field">
        <label>Pengobatan: </label>
        <textarea placeholder="Pengobatan" rows="3" name="pengobatan"></textarea>
        <div></div>
      </div>
      <div class="disabled field">
        <label>Keterangan (Optional): </label>
        <textarea placeholder="Ketik Data Keterangan (Optional)" rows="3" name="keterangan"></textarea>
      </div>
      <div class="disabled field">
        <button title="Hapus data konsultasi" data-action="{{ url('/administrasi/rawat-jalan/delete-tindakan') }}" data-id="" type="button" class="ui negative hapus-tindakan button" disabled="disabled"><i class="trash icon"></i>Hapus</button>
        <button title="Simpan / Update data tindakan" type="submit" class="ui positive button"><i class="save icon"></i>Simpan</button>
      </div>
    </div>

    </form>
  </div>
</div>
