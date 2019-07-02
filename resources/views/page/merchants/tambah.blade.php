<!DOCTYPE html>

<html lang="en">

<!-- begin::Head -->
@include("theme.head");

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
@include('theme.header_mobile')

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Aside -->
    @include('theme.leftaside')

    <!-- end:: Aside -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin:: Header -->
        @include('theme.header')

        <!-- end:: Header -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

                <!-- begin:: Content Head -->
                <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                    <div class="kt-subheader__main">

                        <h3 class="kt-subheader__title">
                           7Queue's Merchants </h3>

                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="{{url('/')}}" class="kt-subheader__breadcrumbs-home"><i
                                        class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url('/merchants')}}" class="kt-subheader__breadcrumbs-link">
                                Merchants </a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{Request::url()}}" class="kt-subheader__breadcrumbs-link">
                                Tambah </a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                        </div>

                    </div>
                </div>

                <!-- end:: Content Head -->

                <!-- begin:: Content -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">


                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Form Tambah Merchants
                                </h3>
                            </div>
                        </div>

                        <!--begin::Form-->
                        <form class="kt-form" data-action="merchants">
                            <input type="hidden" value="0" name="status">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Nickname:</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="nickname" placeholder="Masukkan Nickname Merchants" required>
                                            <span class="form-text text-muted">Masukkan Nickname</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Email:</label>
                                        <div class="col-lg-6">
                                            <input type="email" aria-describedby="emailHelp" class="form-control" name="email" placeholder="Masukkan Email Merchants" required>
                                            <span class="form-text text-muted">Masukkan Email</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Foto:</label>
                                        <div class="col-lg-6">
                                            <div class="custom-file">
                                                <input type="file" name="foto" class="custom-file-input" id="customFile" required>
                                                <label class="custom-file-label" for="customFile">Pilih Foto Merchant</label>
                                            </div>
                                            <span class="form-text text-muted">Masukkan Foto Merchant</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Lokasi Merchants:</label>
                                        <div class="col-lg-6">
                                            <input type="hidden" name="lat" id="lat">
                                            <input type="hidden" name="long" id="long">
                                            <div class="input-group-append">
                                                <input type="text" name="lokasi" class="form-control" id="search_map"
                                                       placeholder="address...">
                                                <button type="button" class="btn btn-primary" id="btn_search_map"><i
                                                            class="fa fa-search"></i></button>
                                            </div>
                                            <div id="gmaps" style="height: 500px;width: 500px"></div>
                                            <span class="form-text text-muted">Pilih Lokasi Merchants</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Password:</label>
                                        <div class="col-lg-6">
                                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password Merchants" required>
                                            <span class="form-text text-muted">Masukkan Password</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <input type="submit" class="btn btn-success" value="Submit">
                                            <button type="reset" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--end::Form-->
                    </div>
                </div>

                <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
        @include("theme.footer")

        <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Quick Panel -->
@include("theme.quickpanel")

<!-- end::Quick Panel -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->

<!--Begin:: Chat-->
@include("theme.chat")

<!--ENd:: Chat-->

@include("theme.script")

<script src="//maps.google.com/maps/api/js?key=AIzaSyAA4hPyKk1JroIrhLwPiFyz0kX-w7ll8pU" type="text/javascript"></script>
<script src="{{asset('assets/vendors/custom/gmaps/gmaps.js')}}"></script>
<script>
    const maps = new GMaps({
        div: '#gmaps',
        lat: -6.1826977,
        lng: 106.7883846,
    });
    const handleAction = () => {
        const text = $.trim($('#search_map').val());
        GMaps.geocode({
            address: text,
            callback: (results, status) => {
                if (status == 'OK') {
                    const latlng = results[0].geometry.location;
                    $('#lat').val(latlng.lat())
                    $('#long').val(latlng.lng())
                    maps.setCenter(latlng.lat(), latlng.lng());
                    maps.removeMarkers();
                    maps.addMarker({
                        lat: latlng.lat(),
                        lng: latlng.lng(),
                        title: 'Tempat Merchant',

                        draggable: true,

                        dragend: e => {
                            $('#lat').val(e.latLng.lat())
                            $('#long').val(e.latLng.lng())
                        },

                        infoWindow: {
                            content: '<span style="color:#000">Tempat Merchants</span>'
                        }
                    });
                    mUtil.scrollTo('gmaps');
                }else{
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
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
                    toastr.error('alamat tidak ditemukan','Error')
                }
            }
        });
    }

    $('#btn_search_map').click(function (e) {
        e.preventDefault();
        handleAction();
    });

    $("#search_map").keypress(function (e) {
        const keycode = (e.keyCode || e.which);
        if (keycode == '13') {
            e.preventDefault();
            handleAction();
        }
    });

    // maps.addMarker({
    //     lat: -6.1826977,
    //     lng: 106.7883846,

    // });
    // maps.setZoom(15);
</script>
</body>

<!-- end::Body -->
</html>