$("#tblclient").sortable({
    items: 'tr[id]',
    handle: 'td:last-child',
    opacity: 0.8,
    cursor: 'move',
    forcePlaceholderSize: true,
    tolerance: "pointer",
    helper: "clone",
    revert: 250,
    update: () => {
        let data = $("#tblclient").sortable('toArray', {
            attribute: 'id',
        });
        const length = data.length;
        let data_order = '';
        for (let x = 0; x < length; x++) {
            // console.log(`${x+1} - ${data[x]}`)
            data_order += `${x + 1}-${data[x].replace('row-', '')}${x == length - 1 ? "" : ","}`;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                order: data_order
            },
            type: 'POST',
            url: `${base_url}action/update/order_unit_file`,
            success: res => {
                $("#tblclient").DataTable().ajax.reload()
            },
            error: xhr => {
                console.log(xhr.responseJSON.message)
            }
        })
    },
});
$("#tblbanner").sortable({
    items: 'tr[id]',
    handle: 'td:last-child',
    opacity: 0.8,
    cursor: 'move',
    forcePlaceholderSize: true,
    tolerance: "pointer",
    helper: "clone",
    revert: 250,
    update: () => {
        let data = $("#tblbanner").sortable('toArray', {
            attribute: 'id',
        });
        const length = data.length;
        let data_order = '';
        for (let x = 0; x < length; x++) {
            // console.log(`${x+1} - ${data[x]}`)
            data_order += `${x + 1}-${data[x].replace('row-', '')}${x == length - 1 ? "" : ","}`;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                order: data_order
            },
            type: 'POST',
            url: `${base_url}action/update/order_banner`,
            success: res => {
                $('#tblbanner').DataTable().ajax.reload()
            },
            error: xhr => {
                console.log(xhr.responseJSON.message)
            }
        })
    },
});
let oldList, newList, item;
let idglobal = '';
$(document).on('click', '.merchant_list', function () {
    const id = $(this).data('id');
    idglobal = id;
    $.ajax({
        url: `${base_url}get_merchant_list`,
        data: {
            id: id
        },
        success: res => {
            $('span#nama_trending').text(res[0].kategori);
            const listmerchant = res[1];
            let html_list_merchant = '';
            listmerchant.forEach(data => {
                html_list_merchant += `<div class="kt-widget6__item" style="cursor: pointer;" data-trending="${id}" data-merchant="${data.merchant}">
                                                <span>${data.merchant_name}</span>
                                                <span>${data.date_added}</span>
                                            </div>`
            });
            $('#list_merchant').html(html_list_merchant);
            let html_list_notmerchant = '';
            const listnotmerchant = res[2];
            listnotmerchant.forEach(datas => {
                html_list_notmerchant += `
                    <div class="kt-widget6__item" style="cursor: pointer;" data-trending="${id}" data-merchant="${datas.id}">
                        <span>${datas.nickname}</span>
                        <span>${datas.jumlah_trending}</span>
                    </div>`
            });
            $('#list_notmerchant').html(html_list_notmerchant)
        }
    })
});
$('#find_merchant').keyup(function (e) {
    if (e.keyCode == 13) {
        const val = $(this).val();
        $.ajax({
            url: `${base_url}get_filtered_merchant_list`,
            data: {
                id: idglobal,
                val: val,
                status: "list_merchant"
            },
            success: res => {
                let html_list_merchant = '';
                res.forEach(data => {
                    html_list_merchant += `<div class="kt-widget6__item" style="cursor: pointer;" data-trending="${idglobal}" data-merchant="${data.merchant}">
                                                <span>${data.merchant_name}</span>
                                                <span>${data.date_added}</span>
                                            </div>`;
                })
                $('#list_merchant').html(html_list_merchant);
            }
        })
    }
});
$('#find_notmerchant').keyup(function (e) {
    if (e.keyCode == 13) {
        const val = $(this).val();
        $.ajax({
            url: `${base_url}get_filtered_merchant_list`,
            data: {
                id: idglobal,
                val: val,
                status: "list_notmerchant"
            },
            success: res => {
                let html_list_notmerchant = '';
                res.forEach(datas => {
                    html_list_notmerchant += `
                    <div class="kt-widget6__item" style="cursor: pointer;" data-trending="${idglobal}" data-merchant="${datas.id}">
                        <span>${datas.nickname}</span>
                        <span>${datas.jumlah_trending}</span>
                    </div>`
                });
                $('#list_notmerchant').html(html_list_notmerchant)
            }
        })
    }
});
$('.dragdropmerchant').sortable({
    items: '.kt-widget6__item',
    // handle: '.kt-widget6__item',
    opacity: 0.8,
    cursor: 'move',
    forcePlaceholderSize: true,
    tolerance: "pointer",
    helper: "clone",
    revert: 250,
    connectWith: '.dragdropmerchant',
    start: (e, ui) => {
        item = ui.item;
        newList = oldList = ui.item.parent();
    },
    stop: e => {
        let progress_table = 0;
        if (oldList.attr('id') !== newList.attr('id')) {
            $.ajax({
                url: `${base_url}trending/${newList.attr('id')}`,
                data: {
                    merchant: item[0].dataset.merchant,
                    trending: item[0].dataset.trending,
                },
                xhr: () => {
                    var xhr = $.ajaxSettings.xhr();
                    xhr.upload.onprogress = e => {
                        progress_table = e.loaded / e.total * 100;
                        $('#modalprogress').css('width', e.loaded / e.total * 100 + '%').text(e.loaded / e.total * 100 + '%');
                    };
                    return xhr;
                },
                success: res => {
                    if (res) {
                        toastr.error(res, "Error");
                    } else {
                        const id = idglobal;
                        $.ajax({
                            url: `${base_url}get_merchant_list`,
                            data: {
                                id: id
                            },
                            success: res => {
                                if (newList.attr('id') === "list_merchant") {
                                    const listmerchant = res[1];
                                    let html_list_merchant = '';
                                    listmerchant.forEach(data => {
                                        html_list_merchant += `<div class="kt-widget6__item" style="cursor: pointer;" data-trending="${id}" data-merchant="${data.merchant}">
                                                <span>${data.merchant_name}</span>
                                                <span>${data.date_added}</span>
                                            </div>`
                                    });
                                    $('#list_merchant').html(html_list_merchant);
                                } else if (newList.attr('id') === "list_notmerchant") {
                                    let html_list_notmerchant = '';
                                    const listnotmerchant = res[2];
                                    listnotmerchant.forEach(datas => {
                                        html_list_notmerchant += `<div class="kt-widget6__item" style="cursor: pointer;" data-trending="${id}" data-merchant="${datas.id}">
                                                <span>${datas.nickname}</span>
                                                <span>${datas.jumlah_trending}</span>
                                            </div>`
                                    });
                                    $('#list_notmerchant').html(html_list_notmerchant)
                                }
                            }
                        })
                    }
                }
            });
        }
        // alert("Moved " + item.children('span:first-child').text() + " from " + oldList.attr('id') + " to " + newList.attr('id'))
    },
    change: (e, ui) => {
        if (ui.sender) newList = ui.placeholder.parent();
    },
}).disableSelection();

