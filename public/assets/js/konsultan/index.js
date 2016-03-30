   $.fn.dataTable.ext.errMode = 'throw';
   $(document).ready(function() {
       var $modal = $('#modal-insert');
       table = $('#table-job-list').DataTable({
           language: {
               url: $('#table-job-list').data('lang')
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
               url: $('#table-job-list').data('source'),
           },
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
               text: '<i class="plus icon"></i>Lihat data konsultasi',
               className: 'positive',
               action: function(e, dt, node, config) {
                   var data = dt.row({
                       selected: true
                   }).data();
                   if (!data) {
                       return false;
                   }
                   window.location.href = '/konsultan/konsultasi/' + data.id+'#/form-konsultasi';
               }
           }, ],
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
           drawCallback: function() {
               $('.ui.button').popup();
           },

       });
       $('#table-job-list').on('click', '.view-pasien', function() {
           var data = table.row($(this).parents('tr')).data();
       });

   });