let current = null;
const base_url = window.location.origin+"/"
document.querySelector('#username').addEventListener('focus', () => {
    if (current) current.pause();
    current = anime({
        targets: 'path',
        strokeDashoffset: {
            value: 0,
            duration: 700,
            easing: 'easeOutQuart'
        },
        strokeDasharray: {
            value: '240 1386',
            duration: 700,
            easing: 'easeOutQuart'
        }
    });
});
document.querySelector('#password').addEventListener('focus', ()=> {
    if (current) current.pause();
    current = anime({
        targets: 'path',
        strokeDashoffset: {
            value: -336,
            duration: 700,
            easing: 'easeOutQuart'
        },
        strokeDasharray: {
            value: '240 1386',
            duration: 700,
            easing: 'easeOutQuart'
        }
    });
});
document.querySelector('#submit').addEventListener('focus', ()=> {
    if (current) current.pause();
    current = anime({
        targets: 'path',
        strokeDashoffset: {
            value: -730,
            duration: 700,
            easing: 'easeOutQuart'
        },
        strokeDasharray: {
            value: '530 1386',
            duration: 700,
            easing: 'easeOutQuart'
        }
    });
});
$(document).ready(() => {
    if(sessionStorage.getItem('nextURL')){
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "0",
            "extendedTimeOut": "0",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.error("Session Has Expired <br> Your Last Url is Saved.. <br> Please Login Again",'Error')
    }
    $('#username,#password').keypress(e => {
        if (e.keyCode === 13) {
            $('#submit').focus();
        }
    });
    $('#formlogin').submit(e => {
        e.preventDefault();
        const user = $('#username').val();
        const pass = $('#password').val();
        if (user && pass) {
            const data = new FormData(e.target);
            $.ajax({
                type: 'POST',
                url: `${base_url}login`,
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                success: res => {
                    if (res) {
                        swal({
                            icon: "error",
                            title: "Error",
                            text: res
                        });
                        setTimeout(() => {
                            $('#username').focus()
                        })
                    } else {
                        location.href =  sessionStorage.getItem('nextURL') == null ? `${base_url}dashboard` : sessionStorage.getItem('nextURL') ;
                    }
                },
                error: xhr => {
                    console.log(xhr.responseJSON.message);
                }
            })
        }
    });
});