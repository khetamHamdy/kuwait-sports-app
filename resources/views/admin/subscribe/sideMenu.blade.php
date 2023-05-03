@extends('layouts.adminLayout')
@section('title') {{ucwords(__('subscribe'))}}
@endsection
@section('css')

    <style>
        a:link {
            text-decoration: none;
        }
    </style>

@endsection
@section('content')
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
                                class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center symbol symbol-35 symbol-light-success">
                                <div
                                    class="symbol-label font-size-h5 font-weight-bold">{{mb_substr($subscribe->sender_name,0,1,'utf-8')}}</div>
                                <!--<i class="symbol-badge bg-success"></i>-->
                            </div>                            <div>
                                <a href="#"
                                   class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{$subscribe->sender_name}}</a>
                                <div class="text-muted"><span id="label-{{$subscribe->id}}" class="badge badge-pill badge-{{($subscribe->status == "active")
															? "info" : "danger"}}" id="label-{{$subscribe->id}}">
															{{__(''.$subscribe->status)}}
														</span></div>
                            </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->
                        <div class="py-9">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">{{__('email')}}:</span>
                                <a class="text-muted text-hover-primary">{{$subscribe->email}}</a>
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


@endsection
