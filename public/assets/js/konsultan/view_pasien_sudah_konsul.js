$(document).ready(function() {
    $('.ui.button, .item').popup();
    $('#tab-konsultasi .item').tab({
        history: true
    });
    $('.toggler').on('click', function(e) {
        e.preventDefault();
        $($(this).data('target')).transition('fade up');
        $(this).find('i').hasClass('down') ? $(this).find('i').removeClass('down').addClass('up') : $(this).find('i').removeClass('up').addClass('down');
    });
    var notifikasi = $('#modal-notifikasi'),
        modal = $('#modal-insert')
    lock = false;
    $('#form-konsultasi').form({
        inline: true,
        on: 'blur',
        fields: {
            pemeriksaan_fisik: {
                identifier: 'pemeriksaan_fisik',
                rules: [{
                    type: 'empty',
                    prompt: 'Pemeriksaan Fisik belum di isi'
                }]
            },
            diagnosa: {
                identifier: 'diagnosa',
                rules: [{
                    type: 'empty',
                    prompt: 'Anamesa / Diagnosa belum di isi'
                }]
            },
            tindakan: {
                identifier: 'tindakan',
                rules: [{
                    type: 'empty',
                    prompt: 'Pengobatan / Tindakan belum di isi'
                }]
            },
        }
    });
    $('.modal-insert').click(function(e) {

    });
    $('#form-konsultasi').submit(function(e) {

        e.preventDefault();
        if ($(this).hasClass('loading')) {
            return false;
        }
        if (!$(this).form('is valid')) {
            return false;
        }
        $('.approve').attr('disabled', 'disabled');
        var data = $(this).serialize(),
            url = $(this).attr('action'),
            ele = $(this);
        ele.addClass('loading');
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {
                if (response.response == true) {
                    modal.modal('hide');
                    swal('Sukses', response.message, 'success')
                    table.ajax.reload(null, false);
                } else {
                    modal.modal('hide');
                    swal('Gagal', response.message, 'error')
                }
            },
            complete: function() {
                ele.removeClass('loading');
                $('.approve').removeAttr('disabled');
            }
        });

    });

    $('.simpan-data-pasien').click(function(e) {
        e.preventDefault();
        if ($(this).hasClass('disabled')) {
            return false;
        }

    })
    table = $('#data-konsultasi').DataTable({
        language: {
            url: $('#data-konsultasi').data('lang')
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
            url: $('#data-konsultasi').data('source'),
            complete: function(response) {
                var data = $.parseJSON(response.responseText);
                if (data.data.length <= 0) {
                    $('.simpan-data-pasien').addClass('disabled');
                } else {
                    $('.simpan-data-pasien').removeClass('disabled');
                }
            }
        },
        columns: [{
            data: "id",
            name: 'id',
        }, {
            data: "pemeriksaan_fisik",
            name: 'pemeriksaan_fisik'
        }, {
            data: "diagnosa",
            name: 'diagnosa'
        }, {
            "data": "tindakan",
            name: 'tindakan'
        }, {
            "data": "nama_pegawai",
            name: 'nama_pegawai'
        }, {
            'data': 'tanggal',
            'name': 'tanggal'
        },],
        buttons: [{
            extend: 'colvis',
            className: 'primary',
            text: '<i class="icon eye"></i>Tampilkan',
            postfixButtons: ['colvisRestore']
        }, {
            text: '<i class="refresh icon"></i>Refresh',
            className: 'violet',
            action: function(e, dt, node, config) {
                table.ajax.reload();
            }
        }, {
            text: '<i class="close icon"></i>Batal kirim',
            className: 'negative',
            action: function() {
                var token = $('#data-konsultasi').data('token'),
                    url = '/konsultan/ajax/batal-konsultasi',
                    id_pasien = $('#data-konsultasi').data('pasien');
                swal({
                    title: 'Batalkan?',
                    text: 'Batalkan dan ubah lagi data konsultasi pasien',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Iya',
                    closeOnConfirm: true
                }, function() {
                    swal.disableButtons();
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: token,
                            id_pasien: id_pasien
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.response) {
                                swal({
                                    title: 'Sukses',
                                    type: 'success',
                                    text: data.message,
                                    timer: 6000
                                }, function() {
                                    window.location.href = data.redirect;
                                })
                                return false;
                            } else {
                                swal('Gagal', data.message, 'error')
                            }
                        }
                    });
                });
            }
        }],
        drawCallback: function(data) {
            $('.ui.button').popup();
        }
    });
    $('#data-konsultasi').on('click', '.ubah-konsultasi', function() {
        var data = table.row($(this).parents('tr')).data(),
            form = $('#form-konsultasi');
        form.find('[name="id_konsultasi"]').val(data['id']);
        form.find('[name="tindakan"]').val(data['tindakan']);
        form.find('[name="pemeriksaan_fisik"]').val(data['pemeriksaan_fisik']);
        form.find('[name="diagnosa"]').val(data['diagnosa']);
        modal.modal({
            closable: false,
            onApprove: function() {
                $('#form-konsultasi').submit();
                return false;
            },
        }).modal('show');
    });
    $('#data-konsultasi').on('click', '.hapus-konsultasi', function() {


    });
});