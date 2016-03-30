var load_script,
    loaded_script = [],
    form_api,
    load_page, refresher;

function counter_konsultasi() {
    $.ajax({
        url: '/konsultan/json/counter',
        type: 'GET',
        dataType: 'json',
    }).done(function(data) {
        var blm = $('#sidebar .counter-belum-konsultasi, .left-menu .counter-belum-konsultasi'),
            sdh = $('#sidebar .counter-sudah-konsultasi, .left-menu .counter-sudah-konsultasi');
        (data.belum_konsultasi > 0) ? blm.removeClass('hidden').text(data.belum_konsultasi): blm.addClass('hidden').text(data.belum_konsultasi);
        (data.sudah_konsultasi > 0) ? sdh.removeClass('hidden').text(data.sudah_konsultasi): sdh.addClass('hidden').text(data.sudah_konsultasi);
    }).always(function(){

    });
}
$(document).ready(function() {
    counter_konsultasi();
    $('.refresher').api({
        url: '/konsultan/json/counter',
        loadingDuration: 2000,
        beforeSend: function(settings) {
            $('.resfresher').addClass('disabled');
            $('.refresher i').addClass('loading');
            return settings
        },
        onSuccess: function(data) {
            var blm = $('#sidebar .counter-belum-konsultasi, .left-menu .counter-belum-konsultasi'),
                sdh = $('#sidebar .counter-sudah-konsultasi, .left-menu .counter-sudah-konsultasi');
            (data.belum_konsultasi > 0) ? blm.removeClass('hidden').text(data.belum_konsultasi): blm.addClass('hidden').text(data.belum_konsultasi);
            (data.sudah_konsultasi > 0) ? sdh.removeClass('hidden').text(data.sudah_konsultasi): sdh.addClass('hidden').text(data.sudah_konsultasi);
        },
        complete: function(){
            $('.resfresher').removeClass('disabled');
            $('.refresher i').removeClass('loading');
        }
    });
    $('.sidebar-toggle').click(function(e) {
        $('.ui.sidebar').sidebar('toggle');
    })
    setInterval(function() {
        counter_konsultasi();
    }, 30000);
});