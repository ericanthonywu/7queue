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
                            7Queue's Message </h3>

                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="{{url('/')}}" class="kt-subheader__breadcrumbs-home"><i
                                        class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url('/banner')}}" class="kt-subheader__breadcrumbs-link">
                                Message </a>
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
                                    Form Tambah Message
                                </h3>
                            </div>
                        </div>

                        <!--begin::Form-->
                        <form class="kt-form" data-action="banner">
                            <input type="hidden" value="{{$data['id']}}" name="id">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Nama Message :</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" value="{{$data['nama']}}"
                                                   name="nama" placeholder="Masukkan Nama Message" required>
                                            <span class="form-text text-muted">Masukkan Nama Message</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Preview Gambar:</label>
                                        <div class="col-lg-6">
                                            <a href="{{asset("uploads/banner/$data[file]")}}" target="_blank"><img
                                                        src="{{asset("uploads/banner/$data[file]")}}" width="100%"
                                                        alt=""></a>
                                            <span class="form-text text-muted">Preview Gambar Message</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Gambar:</label>
                                        <div class="col-lg-6">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input" id="customFile"
                                                       required>
                                                <label class="custom-file-label" for="customFile">Pilih Gambar
                                                    Message</label>
                                            </div>
                                            <span class="form-text text-muted">Masukkan Gambar Message</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Url :</label>
                                        <div class="col-lg-6">
                                            <input type="url" class="form-control" value="{{$data['url']}}" name="url"
                                                   placeholder="Masukkan Url Message">
                                            <span class="form-text text-muted">Masukkan Url Message</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">No Telp :</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" value="{{$data['phone']}}"
                                                   name="phone" placeholder="Masukkan No Telp">
                                            <span class="form-text text-muted">Masukkan No Telp</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Lokasi Message:</label>
                                        <div class="col-lg-6">
                                            <input type="hidden" name="lat" value="{{$data['lat']}}" id="lat">
                                            <input type="hidden" name="long" id="long" value="{{$data['long']}}">
                                            <div class="input-group-append">
                                                <input type="text" class="form-control" id="search_map"
                                                       placeholder="address...">
                                                <button type="button" class="btn btn-primary" id="btn_search_map"><i
                                                            class="fa fa-search"></i></button>
                                            </div>
                                            <div id="gmaps" style="height: 500px;width: 500px"></div>
                                            <span class="form-text text-muted">Pilih Lokasi Message</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Show Confirmation banner : </label>
                                        <div class="col-lg-6">
                                            <span class="kt-switch kt-switch--icon">
                                                <label>
                                                    <input type="checkbox" id="togglekonf" {{empty($data['confirmation']) ?"": "checked"}}>
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row"
                                         id="showconf" {{empty($data['confirmation']) ?"style=display:none": '' }}>
                                        <label class="col-lg-3 col-form-label"> Confirmation Message :</label>
                                        <div class="col-lg-6">
                                            <textarea type="url" class="form-control" name="confirmation"
                                                      placeholder="Masukkan Isi Konfirmasi Message">{{$data['confirmation']}}</textarea>
                                            <span class="form-text text-muted">Masukkan Isi Konfirmasi Message</span>
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

</body>

<!-- end::Body -->
</html>