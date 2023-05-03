@extends('layouts.adminLayout')
@section('title')
    {{ucwords(__('Contest'))}}
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
                        <h6> {{__('Show')}} /{{ $usercontest->user->first_name}}</h6>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{ route('admin.participants.contest'  , $usercontest->contest->id) }}" class="btn btn-success ">{{__('Cancel')}}</a>
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
                                    class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center symbol symbol-35 symbol-light-success">
                                    <div
                                        class="symbol-label font-size-h5 font-weight-bold">{{mb_substr($usercontest->user->first_name,0,1,'utf-8')}}</div>
                                    <!--<i class="symbol-badge bg-success"></i>-->
                                </div>
                                <div>
                                    <a href="#"
                                       class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{$usercontest->user->first_name ,$usercontest->user->last_name}}</a>
                                    <div class="text-muted"><span id="label-{{$usercontest->user->id}}" class="badge badge-pill badge-{{($usercontest->user->status == "active")
															? "info" : "danger"}}" id="label-{{$usercontest->user->id}}">
															{{__($usercontest->user->status)}}
														</span></div>
                                </div>
                            </div>
                            <!--end::User-->
                            <!--begin::Contact-->
                            <div class="py-9">
                                <div class="d-flex align-items-center  mb-2">
                                  <img  width="150px" height="150px" src="{{asset($usercontest->user->image)}}">
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{__('Full Name')}}:</span>
                                    <span class="text-muted">{{$usercontest->user->first_name .' '.$usercontest->user->last_name}}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{__('Phone')}}:</span>
                                    <span class="text-muted">{{$usercontest->user->phone}}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">{{__('Email')}}:</span>
                                    <a class="text-muted text-hover-primary">{{$usercontest->user->email}}</a>
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



