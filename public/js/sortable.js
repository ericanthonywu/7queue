$("#tblclient").sortable({
    items:'tr[id]',
    handle:'td:last-child',
    opacity: 0.8,
    cursor:'move',
    forcePlaceholderSize: true,
    tolerance: "pointer",
    helper: "clone",
    revert: 250,
    update: ()=> {
        let data = $("#tblclient").sortable('toArray',{
            attribute: 'id',
        });
        const length = data.length;
        let data_order = '';
        for(let x=0;x<length;x++) {
            // console.log(`${x+1} - ${data[x]}`)
            data_order += `${x + 1}-${data[x].replace('row-','')}${x == length - 1 ? "" : ","}`;
        }
        console.log(data_order)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                order : data_order
            },
            type:'POST',
            url: `${base_url}action/update/order_unit_file`,
            success: res =>{
                $("#tblclient").DataTable().ajax.reload()
            },
            error: xhr =>{
                console.log(xhr.responseJSON.message)
            }
        })
    },
})
$("#tblbanner").sortable({
    items:'tr[id]',
    handle:'td:last-child',
    opacity: 0.8,
    cursor:'move',
    forcePlaceholderSize: true,
    tolerance: "pointer",
    helper: "clone",
    revert: 250,
    update: ()=> {
        let data = $("#tblbanner").sortable('toArray',{
            attribute: 'id',
        });
        const length = data.length;
        let data_order = '';
        for(let x=0;x<length;x++) {
            // console.log(`${x+1} - ${data[x]}`)
            data_order += `${x + 1}-${data[x].replace('row-','')}${x == length - 1 ? "" : ","}`;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                order : data_order
            },
            type:'POST',
            url: `${base_url}action/update/order_banner`,
            success: res =>{
                $('#tblbanner').DataTable().ajax.reload()
            },
            error: xhr =>{
                console.log(xhr.responseJSON.message)
            }
        })
    },
})