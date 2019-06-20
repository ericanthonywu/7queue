$(function () {
    const base_url = window.location.origin + "/";

    if (sessionStorage.getItem('nextURL')) {
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
        toastr.error("Session Has Expired <br> Your Last Url is Saved.. <br> Please Login Again", 'Error')
    }

    $(".input input").focus(function () {

        $(this).parent(".input").each(function () {
            $("label", this).css({
                "line-height": "18px",
                "font-size": "18px",
                "font-weight": "100",
                "top": "0px"
            });
            $(".spin", this).css({
                "width": "100%"
            })
        });
    }).blur(function () {
        $(".spin").css({
            "width": "0px"
        });
        if ($(this).val() == "") {
            $(this).parent(".input").each(function () {
                $("label", this).css({
                    "line-height": "60px",
                    "font-size": "24px",
                    "font-weight": "300",
                    "top": "10px"
                })
            });

        }
    });

    $(".button").click(function (e) {
        if ($(this).hasClass('login')) {
            const data = $('form#login').serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `${base_url}login`,
                data: data,
                type: 'POST',
                success: res => {
                    if (res) {
                        swal({
                            icon: "error",
                            title: "Error",
                            text: res
                        });
                    } else {
                        var pX = e.pageX,
                            pY = e.pageY,
                            oX = parseInt($(this).offset().left),
                            oY = parseInt($(this).offset().top);

                        $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>');
                        $('.x-' + oX + '.y-' + oY + '').animate({
                            "width": "500px",
                            "height": "500px",
                            "top": "-250px",
                            "left": "-250px",

                        }, 600);
                        $("button", this).addClass('active');
                        sessionStorage.setItem('status', 'manager');
                        location.href = sessionStorage.getItem('nextURL') == null ? `${base_url}dashboard` : sessionStorage.getItem('nextURL');
                    }
                },
                error: xhr => {
                    console.log(typeof xhr.responseJSON == "undefined" ? xhr.responseText : xhr.responseJSON.message)
                }
            })
        } else {
            var pX = e.pageX,
                pY = e.pageY,
                oX = parseInt($(this).offset().left),
                oY = parseInt($(this).offset().top);

            $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>');
            $('.x-' + oX + '.y-' + oY + '').animate({
                "width": "500px",
                "height": "500px",
                "top": "-250px",
                "left": "-250px",

            }, 600);
            $("button", this).addClass('active');
        }

    });
    if ($('#alert').html()) {
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
            "timeOut": "0",
            "extendedTimeOut": "3000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.info($('#alert').html())
    }

    $(".alt-2").click(function () {
        if (!$(this).hasClass('material-button')) {
            $(".shape").css({
                "width": "100%",
                "height": "100%",
                "transform": "rotate(0deg)"
            });

            setTimeout(function () {
                $(".overbox").css({
                    "overflow": "initial"
                })
            }, 600);

            $(this).animate({
                "width": "140px",
                "height": "140px"
            }, 500, function () {
                $(".box").removeClass("back");

                $(this).removeClass('active')
            });

            $(".overbox .title").fadeOut(300);
            $(".overbox .input").fadeOut(300);
            $(".overbox .button").fadeOut(300);

            $(".alt-2").addClass('material-buton');
        }

    });

    $('.toggle-input--text').click(function () {
        const input = $('#regpass');
        if (input.val() !== "") {
            $(this).toggleClass('fa-eye-slash fa-eye');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        }
    });

    $(".material-button").click(function () {

        if ($(this).hasClass('material-button')) {
            setTimeout(function () {
                $(".overbox").css({
                    "overflow": "hidden"
                });
                $(".box").addClass("back");
            }, 200);
            $(this).addClass('active').animate({
                "width": "700px",
                "height": "700px"
            });

            setTimeout(function () {
                $(".shape").css({
                    "width": "50%",
                    "height": "50%",
                    "transform": "rotate(45deg)"
                });

                $(".overbox .title").fadeIn(300);
                $(".overbox .input").fadeIn(300);
                $(".overbox .button").fadeIn(300);
            }, 700);

            $(this).removeClass('material-button');

        }

        if ($(".alt-2").hasClass('material-buton')) {
            $(".alt-2").removeClass('material-buton');
            $(".alt-2").addClass('material-button');
        }

    });
    $('form#login').submit(function (e) {
        e.preventDefault();
    });
    $('form#register').submit(function (e) {
        e.preventDefault();
        const data = $(this).serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_url}register`,
            data: data,
            type: 'POST',
            beforeSend: xhr => {
                $('#register_next').html('Please Wait &nbsp; <div class="lds-circle"><div></div></div>')
            },
            success: res => {
                if (res) {
                    swal({
                        icon: "error",
                        title: "Error",
                        text: res
                    });
                } else {
                    toastr.success('Register Successfull! Verified your email and you\'re done', 'Success');
                    $('.alt-2').trigger('click');
                    setTimeout(() => {
                        $('#regname').val("");
                        $('#regpass').val("");
                        $('#regemail').val("");
                        $('#register_next').html('Next');

                        $(".spin").css({
                            "width": "0px"
                        });
                        $('.input input').parent(".input").each(function () {
                            $("label", this).css({
                                "line-height": "60px",
                                "font-size": "24px",
                                "font-weight": "300",
                                "top": "10px"
                            })
                        });
                    }, 600);
                }
            },
            error: xhr => {
                if (xhr.status !== 419) {
                    toastr.error(typeof xhr.responseJSON == "undefined" ? xhr.responseText : xhr.responseJSON.message);
                    console.log(typeof xhr.responseJSON == "undefined" ? xhr.responseText : xhr.responseJSON.message)
                } else {
                    window.reload()
                }
            },
            complete: xhr => {
                $('#register_next').html('You\'re Registered')
            }
        })
    });
    $('.pass-forgot').click(function () {
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
            "timeOut": "0",
            "extendedTimeOut": "3000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        swal({
            text: 'Masukkan Email Akun tujuan',
            content: "input",
            button: {
                text: "Kirim Verifikasi Email!",
                closeModal: false,
            },
        })
            .then(email => {
                if (!email) throw null;
                $.ajax({
                    type: 'POST',
                    url: `${base_url}fpasswordmanager`,
                    data: {
                        email: email
                    },
                    success: res => {
                        if(res){
                            toastr.error(res,'Error');
                        }else {
                            swal("Berhasil Mengirim verifikasi email", "Silahkan cek di email anda", "success")
                            swal.close();
                        }
                    },
                    error: xhr => {
                        toastr.error(xhr.responseJSON.message,'Error')
                        console.log(xhr.responseJSON.message)
                        swal("Oh noes!", "The AJAX request failed!", "error");
                    },
                    complete: xhr => {
                        swal.stopLoading();
                    }
                })
                swal.stopLoading();
            })
    })

});