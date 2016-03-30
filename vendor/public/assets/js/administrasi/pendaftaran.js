$(document).ready(function(event) {
    var table = $('#data-pendaftar').DataTable({
        language: {
            url: $('#data-pendaftar').data('lang')
        },
        searchDelay: 1000,
        stateSave: true,
        scrollY: '100vh',
        scrollX: true,
        scrollCollapse: true,
        select: {
            style: 'os',
            items: 'cell'
        },
        autoWidth: false,
        dom: "<'left no padding-bottom floated aligned four wide computer column'l><'right no padding-bottom aligned twelve wide computer column'f>" +
            "<'ui button-container sixteen wide column'RB>" + "<'sixteen wide column no padding top bottom'tr>" +
            "<'left aligned four wide column'i><'right aligned twelve wide column'p>",
        processing: true,
        pagingType: 'full_numbers',
        serverSide: true,
        filter: true,
        buttons: [{
                extend: 'colvis',
                className: 'primary',
                text: '<i class="icon eye"></i>Tampilkan',
                postfixButtons: ['colvisRestore']
            }, {
                text: '<i class="icon refresh"></i>Refresh',
                className: 'violet',
                action: function(e, dt, node, config) {
                    table.ajax.reload();
                }
            }, {
                extend: 'copyHtml5',
                className: 'primary',
                text: '<i class="icon copy"></i>Copy',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'print',
                text: '<i class="icon print"></i>Cetak',
                className: 'primary',
                message: 'List pendaftar hari ini.',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'csvHtml5',
                className: 'primary',
                text: '<i class="icon excel file outline"></i> Simpan ke CSV',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'excelHtml5',
                className: 'primary',
                text: '<i class="icon excel file outline"></i> Simpan ke Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            /**{
                       extend: 'pdfHtml5',
                       className: 'primary',
                       text: '<i class="icon pdf file outline"></i> Simpan ke PDF',
                       pageSize: 'A4',
                       exportOptions: {
                               columns: ':visible'
                           }
                   }**/
        ],
        sort: true,
        info: true,
        ajax: {
            url: $('#data-pendaftar').data('source'),
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
            data: 'konsultasi'
        }, {
            data: 'resep',
            data: 'resep'
        }, {
            data: 'obat',
            data: 'obat'
        }],
        drawCallback: function() {},
    });

    $('.tabular.menu .item').tab({
        history: true,
        onLoad: function() {
            table.draw();
        }
    });
    
});