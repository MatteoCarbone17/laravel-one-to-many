const popup = document.getElementById('popup_message');
if (popup) {

  Swal.fire({
    toast: true,
    animation: false,
    icon: popup.dataset.type,
    title: popup.dataset.message,
    type: popup.dataset.type,
    position: 'top-right',
    timer: 3000,
    showConfirmButton: false,
  });
}

const deleteBtns = document.querySelectorAll('form.delete');

deleteBtns.forEach((formDelete) => {
  formDelete.addEventListener('submit', function (event) {
    event.preventDefault();
    const  doubleconfirm = event.target.classList.contains('double-confirm');
    Swal.fire({
      title: 'Are you sure to delete this Project ?',
      text: "Please write CONFIRM DELETE to accept your request",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancel',
      confirmButtonText: 'Confirm !'
    }).then((result) => {
      if (result.value) {
        if (doubleconfirm) {
          Swal.fire({
            title: 'Confirm Delete Request',
            html: "Please type <b>CONFIRM DELETE</b>",
            input: 'text',
            type: 'warning',
            inputPlaceholder: 'CONFIRM DELETE',
            showCancelButton: true,
            confirmButtonText: 'Confirm Delete',
            cancelButtonText: 'Cancel',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading(),
            preConfirm: (txt) => {
              return (txt.toUpperCase() == "CONFIRM DELETE");
            },

          }).then((result) => {
            if (result.value) this.submit();
          })
        } else {
          this.submit();
        }


      }
    });


  });

});