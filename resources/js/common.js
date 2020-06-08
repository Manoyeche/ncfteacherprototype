
$('body').on('click', '.j-form-swal-confirmation', function(e) {
    e.preventDefault();
    let confirm_text = $(this).data('confirm-text');
    let custom_button_text = $(this).data('button-text');
    let custom_title_text = $(this).data('title');
    let message = confirm_text != '' ? confirm_text : 'Are you sure you want to submit?';
    let title_text = custom_title_text ? custom_title_text : "Submit";
    let button_text = custom_button_text ? custom_button_text : "Submit";
    swal.fire({
        title: title_text,
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: "#38c172",
        cancelButtonColor: 'gray',
        confirmButtonText: button_text,
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $(this).parents('form').submit();
        }
    });
});

$('body').on('click', '.j-form-swal-delete-confirmation', function(e) {
    e.preventDefault();
    let confirm_text = $(this).data('confirm-text');
    let message = confirm_text != '' ? confirm_text : 'Are you sure you want to delete?';
    swal.fire({
        title: 'Delete',
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: 'gray',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $(this).parents('form').submit();
        }
    });
});