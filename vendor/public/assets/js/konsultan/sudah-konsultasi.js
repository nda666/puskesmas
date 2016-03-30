$(document).ready(function() {
    var table = $('#table-sudah-konsultasi').DataTable({
        language: {
            url: $('#table-sudah-konsultasi').data('lang')
        },
        searchDelay: 1000,
        stateSave: true,
        scrollY: '100vh',
        scrollX: true,
        scrollCollapse: true,
        select: {
            style: 'os',
            items: 'row'
        },
        dom: "<'left no padding-bottom floated aligned four wide computer column'l><'right no padding-bottom aligned twelve wide computer column'f>" +
            "<'ui button-container sixteen wide column'RB>" + "<'sixteen wide column no padding top bottom'tr>" +
            "<'left aligned four wide column'i><'right aligned twelve wide column'p>",
        processing: true,
        serverSide: true,
        filter: true,
        sort: true,
        info: true,
        ajax: {
            url: $('#table-sudah-konsultasi').data('source'),
        },
        columns: [{
            data: "id",
            name: 'id',
        }, {
            data: "nama_pasien",
            name: 'nama_pasien'
        }, {
            data: 'nama_kepala_keluarga',
            name: 'nama_kepala_keluarga'
        }, {
            data: 'pekerjaan',
            name: 'pekerjaan'
        }, {
            data: 'tgl_lahir',
            name: 'tgl_lahir'
        }, {
            data: 'agama',
            name: 'agama'
        }, {
            data: 'jenis_kelamin',
            name: 'jenis_kelamin'
        }, {
            data: "alamat",
            name: 'alamat'
        }, {
            data: 'jenis_kunjungan',
            name: 'jenis_kunjungan'
        }, {
            data: 'jenis_kepesertaan',
            name: 'jenis_kepesertaan'
        }, {
            data: 'tgl_daftar',
            name: 'tgl_daftar',
        }, {
            data: 'konsultasi',
            name: 'konsultasi'
        }, {
            data: 'petugas',
            name: 'petugas'
        }],
        buttons: [{
            extend: 'colvis',
            className: 'primary',
            text: '<i class="icon eye"></i>Tampil',
            postfixButtons: ['colvisRestore']
        }, {
            text: '<i class="refresh icon"></i>Refresh',
            className: 'violet',
            action: function(e, dt, node, config) {
                table.ajax.reload();
            }
        }, {
            text: '<i class="plus icon"></i>Lihat',
            className: 'violet',
            action: function(e, dt, node, config) {
                var data = dt.row({
                    selected: true
                }).data();
                if (!data) {
                    return false;
                }
                window.location.href = '/konsultan/sudah-konsultasi/view/' + data.id + '#/form-konsultasi';
            }
        }],
        drawCallback: function() {

        }
    });
    refresher = setInterval(function() {
        table.ajax.reload(null, false);
    }, 600000);
    $('#table-sudah-konsultasi').on('click', '.view-pasien', function() {
        var data = table.row($(this).parents('tr')).data();

    });
});