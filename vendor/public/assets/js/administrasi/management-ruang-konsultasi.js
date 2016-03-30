$(document).ready(function(event) {
  var data_konsultasi = null;
  var table = $('#data-ruang-konsultasi').DataTable({
    ajax: {
      url: $('#data-ruang-konsultasi').data('source'),
    },
    language: {
      url: $('#data-ruang-konsultasi').data('lang')
    },
    lengthMenu: [
      [15, 20, 100, 200, 500, -1],
      [15, 20, 100, 200, 500, 'Semua'],
    ],
    colReorder: true,
    searchDelay: 1000,
    stateSave: true,
    scrollX: true,
    scrollY: '60vh',
    scrollCollapse: true,
    select: {
      style: 'os',
      items: 'row'
    },
    dom: "<'left no padding-bottom floated aligned four wide computer column'l><'right no padding-bottom aligned twelve wide computer column'f>" + "<'ui button-container sixteen wide column'<'ui toolbars segment'>>" + "<'sixteen wide column no padding top bottom'tr>" + "<'left aligned four wide column'i><'right aligned twelve wide column'p>",
    processing: true,
    pagingType: 'full_numbers',
    serverSide: true,
    filter: true,
    sort: true,
    info: true,
    columns: [{
      data: "id",
      name: 'rawat_jalan.id',
    }, {
      data: "pasien_id",
      name: 'pasien.id',
    }, {
      data: "nama",
      name: 'pasien.nama',
    }, {
      data: 'kepala_keluarga',
      name: 'pasien.kepala_keluarga',
    }, {
      data: 'no_kartu_keluarga',
      name: 'pasien.no_kartu_keluarga',
    }, {
      data: 'pekerjaan',
      name: 'pasien.pekerjaan'
    }, {
      data: 'tgl_lahir',
      name: 'pasien.tgl_lahir',
      searchable: false
    }, {
      data: 'agama',
      name: 'pasien.agama'
    }, {
      data: 'jenis_kelamin',
      name: 'pasien.jenis_kelamin'
    }, {
      data: "alamat",
      name: 'pasien.alamat'
    }, {
      data: "kepesertaan",
      name: 'rawat_jalan.kepesertaan'
    }, {
      data: "kunjungan",
      name: 'rawat_jalan.kunjungan'
    }, ],
    drawCallback: function() {},
  });
  table.on('init.dt', function() {
    yadcf.init(table, [{
      column_number: 0,
      filter_type: 'text',
    }, {
      column_number: 1,
      filter_type: 'text'
    }, {
      column_number: 2,
      filter_type: 'text'
    }, {
      column_number: 3,
      filter_type: 'text'
    }, {
      column_number: 4,
      filter_type: 'text'
    }, {
      column_number: 6,
      filter_type: 'range_date',
      date_format: 'yyyy-mm-dd'
    }, {
      column_number: 5,
      filter_type: 'text'
    }, {
      column_number: 7,
      filter_type: 'select',
      data: [{
        value: 'Islam',
        label: 'Islam'
      }, {
        value: 'Kristen',
        label: 'Kristen'
      }, {
        value: 'Katholik',
        label: 'Katholik'
      }, {
        value: 'Hindu',
        label: 'Hindu'
      }, {
        value: 'Budha',
        label: 'Budha'
      }, {
        value: 'Lain-Lain',
        label: 'Lain-Lain'
      }]
    }, {
      column_number: 8,
      filter_type: 'select',
      data: [{
        value: 'Laki-Laki',
        label: 'Laki-Laki'
      }, {
        value: 'Perempuan',
        label: 'Perempuan'
      }]
    }, {
      column_number: 9,
      filter_type: 'text'
    }, {
      column_number: 10,
      filter_type: 'text'
    }, ]);
    $('.yadcf-filter-wrapper').addClass('ui small action datatables-search input').css({
      'display': 'flex',
    });
    $('.yadcf-filter-wrapper button').html('<i class="close icon"></i>');
    $('.yadcf-filter-wrapper button').addClass('ui small icon button');
    $('[id^=yadcf]').hide();
    new $.fn.dataTable.Buttons(table, {
      dom: {
        container: {
          tag: 'div',
          className: 'ui small buttons'
        },
        collection: {
          tag: 'div',
          className: 'dt-button-collection'
        },
        button: {
          tag: 'a',
          className: 'ui tiny icon button',
          active: 'active',
          disabled: 'disabled'
        },
        buttonLiner: {
          tag: 'span',
          className: ''
        }
      },
      buttons: [{
        text: '<i class="plus icon"></i>Tambah',
        className: 'primary icon tambah-btn',
        action: function(e, dt, node, config) {
          $('#pendaftaran-baru form [name="id"]').val('');
          $('#pendaftaran-baru form').form('clear');
          $('#pendaftaran-baru form input[type="hidden"][name="_token"]').val($('#pendaftaran-baru form').attr('data-token'));
          $('#pendaftaran-baru .header').text('Tambah Data Pasien');
          $('#pendaftaran-baru').modal({
            closable: false,
            onApprove: function() {
              form_submit('#pendaftaran-baru form', true, function() {
                $('#rawat-jalan-field').hide();
              });
              return false;
            },
            onHidden: function() {
              $('#rawat-jalan-field').hide();
            },
          }).modal('show');
        }
      }, {
        text: '<i class="treatment icon"></i>Daftarkan',
        className: 'positive icon rwt-jln-btn disabled',
        action: function(e, dt, node, config) {
          var data = dt.row({
            selected: true
          }).data();
          if (!data) {
            return false;
          }
          $('#daftar-rawat-jalan').modal({
            onShow: function() {
              $('#daftar-rawat-jalan form [name="_token"]').val($('#daftar-rawat-jalan form').attr('data-token'));
              $('#daftar-rawat-jalan form [name="pasien_id"]').val(data.id);
              $('#daftar-rawat-jalan form [name="nama"]').val(data.nama);
              $('#daftar-rawat-jalan form .ui.dropdown').dropdown('restore defaults');
            },
            onApprove: function() {
              form_submit('#form-rawat-jalan', true, function() {
                $('#daftar-rawat-jalan').modal('hide');
              });
              return false;
            }
          }).modal('show');
        }
      }, {
        text: '<i class="edit icon"></i>Ubah',
        className: 'orange ubah-btn disabled',
        action: function(e, dt, node, config) {
          var data = dt.row({
            selected: true
          }).data();
          if (!data) {
            return false;
          }
          $('#ubah-data .header').text('Ubah Data Pasien - ID: ' + data.id);
          $('#ubah-data form').form('clear');
          $('#ubah-data form input[type="hidden"][name="_token"]').val($('#ubah-data form').attr('data-token'));
          $('#ubah-data').modal({
            closable: false,
            onApprove: function() {
              form_submit('#ubah-data form');
              return false;
            }
          }).modal('show');
          ajax_get_pasien('/administrasi/pendaftaran/data-pasien/' + data.id);
        }
      }, {
        text: '<i class="trash icon"></i>Hapus',
        className: 'disabled negative hapus-btn',
        action: function(e, dt, node, config) {
          var data = dt.rows({
            selected: true
          }).data();
          if (data.length <= 0) {
            return false;
          }
          var id_ar = new Array;
          $.each(data, function(index, val) {
            id_ar.push(val.id);
          });
          delete_data_pasien(id_ar);
        }
      }, ]
    });
    new $.fn.dataTable.Buttons(table, {
      dom: {
        container: {
          tag: 'div',
          className: 'ui small buttons'
        },
        collection: {
          tag: 'div',
          className: 'dt-button-collection'
        },
        button: {
          tag: 'a',
          className: 'ui toggle tiny icon button',
          active: 'active',
          disabled: 'disabled'
        },
        buttonLiner: {
          tag: 'span',
          className: ''
        }
      },
      buttons: [{
        extend: 'colvis',
        className: 'colvis-btn',
        text: '<i class="icon eye"></i>',
        postfixButtons: ['colvisRestore']
      }, {
        text: '<i class="icon refresh"></i>',
        className: 'refresh-btn',
        action: function(e, dt, node, config) {
          table.ajax.reload();
        }
      }, {
        text: '<i class="clockwise rotated search icon"></i>',
        className: 'search-btn',
        action: function(e, dt, node) {
          $(node).toggleClass('active').removeClass('toggle');
          if (!$(node).hasClass('active')) {
            $('[id^=yadcf]').hide();
          } else {
            $('[id^=yadcf]').show();
          }
          table.columns.adjust();
        }
      }, {
        text: '<i class="icons"><i class="undo icon"></i><i class="search black corner icon"></i></i>',
        className: 'clear-search-btn',
        action: function(e, dt, node) {
          yadcf.exResetAllFilters(table)
          table.columns.adjust();
        }
      }, {
        text: '<i class="list layout icon"></i>',
        className: 'reset-colorder-btn',
        action: function() {
          table.colReorder.reset();
        }
      }],
    });
    new $.fn.dataTable.Buttons(table, {
      dom: {
        container: {
          tag: 'div',
          className: 'ui small buttons'
        },
        collection: {
          tag: 'div',
          className: 'dt-button-collection'
        },
        button: {
          tag: 'a',
          className: 'ui tiny icon button',
          active: 'active',
          disabled: 'disabled'
        },
        buttonLiner: {
          tag: 'span',
          className: ''
        }
      },
      buttons: [{
        extend: 'copyHtml5',
        className: 'copy-btn',
        text: '<i class="icon copy"></i>',
        exportOptions: {
          columns: ':visible'
        }
      }, {
        extend: 'print',
        text: '<i class="icon print"></i>',
        className: 'print-btn',
        message: 'List pendaftar hari ini.',
        exportOptions: {
          columns: ':visible'
        }
      }, {
        extend: 'csvHtml5',
        className: 'csv-btn',
        text: '<i class="icon file text outline"></i>',
        exportOptions: {
          columns: ':visible'
        }
      }, {
        extend: 'excelHtml5',
        className: 'excel-btn',
        text: '<i class="icon excel file outline"></i>',
        exportOptions: {
          columns: ':visible'
        }
      }]
    });
    table.buttons(0, 1).container().prependTo($('.toolbars'));
  });
  var to = setTimeout(function() {
    tooltip_btn();
    clearTimeout(to);
  }, 1000)
  table.on('select', function(e, dt, type, indexes) {
    $('.ubah-btn, .hapus-btn, .rwt-jln-btn').removeClass('disabled');
    $('.rwt-jln-btn').attr('data-content', 'Daftarkan ' + dt.row(indexes).data().id + ':' + dt.row(indexes).data().nama + ' untuk Rawat Jalan?')
    $('.hapus-btn').attr('data-content', 'Hapus ke anggotaan ' + dt.row(indexes).data().id + ':' + dt.row(indexes).data().nama + '?');
    $('.ubah-btn').attr('data-content', 'Ubah data ke anggotaan ' + dt.row(indexes).data().id + ':' + dt.row(indexes).data().nama + '?')
  }).on('deselect', function(e, dt, type, indexes) {
    $('.ubah-btn, .hapus-btn, .rwt-jln-btn').addClass('disabled');
  });

  function tooltip_btn() {
    $('.tambah-btn').attr('data-content', 'Pendaftaran anggota Baru?');
    $('.colvis-btn').attr('data-content', 'Tampilkan / sembunyikan cell tabel');
    $('.refresh-btn').attr('data-content', 'Refresh tabel');
    $('.search-btn').attr('data-content', 'Tampilkan / sembunyikan kolom pencarian');
    $('.clear-search-btn').attr('data-content', 'Bersihkan field pencarian');
    $('.copy-btn').attr('data-content', 'Salin data tabel');
    $('.print-btn').attr('data-content', 'Cetak tabel');
    $('.csv-btn').attr('data-content', 'Simpan ke CSV');
    $('.excel-btn').attr('data-content', 'Simpan ke Excel');
    $('.reset-colorder-btn').attr('data-content', 'Kembalikan posisi kolom head tabel');
    $('.ui.button').popup();
  }

  function ajax_get_pasien(url) {
    $('#ubah-data form').addClass('loading');
    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        if (data[0]) {
          update_form_pasien(data[0]);
        }
      },
      error: function(xhr) {
        var n = noty({
          layout: 'topRight',
          text: 'Error: ' + xhr.status + ' ' + xhr.statusText + '<br>Coba refresh browser kembali, apabila pesan ini masih muncul silahkan hubungi Administrator',
          type: 'warning'
        });
        $('#ubah-data').modal('hide');
      },
      complete: function() {
        $('#ubah-data form').removeClass('loading');
      }
    });
  }

  function update_form_pasien(data) {
    $.each(data, function(index, val) {
      $('#ubah-data form [name="' + index + '"]').val(val);
    });
    $('#ubah-data form .ui.dropdown').dropdown();
    $('#ubah-data form').removeClass('loading');
    return true;
  }
  $('[name="tgl_lahir"]').inputmask('dd-mm-yyyy');
  $('.ui.button').popup();
  $('#jenis_kunjungan_dropdown').dropdown();
  $('#jenis_kelamin_dropdown').dropdown();
  $('#agama_dropdown').dropdown();
  $('#kepesertaan-dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
      if (value == 0) {
        $('[name="_jenis_kepesertaan"]').parent().fadeIn();
      } else {
        $('[name="_jenis_kepesertaan"]').parent().fadeOut();
        $('[name="_jenis_kepesertaan"]').val('');
      }
    }
  });




  $('#form-pendaftaran').form({
    on: 'submit',
    keyboardShortcuts: false,
    inline: true,
    fields: {
      nama: ['minLength[3]', 'maxLength[50]', 'empty'],
      kepala_keluarga: ['minLength[3]', 'maxLength[50]', 'empty'],
      no_kartu_keluarga: ['minLength[6]', 'maxLength[50]', 'empty', 'number'],
      jenis_kelamin: ['empty'],
      alamat: 'empty',
      pekerjaan: ['minLength[3]', 'maxLength[50]', 'empty'],
      tgl_lahir: ['empty', 'regExp[/[0-9]{2}-[0-9]{2}-[0-9]{4}/]'],
      agama: ['empty', 'agama'],
      jenis_kepesertaan: 'emptyif[daftar_rawat_jalan:checked]'
    }
  });

  $('#form-pendaftaran input').on('keydown', function(e) {
    var x = e.which;
    if (x === 13) {
      return false;
    }
  });
  $('#form-pendaftaran').on('change', '#daftar_rawat_jalan', function(event) {
    $('#rawat-jalan-field .ui.dropdown').dropdown('restore defaults')
    if ($(this).is(':checked')) {
      $('#rawat-jalan-field').show();
    } else {
      $('#rawat-jalan-field').hide();
    }
  });
  // FORM UBAH
  $('#form-ubah').form({
    on: 'submit',
    keyboardShortcuts: false,
    inline: true,
    fields: {
      nama: ['minLength[3]', 'maxLength[50]', 'empty'],
      kepala_keluarga: ['minLength[3]', 'maxLength[50]', 'empty'],
      no_kartu_keluarga: ['minLength[6]', 'maxLength[50]', 'empty', 'number'],
      jenis_kelamin: ['empty'],
      alamat: 'empty',
      pekerjaan: ['minLength[3]', 'maxLength[50]', 'empty'],
      tgl_lahir: ['empty', 'regExp[/[0-9]{2}-[0-9]{2}-[0-9]{4}/]'],
      agama: ['empty', 'agama'],
    }
  });

  // Form Rawat Jalan
  $('#form-rawat-jalan').form({
    on: 'submit',
    keyboardShortcuts: false,
    inline: true,
    fields: {
      jenis_kepesertaan: 'empty',
    }
  });


  var form_submit = function(form, clear, callback) {
    $(form).unbind('submit');
    $(form).submit(function(e) {
      if ($(form).hasClass('loading') || !$(form).form('is valid') || !global_form) {
        return false;
      }
      global_form = false;
      var url = $(form).attr('action'),
        data = $(form).serialize(),
        ele = $(form);
      var n = noty({
        text: 'Simpan data?',
        buttons: [{
          addClass: 'ui positive small button',
          text: '<i class="icon save"></i>Simpan',
          onClick: function($noty, $this) {
            ele.addClass('loading');
            $(this).addClass('disabled');
            $(this).parent().find('.negative').addClass('disabled');
            var noty_button = $(this),
              cancel_button = $(this).parent().find('.negative');
            $noty.setText('<i class="icon asterisk loading"></i>Mohon tunggu sebentar');
            $.ajax({
              url: url,
              type: 'POST',
              dataType: 'json',
              data: data,
              success: function(response) {
                if (response && response.response) {
                  var notif = noty({
                    layout: 'topRight',
                    text: response.message,
                    type: 'success'
                  });
                  if (clear) {
                    ele.form('clear');
                    ele.find('[name="_token"]').val(ele.attr('data-token'));
                  }
                  if (callback) {
                    callback();
                  }
                  $noty.close();
                } else if (response && !response.response) {
                  $noty.close();
                  var notif = noty({
                    layout: 'topRight',
                    text: response.message,
                    type: 'warning'
                  });
                }
              },
              error: function(xhr) {
                if (xhr.status == 422) {
                  $noty.close();
                  var err = $.parseJSON(xhr.responseText);
                  var message = '<b>Form Validasi: </b>';
                  message += '<ul style="text-align: left;">'
                  $.each(err, function(index, item) {
                    if (Array.isArray(item)) {
                      $.each(item, function(idx, val) {
                        message += '<li>' + val + '</li>';
                      });
                    } else {
                      message += '<li>' + item + '</li>';
                    }
                  });
                  message += '</ul>';
                  var notif = noty({
                    layout: 'topRight',
                    text: message,
                    type: 'warning'
                  });
                  return false;
                }
                $noty.setText('Simpan data?');
                var notif = noty({
                  layout: 'topRight',
                  text: 'Error: ' + xhr.status + ' ' + xhr.statusText + '<br>Coba refresh browser kembali, apabila pesan ini masih muncul silahkan hubungi Administrator',
                  type: 'error'
                });
              },
              complete: function() {
                ele.removeClass('loading');
                noty_button.removeClass('disabled');
                cancel_button.removeClass('disabled');
                global_form = true;
              }
            });
          }
        }, {
          addClass: 'ui negative small button',
          text: 'Cancel',
          onClick: function($noty) {
            $noty.close();
            global_form = true;
          }
        }],
        modal: true,
        layout: 'center',
      });
      e.preventDefault();
    });
    return $(form).submit();
  }
});
