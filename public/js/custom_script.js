$(document).ready(function () {
    $(document).on('click', '.btn-block-admin', function () {
        const id = $(this).data('id');
        const status = $(this).data('status');
        swal.fire({
            title: `Apakah anda yakin akan meng${status ? "block" : "unblock"} admin ini?`,
            text: `Anda bisa meng${status ? "unblock" : "block"} user kembali`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: `Ya, ${status ? "Block" : "Unblock"} saja!`,
            cancelButtonText: 'Batalkan',
            reverseButtons: true
        }).then(result => {
            if (result.value) {
                $.ajax({
                    data: {id: id, status: status},
                    url: `${base_url}action/chgstadmin`,
                    success: res => {
                        swal.fire(
                            `Sukses! Admin telah di ${status ? "block" : "unblock"}`,
                            '',
                            'success'
                        );
                        $('#tbladmin').KTDatatable().reload()
                    }
                })
            }
        });

    })
});