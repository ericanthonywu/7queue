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

            $('.kt-selectpicker').html(html)
                .selectpicker('refresh');
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
                    map: raw => {
                        // sample data mapping
                        return typeof raw.data !== 'undefined' ? raw.data : raw;
                    },
                },
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
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
                field: 'nickname',
                title: 'Nickname',
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
                        `<button class="dropdown-item toggleuser" data-status="0" data-nama="${t.nickname}" data-action="block" data-id="${t.id}" data-table="manager"><i class="fa fa-user-slash"></i> unBlock </button>`
                        : `<button class="dropdown-item toggleuser" data-status="1" data-nama="${t.nickname}" data-action="block" data-id="${t.id}" data-table="manager"><i class="fa fa-user-slash"></i> Block </button>`}
						    	${t.status === 2 ?
                        ` 
                                        <button class="dropdown-item toggleuser" 
                                                    data-status="0" data-nama="${t.nickname}" data-action="suspend" data-table="manager" 
                                                    data-id="${t.id}" ><i class="fa fa-user-check"></i> Unsuspend </button>
                                    `
                        :
                        `
                                        <button class="dropdown-item toggleuser" 
                                                    data-status="2" data-nama="${t.nickname}" data-action="suspend" data-table="manager" 
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
                field: 'nickname',
                title: 'Name',
            },
            {
                field: 'foto',
                title: 'Foto Merchant',
                template: t => {
                    return t.foto ? showphoto('merchant', t.foto) : `${base_url}assets_user/images/logo-7queue.png`;
                }
            },
            {
                field: 'email',
                title: 'Email',
                template: t => {
                    return `<a class="kt-link" href="mailto:${t.email}">${t.email} </a>`
                }
            },
            {
                field: 'location',
                title: 'Location',
                template: t => {
                    return `<a target="_blank" class="kt-link" href="https://maps.google.com/maps?q=${t.lat},${t.long}"><i class="flaticon-map-location"></i></a>`
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
    let users = $('#tblusers').KTDatatable({
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
                        `
                        <div class="dropdown">
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">
                                <i class="flaticon2-gear"></i>
                            </a>
						  	<div class="dropdown-menu dropdown-menu-right">
						    	${
                            t.status === 1 ?
                                `<button class="dropdown-item toggleuser" data-status="0" data-nama="${t.nickname}" data-action="block" data-id="${t.id}" data-table="users"><i class="fa fa-user-slash"></i> unBlock </button>`
                                : `<button class = "dropdown-item toggleuser" data-status="1" data-nama="${t.nickname}" data-action="block" data-id="${t.id}" data-table="users"><i class="fa fa-user-slash"></i> Block </button>`}
						    	${t.status === 2 ?
                            `
                        <button class="dropdown-item toggleuser" data-status="0" data-nama="${t.nickname}" data-action="suspend" data-table="users" 
                        data-id="${t.id}" ><i class="fa fa-user-check"></i> Unsuspend </button>
                        `
                            :
                            `
                            <button class="dropdown-item toggleuser" 
                                        data-status="2" data-nama="${t.nickname}" data-action="suspend" data-table="users" 
                                        data-id="${t.id}" ><i class="fa fa-user-times"></i> Suspend </button>`
                            }
                                              </div>
                                        </div>`
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
    let feedback = $('#tblfeedback').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `${base_table}feedback`,
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
                field: 'email',
                title: 'Email',
                template: t => {
                    return `<a href="mailto:${t.email}" class="kt-link">${t.email}</a>`
                }
            },
            {
                field: 'feedback',
                title: 'Feedback',
            },
            {
                field: 'rating',
                title: 'Rating',
            },
            {
                field: 'tgl_dibuat',
                title: 'Created At',
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
    let banner = $('#tblbanner').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `${base_table}banner`,
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
                title: 'Nama',
            },
            {
                field: 'file',
                title: 'Gambar',
                template: t => {
                    return showphoto('banner', t.file);
                }
            },
            {
                field: 'phone',
                title: 'No Telp',
            },
            {
                field: 'url',
                title: 'Url',
                template: t => {
                    return `<a href="${t.url}" target="_blank" class="kt-link">${t.url}</a>`
                }
            },
            {
                field: 'coor',
                title: 'Coor Map',
                template: t => {
                    return `<a target="_blank" class="kt-link" href="https://maps.google.com/maps?q=${t.lat},${t.long}"><i class="flaticon-map-location"></i></a>`
                }
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
                                <a class="btn btn-secondary btn-outline-secondary" href="${base_url}banner/edit/${t.id}">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                            <rect id="Rectangle" fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                        </g>
                                    </svg> Edit 
                                </a>
                                <button class="btn btn-secondary btn-outline-secondary btn-del" data-id="${t.id}" data-table="banner">
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
    let trending = $('#tbltrending').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `${base_table}trending`,
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
                title: 'Category',
            },
            {
                field: 'merchant',
                title: 'Merchant',
                template: t => {
                    return `<button class="btn btn-primary merchant_list" data-id="${t.id}" data-toggle="modal" data-target="#detmerchant">Merchant List</button>`
                }
            },
            {
                field: 'added_at',
                title: 'Added At',
            },
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                overflow: 'visible',
                autoHide: false,
                template: t => {
                    $('[data-toggle="kt-tooltip"]').tooltip();
                    return `
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
    let detmerchant = $('#detmerchant_1').DataTable({
        dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>", // horizobtal scrollable datatable
        responsive: false,
        ajax: ` ${base_table}detmerchant/0`,
        columns: [
            {
                title: "Merchants",
                data: "nama",
                sClass: "text-center",
            },
            {
                data: "id",
                sClass: "text-center",
                render: (t, e, a) => {
                    $('.btn-data').tooltip();
                    return `
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                    </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="${base_url}banner/edit/${t}" class="dropdown-item" title="Perbarui Data">
                                <i class="flaticon-notes"></i> Edit
                            </a>
                            ${a.delete ? `<button class="dropdown-item btn-del" data-id="${t}" data-table="banner"><i class="flaticon-delete-1"></i> Delete </button>` : ""}
                        </div>
                    `;
                }
            },
            {
                data: "id",
                sClass: "text-center",
                width: 100,
                render: (t, e, a) => {
                    return `<i class="flaticon-arrows"></i>`
                }
            }
        ],
        language: {
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending"
            },
            loadingRecords: 'Loading ... ',
            processing: '<div class="m-loader m-loader--brand"></div>',
            emptyTable: "Data Banner tidak tersedia",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Data tidak ditemukan",
            infoFiltered: "(Terfilter _TOTAL_ data dari _MAX_ total data)",
            lengthMenu: "_MENU_ data",
            search: "Cari:",
            zeroRecords: "Tidak ada data yang cocok"
        },

        buttons: [
            {
                extend: 'print',
                className: 'btn m-btn--square  m-btn m-btn--gradient-from-primary m-btn--gradient-to-info btn-export',
                attr: {
                    "data-export": "banner"
                }
            },
            {
                extend: 'copyHtml5',
                className: 'btn m-btn--square  m-btn m-btn--gradient-from-success m-btn--gradient-to-accent btn-export',
                attr: {
                    "data-export": "banner"
                }
            },
            {
                extend: 'excelHtml5',
                className: 'btn m-btn--square  m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning btn-export',
                attr: {
                    "data-export": "banner"
                }
            },
            {
                extend: 'csvHtml5',
                className: 'btn m-btn--square  m-btn m-btn--gradient-from-warning m-btn--gradient-to-danger btn-export',
                attr: {
                    "data-export": "banner"
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn m-btn--square  m-btn m-btn--gradient-from-info m-btn--gradient-to-accent btn-export',
                attr: {
                    "data-export": "banner"
                }
            }
        ],
        order: [
            [0, 'asc']
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"] // change per page values here
        ],
        // set the initial value
        pageLength: 10
    });
    let detnotmerchant = $('#detnotmerchant_2').DataTable({
        dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>", // horizobtal scrollable datatable
        responsive: false,
        ajax: ` ${base_table}detnotmerchant`,
        columns: [
            {
                title: "No",
                data: "no",
                sClass: "text-center",
            },
            {
                title: "Nama",
                data: "nama",
                sClass: "text-center",
            },
            {
                title: "Gambar",
                data: "file",
                sClass: "text-center",
                render: (t, e, a) => {
                    return `<a class="m-link" target="_blank" href="${base_url}uploads/banner/${t}"> <img src="${base_url}uploads/banner/${t}" width="100px"></a>`
                }
            },
            {
                title: "No Telp",
                data: "phone",
                sClass: "text-center",
                render: (t, e, a) => {
                    return t ? t : "Data Kosong"
                }
            },
            {
                title: "Url",
                data: "url",
                sClass: "text-center",
                render: (t, e, a) => {
                    return t ? `<a class="m-link" target="_blank" href="${t}">${t}</a>` : "Data Kosong"
                }
            },
            {
                title: "Koordinat Map",
                data: "lat",
                sClass: "text-center",
                render: (t, e, a) => {
                    return `<a target="_blank" class="m-link" href="https://maps.google.com/maps?q=${t},${a.long}"><i class="flaticon-map-location"></i></a>`
                }
            },
            {
                title: "Konfirmasi",
                data: "confirmation",
                sClass: "text-center",
                render: (t, e, a) => {
                    return t ? `<a href="#" class="m-link btndetailuserbanner" data-id="${a.id}" data-toggle="modal" data-target="#detailuserbanner">Judul : ${t} <br> User : ${numberWithCommas(a.userkonfirmasi)}</a>` : "Tidak ada Konfirmasi"
                }
            },

            {
                title: "Milik",
                data: "dibuat_oleh",
                sClass: "text-center",
            },
            {
                data: "id",
                sClass: "text-center",
                render: (t, e, a) => {
                    $('.btn-data').tooltip();
                    return `
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                    </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="${base_url}banner/edit/${t}" class="dropdown-item" title="Perbarui Data">
                                <i class="flaticon-notes"></i> Edit
                            </a>
                            ${a.delete ? `<button class="dropdown-item btn-del" data-id="${t}" data-table="banner"><i class="flaticon-delete-1"></i> Delete </button>` : ""}
                        </div>
                    `;
                }
            },
            {
                data: "id",
                sClass: "text-center",
                width: 100,
                render: (t, e, a) => {
                    return `<i class="flaticon-arrows"></i>`
                }
            }
        ],
        language: {
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending"
            },
            loadingRecords: 'Loading ... ',
            processing: '<div class="m-loader m-loader--brand"></div>',
            emptyTable: "Data Banner tidak tersedia",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Data tidak ditemukan",
            infoFiltered: "(Terfilter _TOTAL_ data dari _MAX_ total data)",
            lengthMenu: "_MENU_ data",
            search: "Cari:",
            zeroRecords: "Tidak ada data yang cocok"
        },

        buttons: [
            {
                extend: 'print',
                className: 'btn m-btn--square  m-btn m-btn--gradient-from-primary m-btn--gradient-to-info btn-export',
                attr: {
                    "data-export": "banner"
                }
            },
            {
                extend: 'copyHtml5',
                className: 'btn m-btn--square  m-btn m-btn--gradient-from-success m-btn--gradient-to-accent btn-export',
                attr: {
                    "data-export": "banner"
                }
            },
            {
                extend: 'excelHtml5',
                className: 'btn m-btn--square  m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning btn-export',
                attr: {
                    "data-export": "banner"
                }
            },
            {
                extend: 'csvHtml5',
                className: 'btn m-btn--square  m-btn m-btn--gradient-from-warning m-btn--gradient-to-danger btn-export',
                attr: {
                    "data-export": "banner"
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn m-btn--square  m-btn m-btn--gradient-from-info m-btn--gradient-to-accent btn-export',
                attr: {
                    "data-export": "banner"
                }
            }
        ],
        order: [
            [0, 'asc']
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"] // change per page values here
        ],
        // set the initial value
        pageLength: 10
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
    // };experiences

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
                                case "kategori_produk":
                                    kategori_produk.reload();
                                    refreshkategori();
                                    break;
                                default:
                                    $('#tbl' + table).KTDatatable().reload();
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
    $(document).on('click', '.toggleuser', function (e) {
        const id = $(this).data('id');
        const status = $(this).data('status');
        const action = $(this).data('action');
        const nama = $(this).data('nama');
        const table = $(this).data('table');

        switch (status) {
            case 1:
                swal.fire({
                    title: `Apakah anda yakin akan meng${!status ? "un" : ""}${action} ${table.charAt(0).toUpperCase() + table.slice(1)} ${nama}?`,
                    text: `Anda bisa meng${status ? "un" : ""}${action} ${table.charAt(0).toUpperCase() + table.slice(1)} ${nama} kembali`,
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
                                status: status,
                                suspend_time: null,
                                table: table
                            },
                            success: res => {
                                swal.fire(
                                    `Sukses! ${table.charAt(0).toUpperCase() + table.slice(1)} ${nama} telah di ${!status ? "un" : ""}${action}`,
                                    '',
                                    'success'
                                );
                                $(`#tbl${table}`).KTDatatable().reload()
                            }
                        })
                    }
                });
                break;
            case 2:
                swal.fire({
                    title: `Apakah anda yakin akan meng${!status ? "un" : ""}${action} ${table.charAt(0).toUpperCase() + table.slice(1)} ${nama}?`,
                    text: `Anda bisa meng${status ? "un" : ""}${action} ${table.charAt(0).toUpperCase() + table.slice(1)} ${nama} kembali`,
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
                                suspend_time: $('#datepicker').val(),
                                table: table
                            },
                            success: res => {
                                swal.fire(
                                    `Sukses! ${table.charAt(0).toUpperCase() + table.slice(1)} ${nama} telah di ${!status ? "un" : ""}${action}`,
                                    '',
                                    'success'
                                );
                                $(`#tbl${table}`).KTDatatable().reload()
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
                        suspend_time: null,
                        table: table
                    },
                    success: res => {
                        swal.fire(
                            `Sukses! ${table.charAt(0).toUpperCase() + table.slice(1)} ${nama} telah di ${!status ? "un" : ""}${action}`,
                            '',
                            'success'
                        );
                        $(`#tbl${table}`).KTDatatable().reload()
                    }
                })

        }


    });
});
