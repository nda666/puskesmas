$(document).ready(function() {
    var do_job = false;
    window.do_job = do_job;
    $('.table-toggle').click(function(e){
      if ($(this).hasClass('compress')){
        $(this).removeClass('compress').addClass('expand');
      } else {
        $(this).addClass('compress').removeClass('expand');
      }
      $(this).parent().find('table').toggle();
    })
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
    var get_tindakan = function(reselect) {
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
    $('#data-tab-tindakan').on('submit', '.form-tindakan', function(e) {
        var i = $(this).find('[name="ruang_konsul_id"]').val(),
        url;
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
            if (response.response){
              var n = noty({text:response.message,type: 'success', timeout: 5000, layout: 'topRight'});
              data_tindakan(i);
              get_tindakan(false);
            } else {
              var n = noty({text:response.message,type: 'warning', layout: 'topRight'});
            }
        }).fail(function(xhr){
          var n = noty({text:xhr.statusText,type: 'error', layout: 'topRight'});
        });
        e.preventDefault();
    });
    $('#data-tab-tindakan').on('click', '.hapus-tindakan', function(e) {
    	var i = $(this).attr('data-konsultasi');
        $.post($(this).attr('data-action'), {
            id: $(this).attr('data-id'),
            _token: $('#data-tab-tindakan form [name="_token"]').val()
        }, function(response) {
          if (response.response){
            var n = noty({text:response.message,type: 'success', timeout: 5000, layout: 'topRight'});
          } else {
            var n = noty({text:response.message,type: 'warning', layout: 'topRight'});
          }
            data_tindakan(i);
            get_tindakan(false);
        }).fail(function(xhr){
          var n = noty({text:xhr.statusText,type: 'error', timeout: 5000, layout: 'topRight'});
        });
        e.preventDefault();
    });
    $('#data-tab-tindakan form').form({
      on: 'submit',
      inline: true,
      fields: {
        pengobatan: 'empty'
      }
    });
});