let poldList, pnewList, pitem;
let pidglobal = '';
$(document).on('click', '.show_products', function () {
    const id = $(this).data('id');
    pidglobal = id;
    $.ajax({
        url: `${base_url}get_products_list`,
        data: {
            id: id
        },
        success: res => {
            const listmerchant = res[1];
            let html_list_merchant = '';
            listmerchant.forEach(data => {
                html_list_merchant += `
                    <div class="kt-widget6__item" style="cursor: pointer;" data-merchant="${id}" data-merchantproduk="${data.products}">
                        <span>${data.merchant_name}</span>
                        <span></span>
                    </div>`
            });
            $('#list_produk').html(html_list_merchant);
            let html_list_notmerchant = '';
            const listnotmerchant = res[2];
            listnotmerchant.forEach(datas => {
                html_list_notmerchant += `
                    <div class="kt-widget6__item" style="cursor: pointer;" data-merchant="${id}" data-merchantproduk="${datas.id}">
                        <span>${datas.nama}</span>
                        <span></span>
                    </div>`
            });
            $('#list_allproduk').html(html_list_notmerchant)
        }
    })
});
$('#find_merchant').keyup(function (e) {
    if (e.keyCode == 13) {
        const val = $(this).val();
        $.ajax({
            url: `${base_url}get_filtered_merchant_list`,
            data: {
                id: idglobal,
                val: val,
                status: "list_merchant"
            },
            success: res => {
                /*
                const res = [
                    "satu",
                    "dua",
                    "satu"
                ]
                res['angka1'] // satu
                 */
                let html_list_merchant = '';
                res.forEach(data => {
                    html_list_merchant += `<div class="kt-widget6__item" style="cursor: pointer;" data-trending="${idglobal}" data-merchant="${data.merchant}">
                                                <span>${data.merchant_name}</span>
                                                <span>${data.date_added}</span>
                                            </div>`;
                })
                $('#list_merchant').html(html_list_merchant);
            }
        })
    }
});
$('#find_notmerchant').keyup(function (e) {
    if (e.keyCode == 13) {
        const val = $(this).val();
        $.ajax({
            url: `${base_url}get_filtered_merchant_list`,
            data: {
                id: idglobal,
                val: val,
                status: "list_notmerchant"
            },
            success: res => {
                let html_list_notmerchant = '';
                res.forEach(datas => {
                    html_list_notmerchant += `
                    <div class="kt-widget6__item" style="cursor: pointer;" data-trending="${idglobal}" data-merchant="${datas.id}">
                        <span>${datas.nickname}</span>
                        <span>${datas.jumlah_trending}</span>
                    </div>`
                });
                $('#list_notmerchant').html(html_list_notmerchant)
            }
        })
    }
});
$('.dragdropproduk').sortable({
    items: '.kt-widget6__item',
    // handle: '.kt-widget6__item',
    opacity: 0.8,
    cursor: 'move',
    forcePlaceholderSize: true,
    tolerance: "pointer",
    helper: "clone",
    revert: 250,
    connectWith: '.dragdropproduk',
    start: (e, ui) => {
        pitem = ui.item;
        pnewList = poldList = ui.item.parent();
    },
    stop: e => {
        let progress_table = 0;
        if (poldList.attr('id') !== pnewList.attr('id')) {
            $.ajax({
                url: `${base_url}products/${pnewList.attr('id')}`,
                data: {
                    merchant: pitem[0].dataset.merchant,
                    merchantproduk: pitem[0].dataset.merchantproduk,
                },
                xhr: () => {
                    var xhr = $.ajaxSettings.xhr();
                    xhr.upload.onprogress = e => {
                        progress_table = e.loaded / e.total * 100;
                        $('#modalprogress').css('width', e.loaded / e.total * 100 + '%').text(e.loaded / e.total * 100 + '%');
                    };
                    return xhr;
                },
                success: res => {
                    if (res) {
                        toastr.error(res, "Error");
                    } else {
                        // const id = pidglobal;
                        // $.ajax({
                        //     url: `${base_url}get_products_list`,
                        //     data: {
                        //         id: id
                        //     },
                        //     success: res => {
                        //         if (pnewList.attr('id') === "list_produk") {
                        //             const listmerchant = res[1];
                        //             let html_list_merchant = '';
                        //             listmerchant.forEach(data => {
                        //                 html_list_merchant += `
                        //                      <div class="kt-widget6__item" style="cursor: pointer;" data-merchant="${id}" data-merchantproduk="${data.merchant}">
                        //                         <span>${data.merchant_name}</span>
                        //                         <span></span>
                        //                     </div>`
                        //             });
                        //             $('#list_produk').html(html_list_merchant);
                        //         } else if (pnewList.attr('id') === "list_allproduk") {
                        //             let html_list_notmerchant = '';
                        //             const listnotmerchant = res[2];
                        //             listnotmerchant.forEach(datas => {
                        //                 html_list_notmerchant += `<div class="kt-widget6__item" style="cursor: pointer;" data-merchant="${id}" data-merchantproduk="${datas.id}">
                        //                         <span>${datas.nama}</span>
                        //                         <span></span>
                        //                     </div>`
                        //             });
                        //             $('#list_allproduk').html(html_list_notmerchant)
                        //         }
                        //     }
                        // })
                    }
                }
            });
        }
        // alert("Moved " + item.children('span:first-child').text() + " from " + oldList.attr('id') + " to " + newList.attr('id'))
    },
    change: (e, ui) => {
        if (ui.sender) pnewList = ui.placeholder.parent();
    },
}).disableSelection();

