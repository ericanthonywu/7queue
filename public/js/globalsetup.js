KTApp.blockPage({
    overlayColor: '#000000',
    type: 'v2',
    state: 'primary',
    message: 'Processing...'
});
sessionStorage.removeItem('nextURL')
$(window).bind('beforeunload', () => {
    KTApp.blockPage({
        overlayColor: '#000000',
        type: 'v2',
        state: 'primary',
        message: 'Processing...'
    });
});
$(document).ready(function () {
    KTApp.unblockPage();
    $('.kt-selectpicker').selectpicker();
    $('.summernote').summernote({
        minHeight:"150px"
    });
});
// Global Variable
    const base_url = window.location.origin + "/";
    const base_image = window.location.origin + "/uploads/";
    const base_table = window.location.origin + "/table/";

    $('.btn-tooltip').tooltip();

//Global Default Toastr
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

//Global Default Ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        cache: false,
        beforeSend: () => {
            KTApp.blockPage({
                overlayColor: '#000000',
                type: 'v2',
                state: 'primary',
                message: 'Processing...'
            });
        },
        error: xhr => {
            // TODO : Remove on Production
            if (xhr.status !== 419) {
                console.log(typeof xhr.responseJSON === "undefined" ? xhr.statusText : xhr.responseJSON.message);
                toastr.error(typeof xhr.responseJSON === "undefined" ? xhr.statusText : xhr.responseJSON.message, 'Error');
            }
        },
        complete: xhr => {
            if (xhr.status === 419) {
                location.href = sessionStorage.getItem('status') === "admin" ? base_url+"admin" : base_url;
                sessionStorage.setItem('nextURL', window.location.href);
            } else {
                KTApp.unblockPage();
            }
        }
    });

    autosize($('textarea'));
    autosize.update($('textarea'));