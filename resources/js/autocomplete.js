$(document).ready(function(){
    // ketika halaman dimuat, sembunyikan pilihan kelurahan
    $('#kelurahan').hide();

    // ketika input kelurahan diisi, mulai autocomplete
    $('#kelurahan-input').on('input', function(){
      var query = $(this).val();

      // kirim request ke server untuk mendapatkan pilihan kelurahan
      $.ajax({
        url: '/get-kelurahan/' + query,
        type: 'GET',
        success: function(data){
          // hapus semua opsi sebelumnya
          $('#kelurahan').empty();

          // tambahkan opsi baru
          $.each(data, function(key, value){
            $('#kelurahan').append('<option value="' + value.id + '">' + value.name + '</option>');
          });

          // tampilkan pilihan kelurahan
          $('#kelurahan').show();
        }
      });
    });

    // ketika pilihan kelurahan dipilih, isi input dengan nama kelurahan
    $('#kelurahan').change(function(){
      var kelurahan_name = $(this).children('option:selected').text();
      $('#kelurahan-input').val(kelurahan_name);
    });
  });
