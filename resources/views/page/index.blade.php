<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 7
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
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
{{--                <div class="kt-subheader   kt-grid__item" id="kt_subheader">--}}
{{--                    <div class="kt-subheader__main">--}}
{{--                        <h3 class="kt-subheader__title">Dashboard</h3>--}}
{{--                        <span class="kt-subheader__separator kt-subheader__separator--v"></span>--}}
{{--                        <span class="kt-subheader__desc">Graph</span>--}}
{{--                        <a href="#" class="btn btn-label-warning btn-bold btn-sm btn-icon-h kt-margin-l-10">--}}
{{--                            Add New--}}
{{--                        </a>--}}
{{--                        <div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">--}}
{{--                            <input type="text" class="form-control" placeholder="Search order..." id="generalSearch">--}}
{{--                            <span class="kt-input-icon__icon kt-input-icon__icon--right">--}}
{{--										<span><i class="flaticon2-search-1"></i></span>--}}
{{--									</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="kt-subheader__toolbar">--}}
{{--                        <div class="kt-subheader__wrapper">--}}
{{--                            <a href="#" class="btn kt-subheader__btn-secondary">Today</a>--}}
{{--                            <a href="#" class="btn kt-subheader__btn-secondary">Month</a>--}}
{{--                            <a href="#" class="btn kt-subheader__btn-secondary">Year</a>--}}
{{--                            <a href="#" class="btn kt-subheader__btn-primary">--}}
{{--                                Actions &nbsp;--}}

{{--                                <!--<i class="flaticon2-calendar-1"></i>-->--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">--}}
{{--                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                        <rect id="bound" x="0" y="0" width="24" height="24" />--}}
{{--                                        <rect id="Rectangle-8" fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />--}}
{{--                                        <path d="M7.5,11 L16.5,11 C17.3284271,11 18,11.6715729 18,12.5 C18,13.3284271 17.3284271,14 16.5,14 L7.5,14 C6.67157288,14 6,13.3284271 6,12.5 C6,11.6715729 6.67157288,11 7.5,11 Z M10.5,17 L13.5,17 C14.3284271,17 15,17.6715729 15,18.5 C15,19.3284271 14.3284271,20 13.5,20 L10.5,20 C9.67157288,20 9,19.3284271 9,18.5 C9,17.6715729 9.67157288,17 10.5,17 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />--}}
{{--                                    </g>--}}
{{--                                </svg> </a>--}}
{{--                            <div class="dropdown dropdown-inline" data-toggle-="kt-tooltip" title="Quick actions" data-placement="left">--}}
{{--                                <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">--}}
{{--                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24" />--}}
{{--                                            <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3" />--}}
{{--                                            <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" id="Combined-Shape" fill="#000000" />--}}
{{--                                        </g>--}}
{{--                                    </svg>--}}

{{--                                    <!--<i class="flaticon2-plus"></i>-->--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">--}}

{{--                                    <!--begin::Nav-->--}}
{{--                                    <ul class="kt-nav">--}}
{{--                                        <li class="kt-nav__head">--}}
{{--                                            Add anything or jump to:--}}
{{--                                            <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>--}}
{{--                                        </li>--}}
{{--                                        <li class="kt-nav__separator"></li>--}}
{{--                                        <li class="kt-nav__item">--}}
{{--                                            <a href="#" class="kt-nav__link">--}}
{{--                                                <i class="kt-nav__link-icon flaticon2-drop"></i>--}}
{{--                                                <span class="kt-nav__link-text">Order</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="kt-nav__item">--}}
{{--                                            <a href="#" class="kt-nav__link">--}}
{{--                                                <i class="kt-nav__link-icon flaticon2-calendar-8"></i>--}}
{{--                                                <span class="kt-nav__link-text">Ticket</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="kt-nav__item">--}}
{{--                                            <a href="#" class="kt-nav__link">--}}
{{--                                                <i class="kt-nav__link-icon flaticon2-link"></i>--}}
{{--                                                <span class="kt-nav__link-text">Goal</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="kt-nav__item">--}}
{{--                                            <a href="#" class="kt-nav__link">--}}
{{--                                                <i class="kt-nav__link-icon flaticon2-new-email"></i>--}}
{{--                                                <span class="kt-nav__link-text">Support Case</span>--}}
{{--                                                <span class="kt-nav__link-badge">--}}
{{--															<span class="kt-badge kt-badge--brand kt-badge--rounded">5</span>--}}
{{--														</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="kt-nav__separator"></li>--}}
{{--                                        <li class="kt-nav__foot">--}}
{{--                                            <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>--}}
{{--                                            <a class="btn btn-clean btn-bold btn-sm kt-hidden" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}

{{--                                    <!--end::Nav-->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <!-- end:: Content Head -->

                <!-- begin:: Content -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

                    <!--Begin::Dashboard 1-->

                    <!--Begin::Section-->
                    <div class="row">
                        <div class="col-xl-4">

                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Piechart
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">

                                    <!--Begin::Timeline 3 -->
                                    <div id="piechart" style="height: 500px;"></div>

                                    <!--End::Timeline 3 -->
                                </div>
                            </div>

                            <!--begin:: Widgets/Activity-->


                            <!--end:: Widgets/Activity-->
                        </div>
                        <div class="col-xl-4">

                            <!--begin:: Widgets/Inbound Bandwidth-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Bar Chart 1
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">

                                    <!--Begin::Timeline 3 -->
                                    <div id="barchart" style="width: 100%;height:100vh"></div>

                                    <!--End::Timeline 3 -->
                                </div>
                            </div>

                            <!--end:: Widgets/Outbound Bandwidth-->
                        </div>
                        <div class="col-xl-4">

                            <!--Begin::Portlet-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Bar Chart 2
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">

                                    <!--Begin::Timeline 3 -->
                                    <div id="barchart2" style="width: 100%;height:100vh"></div>

                                    <!--End::Timeline 3 -->
                                </div>
                            </div>


                            <!--End::Portlet-->
                        </div>
                    </div>

                    <!--End::Section-->

                    <!--Begin::Section-->

                    <!--End::Section-->

                    <!--End::Dashboard 1-->
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

@include("theme.script")
<script src="{{asset('amcharts4/deps/pdfmake.js')}}"></script>
<script src="{{asset('amcharts4/core.js')}}"></script>
<script src="{{asset('amcharts4/charts.js')}}"></script>
<script src="{{asset('amcharts4/themes/animated.js')}}"></script>
<script src="{{asset('js/chart.js')}}"></script>
</body>

<!-- end::Body -->
</html>