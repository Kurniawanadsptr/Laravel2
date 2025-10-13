$(document).on('click', '#editAccount', function(){
  var id_user = $(this).data('id');
  $.get('/account/edit/' + id_user, function(data){
    $('#id').val(data.id_user);
    $('#username_edit').val(data.username);
    $('#first_name').val(data.first_name);
    $('#email').val(data.email);
    $('#telephone').val(data.telephone);
    $('#address').val(data.address);
    $('#modalEditData').modal('show');
  })
})

$('#formEditArsip').submit(function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  var id = $('#id').val();

  $.ajax({
    url: '/account/edit/' + id,
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
