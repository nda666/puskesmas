<div class="ui grid">
  <div class="four wide column">
    <div id="menu-tab" class="ui sticky menu-tab">
      <h4 class="ui top attached header"><i class="treatment icon"></i>List Konsultasi</h4>
      <div data-source="<?php echo e(url('/administrasi/rawat-jalan/data-id-konsultasi/'.$rawat_jalan->id)); ?>" id="tab-tindakan" class="ui attached vertical menu" data-token="<?php echo e(csrf_token()); ?>" data-id="<?php echo e($rawat_jalan->id); ?>">
      </div>
    </div>
  </div>
  <div id="data-tab-tindakan" data-source="<?php echo e(url('/administrasi/rawat-jalan/data-detail-tindakan')); ?>" class="twelve wide stretched column">
        <div id="data-konsultasi-tindakan">
          <h4 class="ui top attached header">Data Konsultasi</h4>
          <i style="position: absolute; right: 10px; top: 10px;" class="compress table-toggle link icon"></i>
          <table class="ui attached compact table">
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
            </tbody>
          </table>
        </div>

        <div id="data-result-tindakan">
          <i style="float: right; margin-top: 10px; margin-right: 10px;" class="compress table-toggle link icon"></i>
          <h4 class="ui top attached header">Data Tindakan</h4>
          <table class="ui attached compact table">
            <tbody>
              <tr>
                <td width="30%">Pengobatan</td>
                <td data-name="pengobatan"></td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td data-name="keterangan_tindakan"></td>
              </tr>
              <tr>
                <td>Petugas</td>
                <td data-name="petugas_tindakan"></td>
              </tr>
              <tr>
                <td>Tgl. Konsultasi</td>
                <td data-name="tgl_tindakan"></td>
              </tr>
            </tbody>
          </table>
        </div>

  </div>
</div>
