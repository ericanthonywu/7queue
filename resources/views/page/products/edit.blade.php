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
                            7Queue's Produk </h3>

                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="{{url('/')}}" class="kt-subheader__breadcrumbs-home"><i
                                        class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url('/produk')}}" class="kt-subheader__breadcrumbs-link">
                                Produk </a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url('/produk/tambah')}}" class="kt-subheader__breadcrumbs-link">
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
                                    Form Edit Produk
                                </h3>
                            </div>
                        </div>

                        <!--begin::Form-->
                        <form class="kt-form" data-action="products">
                            <input type="hidden" name="id" value="{{$data['id']}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Nama:</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="nama"
                                                   placeholder="Masukkan Nama Produk" value="{{$data['nama']}}" required>
                                            <span class="form-text text-muted">Masukkan Nama</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Kategori Produk:</label>
                                        <div class="col-lg-6">
                                            <select name="kategori" class="form-control kt-selectpicker" data-live-search="true" title="Mohon pilih kategori produk" required>
                                                @foreach ($kategori as $data_kategori)
                                                    <option value="{{$data_kategori['id']}}" {{$data_kategori['id'] == $data['kategori'] ? "selected" : ""}}>{{$data_kategori['kategori']}}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-muted">Pilih Kategori Produk</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Priview Foto Produk:</label>
                                        <div class="col-lg-6">
                                            <a href="{{url("uploads/products/$data[foto]")}}" target="_blank"><img width="100%" src="{{url("uploads/products/$data[foto]")}}" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Foto Produk:</label>
                                        <div class="col-lg-6">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="foto"
                                                       id="customFile">
                                                <label class="custom-file-label" for="customFile">Masukkan Foto
                                                    Produk</label>
                                            </div>
                                            <span class="form-text text-muted">Masukkan Foto Produk</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Harga:</label>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">Rp. </span>
                                                </div>
                                                <input type="text" class="form-control number ribuan"
                                                       data-selector="#harga" placeholder="Masukkan Harga Produk"
                                                       required value="{{number_format($data['harga'])}}">
                                            </div>
                                            <input type="hidden" name="harga" id="harga" value="{{$data['harga']}}">
                                            <span class="form-text text-muted">Masukkan Harga Produk</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Deskripsi:</label>
                                        <div class="col-lg-6">
                                            <textarea type="text" class="form-control" name="description" placeholder="Masukkan Deskripsi Produk" required>{{$data['description']}}</textarea>
                                            <span class="form-text text-muted">Masukkan Deskripsi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <input type="submit" class="btn btn-success" value="Edit">
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