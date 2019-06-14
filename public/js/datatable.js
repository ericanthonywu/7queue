$(document).ready(function () {
    function showphoto(dir, name) {
        return `<a class="kt-link" href="${base_image}${dir}/${name}" target="_blank"><img src="${base_image}${dir}/${name}" alt="" width="100%"></a>`
    }

    function numberWithCommas(n) {
        var parts = n.toString().split(".");
        return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
    }

    function refreshkategori() {
        $.get(`${base_url}getkategori`, (data, st) => {
            let html = '';
            data.forEach(o => {
                html += `<option value="${o.id}">${o.kategori}</option>`
            });

            $('.kt-selectpicker').html(html);
            $('.kt-selectpicker').selectpicker('refresh');
        });
        $('.kt-selectpicker').selectpicker('refresh');
    }

    let manager = $('#tblmanager').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `${base_table}manager`,
                    // sample custom headers
                    headers: {'x-my-custokt-header': 'some value', 'x-test-header': 'the value'},
                    // map: function (raw) {
                    //     // sample data mapping
                    //     return typeof raw.data !== 'undefined' ? raw.data : raw;
                    // },
                },
            },
            pageSize: 10,
            // serverPaging: true,
            // serverFiltering: true,
            // serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
            input: $('#generalSearch'),
        },

        // columns definition
        columns: [
            {
                field: 'no',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'username',
                title: 'Username',
            },
            {
                field: 'name',
                title: 'Name',
            },
            {
                field: 'email',
                title: 'Email',
                template: t => {
                    return `<a class="kt-link" href="mailto:${t}">${t.email}</a>`
                }
            },
            {
                field: 'tgl_dibuat',
                title: 'Tanggal Dibuat',
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                overflow: 'visible',
                autoHide: false,
                template: (t, e, a) => {
                    return `
						<div class="dropdown">
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">
                                <i class="flaticon2-gear"></i>
                            </a>
						  	<div class="dropdown-menu dropdown-menu-right">
						    	${t.status === 1 ?
                        `<button class="dropdown-item toggleuser" data-status="0" data-nama="${t.username}" data-action="block" data-id="${t.id}" data-table="admin"><i class="fa fa-user-slash"></i> unBlock </button>`
                        : `<button class="dropdown-item toggleuser" data-status="1" data-nama="${t.username}" data-action="block" data-id="${t.id}" data-table="admin"><i class="fa fa-user-slash"></i> Block </button>`}
						    	${t.status === 2 ?
                        ` 
                                        <button class="dropdown-item toggleuser" 
                                                    data-status="0" data-nama="${t.username}" data-action="suspend" data-table="admin" 
                                                    data-id="${t.id}" ><i class="fa fa-user-check"></i> Unsuspend </button>
                                    `
                        :
                        `
                                        <button class="dropdown-item toggleuser" 
                                                    data-status="2" data-nama="${t.username}" data-action="suspend" data-table="admin" 
                                                    data-id="${t.id}" ><i class="fa fa-user-times"></i> Suspend </button>`
                        }
						  	</div>
						</div>
					`
                },
            }],

    });
    let merchants = $('#tblmerchants').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `${base_table}merchants`,
                    // sample custom headers
                    // headers: {'x-my-custokt-header': 'some value', 'x-test-header': 'the value'},
                    // map: function (raw) {
                    //     // sample data mapping
                    //     return typeof raw.data !== 'undefined' ? raw.data : raw;
                    // },
                },
            },
            pageSize: 10,
            // serverPaging: true,
            // serverFiltering: true,
            // serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
            input: $('#generalSearch'),
        },

        // columns definition
        columns: [
            {
                field: 'no',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'username',
                title: 'Username',
            },
            {
                field: 'nickname',
                title: 'Name',
            },
            {
                field: 'email',
                title: 'Email',
                template: t => {
                    return `<a class="kt-link" href="mailto:${t.email}">${t.email} </a>`
                }
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                overflow: 'visible',
                autoHide: false,
                template: t => {
                    return `
                    ${
                        t.readedit ? `
						<div class="dropdown">
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">
                                <i class="flaticon2-gear"></i>
                            </a>
						  	<div class="dropdown-menu dropdown-menu-right">
                             <a class="dropdown-item" href="${base_url}merchants/edit/${t.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                <rect id="Rectangle" fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                            </g>
                                        </svg> Edit </a>
                               <a class="dropdown-item btn-del" data-table="merchants" data-id="${t.id}" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" id="round" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" id="Shape" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg> Delete </a>          
                                </div>
                            </div>
                                ` :
                            ""
                        }
					`
                },
            }],

    });
    let customers = $('#tblcustomers').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `${base_table}customers`,
                    // sample custom headers
                    // headers: {'x-my-custokt-header': 'some value', 'x-test-header': 'the value'},
                    // map: function (raw) {
                    //     // sample data mapping
                    //     return typeof raw.data !== 'undefined' ? raw.data : raw;
                    // },
                },
            },
            pageSize: 10,
            // serverPaging: true,
            // serverFiltering: true,
            // serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
            input: $('#generalSearch'),
        },

        // columns definition
        columns: [
            {
                field: 'no',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'username',
                title: 'Username',
            },
            {
                field: 'nickname',
                title: 'Name',
            },
            {
                field: 'email',
                title: 'Email',
                template: (t, e, a) => {
                    return `<a class="kt-link" href="mailto:${t}">
                                ${t.email}
                            </a>`
                }
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                overflow: 'visible',
                autoHide: false,
                template: (t, e, a) => {
                    return `
                    ${
                        t.status === 1 ? `
						<div class="dropdown">
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">
                                <i class="flaticon2-gear"></i>
                            </a>
						  	<div class="dropdown-menu dropdown-menu-right">
                             <a class="dropdown-item" href="${base_url}merchants/edit/${t.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                <rect id="Rectangle" fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                            </g>
                                        </svg> Edit </a>
                               <a class="dropdown-item btn-del" data-table="merchants" data-id="${t.id}" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" id="round" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" id="Shape" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg> Delete </a>          
                                </div>
                            </div>
                                ` :
                            ""
                        }
					`
                },
            }],

    });
    let admin = $('#tbladmin').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `${base_table}admin`,
                    // sample custom headers
                    // headers: {'x-my-custokt-header': 'some value', 'x-test-header': 'the value'},
                    // map: function (raw) {
                    //     // sample data mapping
                    //     return typeof raw.data !== 'undefined' ? raw.data : raw;
                    // },
                },
            },
            pageSize: 10,
            // serverPaging: true,
            // serverFiltering: true,
            // serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
            input: $('#generalSearch'),
        },

        // columns definition
        columns: [
            {
                field: 'no',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'username',
                title: 'Username',
            },
            {
                field: 'name',
                title: 'Name',
            },
            {
                field: 'email',
                title: 'Email',
                template: (t, e, a) => {
                    return `<a class="kt-link" href="mailto:${t}">${t.email}</a>`
                }
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                overflow: 'visible',
                autoHide: false,
                template: (t, e, a) => {
                    $('[data-toggle="kt-tooltip"]').tooltip();
                    return `
                    ${
                        t.access ? `
						<div class="dropdown">
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">
                                <i class="flaticon2-gear"></i>
                            </a>
						  	<div class="dropdown-menu dropdown-menu-right">
                             <a class="dropdown-item" href="${base_url}admin/edit/${t.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                <rect id="Rectangle" fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                            </g>
                                        </svg> &nbsp; Edit </a>
                               <a class="dropdown-item btn-del" data-table="admin" data-id="${t.id}" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" id="round" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" id="Shape" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg> &nbsp; Delete </a>          
                                </div>
                            </div>
                            <button title="${t.status ? "Unblock" : "Block"} Admin" data-id="${t.id}" data-status="${t.status ? 0 : 1}" class="btn btn-sm btn-clean btn-icon btn-icon-md btn-block-admin" data-toggle="kt-tooltip" data-placement="top" data-skin="dark"><i class="fa ${t.status ? "fa-user-check" : "fa-user-alt-slash"}"></i></button>
                                ` :
                            ""
                        }
					`
                },
            }],

    });
    let products = $('#tblproducts').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `${base_table}products`,
                    // sample custom headers
                    // headers: {'x-my-custokt-header': 'some value', 'x-test-header': 'the value'},
                    // map: function (raw) {
                    //     // sample data mapping
                    //     return typeof raw.data !== 'undefined' ? raw.data : raw;
                    // },
                },
            },
            pageSize: 10,
            // serverPaging: true,
            // serverFiltering: true,
            // serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
            input: $('#generalSearch'),
        },

        // columns definition
        columns: [
            {
                field: 'no',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'nama',
                title: 'Nama Produk',
            },
            {
                field: 'kategorinya',
                title: 'Kategori',
            },
            {
                field: 'foto',
                title: 'Foto',
                template: t => {
                    return showphoto('products', t.foto)
                }
            },
            {
                field: 'harga',
                title: 'Harga',
                template: t => {
                    return "Rp. " + numberWithCommas(t.harga)
                }
            },
            {
                field: 'description',
                title: 'Deskripsi',
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 110,
                overflow: 'visible',
                autoHide: false,
                template: (t, e, a) => {
                    $('[data-toggle="kt-tooltip"]').tooltip();
                    return `
                    ${
                        t.access ? `
						<div class="dropdown">
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">
                                <i class="flaticon2-gear"></i>
                            </a>
						  	<div class="dropdown-menu dropdown-menu-right">
                             <a class="dropdown-item" href="${base_url}products/edit/${t.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                <rect id="Rectangle" fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                            </g>
                                        </svg> &nbsp; Edit </a>
                               <a class="dropdown-item btn-del" data-table="products" data-id="${t.id}" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" id="round" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" id="Shape" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg> &nbsp; Delete </a>          
                                </div>
                            </div>
                                ` :
                            ""
                        }
					`
                },
            }],

    });
    let kategori_produk = $('#tblkategori_produk').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `${base_table}kategoriproduk`,
                    // sample custom headers
                    // headers: {'x-my-custokt-header': 'some value', 'x-test-header': 'the value'},
                    // map: function (raw) {
                    //     // sample data mapping
                    //     return typeof raw.data !== 'undefined' ? raw.data : raw;
                    // },
                },
            },
            pageSize: 10,
            // serverPaging: true,
            // serverFiltering: true,
            // serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
            input: $('#generalSearch'),
        },

        // columns definition
        columns: [
            {
                field: 'no',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                selector: false,
                textAlign: 'center',
            },
            {
                field: 'kategori',
                title: 'Kategori',
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,

                overflow: 'visible',
                autoHide: false,
                template: (t, e, a) => {
                    $('[data-toggle="kt-tooltip"]').tooltip();
                    return `
                                <button class="btn btn-secondary btn-outline-secondary btn-editkategori" data-id="${t.id}" data-kategori="${t.kategori}">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                            <rect id="Rectangle" fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                        </g>
                                    </svg> Edit 
                                </button>
                                <button class="btn btn-secondary btn-outline-secondary btn-del" data-id="${t.id}" data-table="kategori_produk">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" id="round" fill="#000000" fill-rule="nonzero"/>
                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" id="Shape" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg> Delete
                                </button>
				
					`
                },
            }],

    });

    // $('#kt_form_status').change( function () {
    //     datatable.search($(this).val().toLowerCase(), 'Status');
    // });
    //
    // $('#kt_form_type').change(function () {
    //     datatable.search($(this).val().toLowerCase(), 'Type');
    // });

    // $('#kt_form_status,#kt_form_type').selectpicker();

    // Dropzone.options.kDropzoneOne = {
    //     paramName: "file", // The name that will be used to transfer the file
    //     maxFiles: 100,
    //     maxFilesize: 5, // MB
    //     addRemoveLinks: true,
    //     acceptedFiles: "image/*",
    //     accept: function(file, done) {
    //         console.log(file)
    //         console.log(done)
    //         if (file.name == "justinbieber.jpg") {
    //             done("Naha, you don't.");
    //         } else {
    //             done();
    //         }
    //     },
    //     init: function () {
    //         this.on("complete", function (file) {
    //             experiences.ajax.reload();
    //         });
    //     }
    // };

    //----------tambah edit delete----------------------------
    $(document).on('submit', 'form', function (e) {
        e.preventDefault();
        if ($(this).attr('id') === "fkategoriproduk") {
            if ($('.btn_kategori').val() === "Edit Kategori") {
                $.ajax({
                    url: `${base_url}action/update/kategoriproduk`,
                    data: {
                        kategori: $('#kategori').val(),
                        id: $('#idkategori').val()
                    },
                    success: res => {
                        refreshkategori();
                        $('#tblkategori_produk').KTDatatable().reload();
                        $('#idkategori').val('');
                        $('#kategori').val("");
                        $('.btn_kategori').val('Tambah Kategori');
                    }
                })
            } else {
                $.ajax({
                    url: `${base_url}action/kategoriproduk`,
                    data: {
                        kategori: $('#kategori').val(),
                    },
                    success: res => {
                        refreshkategori();
                        $('#tblkategori_produk').KTDatatable().reload();
                        $('#kategori').val("");
                        $('#idkategori').val("")
                    }
                });
                $('.kt-selectpicker').selectpicker('refresh');

            }
        } else {
            const data = new FormData(this);
            const action = $(this).data('action');
            const url = $(this).find('input[type="submit"]').val() === "Edit" ?
                `${base_url}action/update/${action}` :
                `${base_url}action/${action}`;
            console.log(url);
            $.ajax({
                data: data,
                url: url,
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                success: res => {
                    if (res) {
                        toastr.error(res, "Error");
                    } else {
                        location.href = base_url + action;
                    }
                },
            })
        }

    });
    $(document).on('click', '.btn-edit', function () {
        const table = $(this).data('table'),
            id = $(this).data('id');
        $.ajax({
            url: `${base_table}generateedit`,
            data: {
                id: id,
                table: table
            },
            success: res => {
                let keys = Object.keys(res[0]);
                for (let i = 0; i < keys.length; i++) {
                    let key = keys[i];
                    $(`#fedit input[name="${key}"]`).val(res[0][key]);
                    $(`#fedit select[name="${key}"] option[value="${res[0][key]}"]`)
                        .attr('selected', 'selected').trigger('change');
                    $(`#fedit input[name="password"]`).val("")
                }
            }
        })
    });

    $(document).on('click', '.btn-del', function (e) {
        e.preventDefault();
        const table = $(this).data('table'),
            id = $(this).data('id');
        swal.fire({
            title: 'Apakah anda yakin akan menghapus data ini?',
            text: "Anda tidak bisa mengembalikan data yang sudah di hapus secara permanen",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus saja!',
            cancelButtonText: 'Batalkan',
            reverseButtons: true
        }).then(result => {
            if (result.value) {
                $.ajax({
                    data: {
                        id: id,
                        table: table,
                    },
                    type: 'DELETE',
                    url: `${base_url}delete/table`,
                    success: res => {
                        if (res) {
                            toastr.error(res, "Error");
                        } else {
                            swal.fire(
                                'Sukses! Data telah di hapus',
                                '',
                                'success'
                            );
                            switch (table) {
                                case "admin":
                                    admin.reload();
                                    break;
                                case "manager":
                                    manager.reload();
                                    break;
                                case "products":
                                    products.reload();
                                    break;
                                case "kategori_produk":
                                    kategori_produk.reload();
                                    refreshkategori();
                                    break;
                            }
                        }
                    },
                })
            }
        });
    });
    $(document).on('click', '.btn-editkategori', function () {
        const id = $(this).data('id');
        const kategori = $(this).data('kategori');
        $('#kategori').val(kategori);
        $('#idkategori').val(id);
        $('.btn_kategori').val('Edit Kategori')
    });
    $(document).on('click', '.toggleuser', function () {
        const id = $(this).data('id');
        const status = $(this).data('status');
        const action = $(this).data('action');
        const nama = $(this).data('nama');

        switch (status) {
            case 1:
                swal.fire({
                    title: `Apakah anda yakin akan meng${!status ? "un" : ""}${action} manager ${nama}?`,
                    text: `Anda bisa meng${status ? "un" : ""}${action} manager ${nama} kembali`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: `Ya, ${!status ? "un" : ""}${action} saja!`,
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: `${base_url}toggleuser`,
                            data: {
                                id: id,
                                status: status
                            },
                            success: res => {
                                swal.fire(
                                    `Sukses! Manager ${nama} telah di ${!status ? "un" : ""}${action}`,
                                    '',
                                    'success'
                                );
                                manager.reload()
                            }
                        })
                    }
                });
                break;
            case 2:
                swal.fire({
                    title: `Apakah anda yakin akan meng${!status ? "un" : ""}${action} manager ${nama}?`,
                    text: `Anda bisa meng${status ? "un" : ""}${action} manager ${nama} kembali`,
                    type: 'warning',
                    // html: '<input id="datepicker" class="form-control" readonly>',
                    input: 'text',
                    inputPlaceholder: 'Suspend Time',
                    inputAttributes: {
                        placeholder: "Type your username",
                        type: "text",
                        id: "datepicker",
                        class: "form-control",
                        readonly: true,
                        autofocus: false
                    },
                    onOpen: () => {
                        swal.getConfirmButton().focus();
                        let today = new Date();
                        const dd = String(today.getDate()).padStart(2, '0');
                        const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                        const yyyy = today.getFullYear();
                        const h = today.getHours();
                        const m = today.getMinutes();
                        $('#datepicker').datetimepicker({
                            format: "dd MM yyyy hh:ii",
                            startDate: `${dd} ${mm} ${yyyy} ${h}:${m}`
                        });
                    },
                    inputValidator: (value) => {
                        return !value && 'Mohon Pilih Waktu'
                    },
                    showCancelButton: true,
                    confirmButtonText: `Ya, ${!status ? "un" : ""}${action} saja!`,
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: `${base_url}toggleuser`,
                            data: {
                                id: id,
                                status: status,
                                suspend_time: $('#datepicker').val()
                            },
                            success: res => {
                                swal.fire(
                                    `Sukses! Manager ${nama} telah di ${!status ? "un" : ""}${action}`,
                                    '',
                                    'success'
                                );
                                manager.reload()
                            }
                        })
                    }
                });
                break;
            default:
                $.ajax({
                    url: `${base_url}toggleuser`,
                    data: {
                        id: id,
                        status: status,
                    },
                    success: res => {
                        swal.fire(
                            `Sukses! Manager ${nama} telah di ${!status ? "un" : ""}${action}`,
                            '',
                            'success'
                        );
                        manager.reload()
                    }
                })

        }


    })
});
