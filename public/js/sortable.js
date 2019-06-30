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
        console.log(data_order);
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
let oldList,newList,item;
$('.dragdropmerchant').sortable({
    items: '.kt-widget6__item',
    // handle: '.kt-widget6__item',
    opacity: 0.8,
    cursor: 'move',
    forcePlaceholderSize: true,
    tolerance: "pointer",
    helper: "clone",
    revert: 250,
    connectWith:'.dragdropmerchant',
    start: (e,ui) => {
        item = ui.item[0];
        newList = oldList = ui.item.parent();
    },
    stop: e => {
        $.ajax({
            url:`${base_url}merchant/${newList.attr('id') === ""}`,
            data:{
                id:item.dataset.id,
            }
        })
        console.log(item.dataset.id);
        // alert("Moved " + item.children('span:first-child').text() + " from " + oldList.attr('id') + " to " + newList.attr('id'))
    },
    change: (e, ui) => {
        if(ui.sender) newList = ui.placeholder.parent();
    },
}).disableSelection();