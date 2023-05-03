@extends('layouts.adminLayout')
@section('title')
    {{ucwords(__('Product'))}}
@endsection
@section('css')

    <style>
        a:link {
            text-decoration: none;
        }
    </style>

@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline mr-5">
                        <h6> {{__('Show')}} /{{$product->type}}</h6>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-success ">{{__('Cancel')}}</a>
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <div class="container">
            <!--begin::Profile Overview-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                    <!--begin::Profile Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body pt-4">

                            <div class="d-flex align-items-center">
                                <div
                                    class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                    {{--                                <div class="symbol-label"--}}
                                    {{--                                     style="background-image:url('{{$product->image}}')"></div>--}}
                                    <!--<i class="symbol-badge bg-success"></i>-->
                                </div>
                                <div>

                                    {{--                                <div class="text-muted"><span>--}}
                                    {{--															@php $char=substr($product->full_name , 0 ,1);  @endphp--}}
                                    {{--                                        {{$char}}--}}
                                    {{--														</span></div>--}}

                                </div>
                            </div>
                            <!--end::User-->
                            <!--begin::Contact-->
                            <div class="py-9">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <img src="{{asset($product->image)}}" height="200px" width="200px">
                                </div>
                                <hr>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-6" style="color: #ff9900" >{{__('Title')}}:</span><br>
                                    <span class="text-dark" style="color: black">{{$product->title}}</span>
                                </div>       <hr>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-4" style="color: #ff9900">{{__('Description')}}:</span><br>
                                    <span class="text-muted ">{!! $product->description!!}</span>
                                </div>

                            </div>
                            <!--end::Contact-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Profile Card-->
                </div>
                <!--end::Aside-->
                <!--begin::Content-->


                @yield('companyContent')

                <!--end::Content-->
            </div>
            <!--end::Profile Overview-->
        </div>
    </div>
@endsection



