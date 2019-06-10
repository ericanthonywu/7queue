$(document).ready(function () {
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function animasinomor(selector, angkaakhir, durasi, komanomor) {
        let angkaawal = $(selector).html() ? $(selector).val() : 0;
        $(selector).each(function () {
            $(this).prop('Counter', angkaawal).animate({
                Counter: angkaakhir
            }, {
                duration: durasi,
                easing: 'swing',
                step: function (now) {
                    if (komanomor === true) {
                        $(this).text(numberWithCommas(Math.ceil(now)));
                    } else {
                        $(this).text(Math.ceil(now));
                    }
                }
            });
        });
    }

    function validatenohp(nomor) {
        var re = /^08[0-9]{9,}$/;
        return re.test(nomor)
    }

    function numberWithCommas(n) {
        var parts = n.toString().split(".");
        return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
    }

    $("img").prop("draggable", false)

    $("#preventdef").click(function (e) {
        e.preventDefault();
    });
    $('.number').bind('keypress', function (event) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    $('.alphanumeric').keypress(function (event) {
        var regex = new RegExp("^[a-zA-Z0-9]$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $('.valuevalidate').bind('keyup keypress', function validatevalue() {
        var max = $(this).data('max-val');
        var min = $(this).data('min-val');
        var alertt = $(this).attr('allow-alert');
        var value = $(this).val();
        if (value > max) {
            if (alertt === "true") {
                alert('angka tidak boleh lebih dari ' + max);
            }
            $(this).val(max);
        } else if (value < min) {
            if (alertt === "true") {
                alert('angka tidak boleh kurang dari ' + min);
            }
            $(this).val(min);
        }
    });

    $('.lengthvalidate').bind('keyup keypress keydown', function () {
        const max = $(this).data('max-length');
        const value = $(this).val();
        const alertt = $(this).attr('allow-alert');
        if (value.length > max) {
            if (alertt === "true") {
                alert('jumlah huruf tidak boleh lebih dari ' + max);
            }
            $(this).val(value.substring(0, max));
        }
    });

    $('.ribuan').keyup(function (event) {
        if (event.which >= 37 && event.which <= 40) return;
        // format number
        $(this).val(function (index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                ;
        });
        var id = $(this).data("id");
        var value = $(this).val();
        var noCommas = value.replace(/,/g, "");
        $('#' + id).val(noCommas);
    });
    $('.validate-input').bind("blur keyup", function validate_input() {
        var value = $(this).val();
        var regexdata = $(this).data("regex");
        var regex = regexdata == null ? "" : regexdata.toLowerCase();
        var bungkus = $(this).data("div") == null ? "div" : $(this).data("div");
        var label = $(this).closest(bungkus).find("label");
        var errormsg = $(this).closest(bungkus).find("span");
        switch (regex) {
            case "email":
                if (value && validateEmail(value)) {
                    $(this).removeClass("is-invalid");
                    $(this).addClass("is-valid");
                    label.removeClass("text-danger");
                    label.addClass("text-success");
                    errormsg.html("");
                } else if (value && !validateEmail(value)) {
                    label.removeClass("text-success");
                    $(this).removeClass("is-valid");
                    if (!$(this).hasClass("is-invalid")) {
                        $(this).addClass("is-invalid");
                    }
                    label.addClass("text-danger");
                    errormsg.addClass("text-danger");
                    errormsg.removeClass("text-success");
                    errormsg.html("Email tidak valid");
                } else {
                    label.removeClass("text-success");
                    $(this).removeClass("is-valid");
                    if (!$(this).hasClass("is-invalid")) {
                        $(this).addClass("is-invalid");
                    }
                    label.addClass("text-danger");
                    errormsg.addClass("text-danger");
                    errormsg.removeClass("text-success");
                    errormsg.html("Field Tidak Boleh Kosong");
                }
                break;
            case "nohp":
                if (value && validatenohp(value)) {
                    $(this).removeClass("is-invalid");
                    $(this).addClass("is-valid");
                    label.removeClass("text-danger");
                    label.addClass("text-success");
                    errormsg.html("");
                } else if (value && !validatenohp(value)) {
                    label.removeClass("text-success");
                    $(this).removeClass("is-valid");
                    if (!$(this).hasClass("is-invalid")) {
                        $(this).addClass("is-invalid");
                    }
                    label.addClass("text-danger");
                    errormsg.addClass("text-danger");
                    errormsg.removeClass("text-success");
                    errormsg.html("No hp tidak valid");
                } else {
                    label.removeClass("text-success");
                    $(this).removeClass("is-valid");
                    if (!$(this).hasClass("is-invalid")) {
                        $(this).addClass("is-invalid");
                    }
                    label.addClass("text-danger");
                    errormsg.addClass("text-danger");
                    errormsg.removeClass("text-success");
                    errormsg.html("Field Tidak Boleh Kosong");
                }
                break;
            default:
                if (value) {
                    $(this).removeClass("is-invalid");
                    $(this).addClass("is-valid");
                    label.removeClass("text-danger");
                    label.addClass("text-success");
                    errormsg.html("");
                } else {
                    label.removeClass("text-success");
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                    label.addClass("text-danger");
                    errormsg.addClass("text-danger");
                    errormsg.removeClass("text-success");
                    errormsg.html("Field Tidak Boleh Kosong");
                }
                break;
        }
    });

    function jsontocsvconverter(JSONData, ReportTitle, ShowLabel) {
        //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
        let arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

        let CSV = '';
        //Set Report title in first row or line

        CSV += ReportTitle + '\r\n\n';

        //This condition will generate the Label/Header
        if (ShowLabel) {
            let row = "";

            //This loop will extract the label from 1st index of on array
            for (let index in arrData[0]) {

                //Now convert each value to string and comma-seprated
                row += index + ',';
            }

            row = row.slice(0, -1);

            //append Label row with line break
            CSV += row + '\r\n';
        }

        //1st loop is to extract each row
        for (let i = 0; i < arrData.length; i++) {
            let row = "";

            //2nd loop will extract each column and convert it in string comma-seprated
            for (let index in arrData[i]) {
                row += '"' + arrData[i][index] + '",';
            }

            row.slice(0, row.length - 1);

            //add a line break after each row
            CSV += row + '\r\n';
        }

        if (CSV == '') {
            alert("Invalid data");
            return;
        }

        //Generate a file name
        const fileName = ReportTitle.replace(' ','_')

        //Initialize file format you want csv or xls
        let uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

        // Now the little tricky part.
        // you can use either>> window.open(uri);
        // but this will not work in some browsers
        // or you will not get the correct file extension

        //this trick will generate a temp <a /> tag
        let link = document.createElement("a");
        link.href = uri;

        //set the visibility hidden so it will not effect on your web-layout
        link.style = "visibility:hidden";
        link.download = fileName + ".csv";

        //this part will append the anchor tag and remove it after automatic click
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
});