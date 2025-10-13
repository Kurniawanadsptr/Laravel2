$(document).on('click', '#editArsip', function () {
  var id_arsip = $(this).data('id');
  $.get('/arsip/edit/' + id_arsip, function (data) {
    $('#id').val(data.id_arsip);
    $('#nama_dokumen_edit').val(data.name_file);
    $('#no_surat_edit').val(data.no_surat);
    $('#perihal_edit').val(data.perihal);
    $('#spanFile').attr('href', '/arsip/file/' + data.date_upload + '/' + data.file);
    $('#modalEditData').modal('show');
  });
});

$('#formEditArsip').submit(function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  var id = $('#id').val();

  $.ajax({
    url: '/arsip/edit/' + id,
    method: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function () {
      $('#modalEditData').modal('hide');
      location.reload();
    },
    error: function (xhr) {
      alert('Gagal update arsip: ' + xhr.responseText);
    }
  });
});

 $(document).ready(function () {
        $('#search').on('keyup', function () {
            let query = $(this).val();
            $.ajax({
                url: "/table/arsip",
                type: "GET",
                data: { search: query },
                success: function (data) {
                    $('#arsip-body').html(data);
                },
                error: function (xhr) {
                    console.error("Gagal memuat data:", xhr.responseText);
                }
            });
        });
    });
