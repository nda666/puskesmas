$(document).ready(function(){
  var do_job = false;
  $('#tab-rawat-jalan a.item').tab({
    history: true,
    onLoad: function (tabPath) {
      $(window).trigger('resize');
      if (tabPath == 'data-tindakan') {
          $(window).trigger('look');
      }
    },
  });
  $('#data-konsultasi thead th').addClass('center aligned');
	$('#selesai-rawat-jalan').click(function (e) {
		e.preventDefault();
		var btn_rjalan = $('#selesai-rawat-jalan');
		var default_text = 'Tandai "Selesai" untuk rawat jalan ini?';
		if ($(this).attr('data-progres') == '0'){
			default_text = 'Tandai "Belum Selesai" untuk rawat jalan ini?';
		}
		var notif = noty({
			modal: true,
			text: default_text,
			buttons: [{
					addClass: 'ui negative small button',
					text: '<i class="icon close"></i>Tidak',
					onClick: function ($noty, $this) {
						$noty.close();
						if ($('#selesai-rawat-jalan').attr('data-progres') == 1){
							$('#selesai-rawat-jalan').attr('data-force', 'false');
						}
					}
      }, {
					addClass: 'ui positive small button',
					text: '<i class="icon check"></i>Iya',
					onClick: function ($noty, $this) {
						var btn = $(this);
						var force = btn_rjalan.attr('data-force'),
						progres = btn_rjalan.attr('data-progres')
						$noty.setText('<i class="icon loading asterisk"></i>Mohon Tunggu sebentar...');
						if (!$(this).hasClass('disabled')) {
							$(this).addClass('disabled loading');
							$.post($('#selesai-rawat-jalan').attr('data-action'), {
								'id': btn_rjalan.attr('data-id'),
								'force': force,
								'progres': progres,
								'_token': btn_rjalan.attr('data-token'),
							}).done(function(response){
									if (response.response) {
										$noty.close();
										var not = noty({
											layout: 'topRight',
											type: 'success',
											timeout: 10000,
											text: response.message
										});
										if (response.result == 1){
											btn_rjalan.attr('data-force', 'true').attr('data-progres', '0').html('<i class="close icon"></i>Batalkan Selesai').removeClass('green').addClass('red');
											$('#status-rawat-jalan').removeClass('red').addClass('green').text('Sudah');
										} else {
											btn_rjalan.attr('data-force', 'false').attr('data-progres', '1').html('<i class="check icon"></i>Selesai Rawat Jalan').removeClass('red').addClass('green');
											$('#status-rawat-jalan').removeClass('green').addClass('red').text('Belum');
										}
										btn.removeClass('disabled loading');
                    if (response.redirect){
                      window.location.href = response.redirect;
                    }

									} else {
										if (response.reconfirm) {
											var to = setTimeout(function () {
												$noty.setText(response.message);
												btn_rjalan.attr('data-force', 'true');
												btn.removeClass('disabled loading');
												clearTimeout(to);
											}, 1000);
										} else {
										var not = noty({
											layout: 'topRight',
											text: response.message,
											timeout: 10000
										});
										}
									}
							}).fail(function(xhr){
								var not = noty({
									layout: 'topRight',
									text: 'Error: '+ xhr.status + ' ' + xhr.statusText
								});
								$noty.setText(default_text);
								btn.removeClass('disabled loading');
							});
						}
					}
      }
      ]
		});
	});


  var data_tindakan = function($id) {
      var url = $('#data-tab-tindakan').attr('data-source');
      $('#data-tab-tindakan form').addClass('loading');
      do_job = true;
      setTimeout(function(){
      $.get(url + '/' + $id, function(response) {
          if (response.response) {
            $.each(response.data[0], function(i,v){
              console.log(v)
              $('#data-result-tindakan [data-name="'+ i +'"]').text(v || '');
              $('#data-konsultasi-tindakan [data-name="'+ i +'"]').text(v || '');
              $('#data-tab-tindakan form [name="'+ i +'"]').val(v);
            });
            $('#data-tab-tindakan form [name="id"]').val(response.data[0].id_tindakan || '');
              $('#data-tab-tindakan form [name="keterangan"]').val(response.data[0].keterangan_tindakan || '');
              if (response.data[0].id_tindakan) {
                  $('#data-tab-tindakan form .hapus-tindakan').attr('data-id', response.data[0].id_tindakan);
                   $('#data-tab-tindakan form .hapus-tindakan').attr('data-konsultasi', response.data[0].ruang_konsul_id);
                  $('#data-tab-tindakan form .hapus-tindakan').removeAttr('disabled');
              } else {
                  $('#data-tab-tindakan form .hapus-tindakan').attr('disabled', 'disabled');
              }
          }
      }).always(function() {
          $('#data-tab-tindakan form').removeClass('loading');
          do_job = false;
      });
      }, 0);

  }
  var get_tindakan = function(reselect = false) {
      var url = $('#tab-tindakan').attr('data-source');
      $.get(url, function(response) {
          if (response && response.response) {
              $('#tab-tindakan').html('');
              if (response.data.length <= 0){
                if ($('#data-tab-tindakan form').parent().has('#not-found-konsultasi').length === 0){
                  $('#data-tab-tindakan').prepend('<div id="not-found-konsultasi" class="ui message"><div class="content"><div class="header">Tidak Ada Data</div><p>Tidak ditemukan data konsultasi, silahkan isi Data Konsultasi terlebih dahulu</p></div></div>');

                }
                $('#tab-tindakan').html('<div class="item">Tidak ada data</item>');
                $('#data-tab-tindakan form .field').addClass('disabled');
                return false;
              }
              $('#menu-tab').sticky({offset: $('.right-navbar').height() + 10});
              $('#data-tab-tindakan #not-found-konsultasi').remove();
              $('#data-tab-tindakan form .field').removeClass('disabled');

              for (i = 0; i < response.data.length; i++) {
                  if (i === 0 && reselect) {
                      data_tindakan(response.data[i]['id']);
                      if (response.data[i]['check']){
                        $('#tab-tindakan').append('<a class="active item" data-id="' + response.data[i]['id'] + '"><i class="green check icon"></i>' + response.data[i]['created_at'] + '</a>');
                      } else {
                          $('#tab-tindakan').append('<a class="active item" data-id="' + response.data[i]['id'] + '"><i class="close red icon"></i>' + response.data[i]['created_at'] + '</a>');
                      }
                  } else {
                    if (response.data[i]['check']){
                      $('#tab-tindakan').append('<a class="item" data-id="' + response.data[i]['id'] + '"><i class="green check icon"></i>' + response.data[i]['created_at'] + '</a>');
                    } else {
                        $('#tab-tindakan').append('<a class="item" data-id="' + response.data[i]['id'] + '"><i class="close red icon"></i>' + response.data[i]['created_at'] + '</a>');
                    }
                  }
              }

          }
      });
  }
  $(window).on('look', function() {
      get_tindakan(true);
  });
  $('#tab-tindakan').on('click', 'a.item', function(e) {
    console.log(do_job)
      if (! do_job){
      $('#tab-tindakan a.item.active').removeClass('active');
      $('#tab-tindakan a.item').addClass();
      $(this).addClass('active');
        data_tindakan($(this).attr('data-id'))
      }
      e.preventDefault();
  });

  $('#data-konsultasi-resep thead th').addClass('center aligned');
  var eTableR = '#data-konsultasi-resep';
  var table_resep = $('#data-konsultasi-resep').DataTable({
    ajax: {
      url: $('#data-konsultasi-resep').data('source'),
    },
    language: {
      url: $('#data-konsultasi-resep').data('lang')
    },
    lengthMenu: [
    [10, 25, 100, 200, 500, -1],
    [10, 25, 100, 200, 500, 'Semua'],
  ],
  searchDelay: 1000,
  stateSave: true,
  scrollY: '60vh',
  scrollCollapse: true,
  scrollX: true,
  dom: "<'left no padding-bottom floated aligned sixteen wide mobile eight wide computer column'l><'right no padding-bottom aligned sixteen wide mobile eight wide computer column'f>" + "<'ui button-container sixteen wide tablet ten wide toolbars-resep column'>" +
    "<'sixteen wide column no padding top bottom'tr>" + "<'sixteen wide mobile four wide computer column'i><'right aligned sixteen wide mobile twelve wide computer column'p>",
  processing: true,
  pagingType: 'numbers',
  serverSide: true,
  filter: true,
  sort: true,
  info: true,
    columns: [{
      data: "id",
      name: 'resep.id',
      className: 'collapsing'
  },  {
      data: "nama_obat",
      name: 'obat.nama',
  }, {
      data: 'nama',
      name: 'pegawai.nama',
  }, {
      data: 'created_at',
      name: 'resep.created_at',
  }, ],
    drawCallback: function () {},
  });
table_resep.on('init.dt', function () {
  yadcf.init(table_resep, [{
    column_number: 0,
    filter_type: 'text',
    filter_reset_button_text: false,
  },  {
    column_number: 1,
    filter_type: 'text',
    filter_reset_button_text: false,
  }, {
    column_number: 2,
    filter_type: 'text',
    filter_reset_button_text: false,
  }, {
    column_number: 3,
    filter_type: 'range_date',
    date_format: 'yyyy-mm-dd',
    filter_reset_button_text: false,
  }, ]);
  $('.yadcf-filter-wrapper').addClass('ui datatables-search input').css({
    'display': 'flex',
  });
  $('#yadcf-filter-wrapper--data-konsultasi-resep-0 input').css('width', '50px');
  $('#yadcf-filter-wrapper--data-konsultasi-resep-1 input').css('width', '90px');
  $('#yadcf-filter-wrapper--data-konsultasi-resep-2 input').css('width', '80px');
  $('#yadcf-filter-wrapper--data-konsultasi-resep-3 input').css('width', '100px');
  $('.yadcf-filter-wrapper button').html('<i class="close icon"></i>')
  $('.yadcf-filter-wrapper button').addClass('ui small icon button');
  $('[id^=yadcf]').hide();

  new $.fn.dataTable.Buttons(table_resep, {
    dom: {
      container: {
        tag: 'div',
        className: 'ui basic right floated buttons'
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
      text: '<i class="icon refresh"></i>Refresh',
      className: 'refresh-btn',
      action: function (e, dt, node, config) {
        table_resep.ajax.reload();
      }
    },  {
      text: '<i class="search icon"></i>Cari',
      className: 'search-btn',
      action: function (e, dt, node) {
        $(node).toggleClass('active').removeClass('toggle');
        if (!$(node).hasClass('active')) {
          $('[id^=yadcf]').hide();
        } else {
          $('[id^=yadcf]').show();
        }
        table_resep.columns.adjust();
      }
          }, {
      text: '<i class="undo icon"></i>Clear',
      className: 'clear-search-btn',
      action: function (e, dt, node) {
        yadcf.exResetAllFilters(table_resep)
        table_resep.columns.adjust();
      }
      }, ]
  });
		table_resep.buttons(0, 1).container().prependTo($('.toolbars-resep'));
    table_resep.columns.adjust();
	});
});
