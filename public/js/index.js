var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var id = button.getAttribute('data-bs-id')
  var barang = button.getAttribute('data-bs-barang')
  var jumlah = button.getAttribute('data-bs-jumlah')
  var title = button.getAttribute('data-bs-title')
  var labeljumlah = button.getAttribute('data-bs-labeljumlah')
  var actiondata = button.getAttribute('data-bs-action')

  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = exampleModal.querySelector('.modal-title')
  var idinput  = exampleModal.querySelector('.modal-body .id')
  var materialinput = exampleModal.querySelector('.modal-body .material')
  var jumlahinput = exampleModal.querySelector('.modal-body .jumlah')
  var jumlahlabel = exampleModal.querySelector('#label-jumlah')
  var form = exampleModal.querySelector('.post')



  modalTitle.textContent = title + barang
  jumlahlabel.textContent = labeljumlah
  idinput.value = id
  materialinput.value = barang
  jumlahinput.value = jumlah
  jumlahinput.max = jumlah
  form.action = actiondata
})


