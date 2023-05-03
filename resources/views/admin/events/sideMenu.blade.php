@extends('layouts.adminLayout')
@section('title')
    {{ucwords(__('Events'))}}
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
                        <h6> {{__('Show')}} /{{$event->type}}</h6>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{ route('admin.event.index') }}" class="btn btn-success ">{{__('Cancel')}}</a>
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
                                    {{--                                     style="background-image:url('{{$event->image}}')"></div>--}}
                                    <!--<i class="symbol-badge bg-success"></i>-->
                                </div>
                                <div>

                                    {{--                                <div class="text-muted"><span>--}}
                                    {{--															@php $char=substr($event->full_name , 0 ,1);  @endphp--}}
                                    {{--                                        {{$char}}--}}
                                    {{--														</span></div>--}}

                                </div>
                            </div>
                            <!--end::User-->
                            <!--begin::Contact-->
                            <div class="py-9">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <img src="{{ asset('uploads/events/'.$event->image) }}" height="200px" width="200px">
                                </div>
                                <hr>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-6" style="color: #ff9900" >{{__('Title')}}:</span><br>
                                    <span class="text-dark" style="color: black">{{$event->title}}</span>
                                </div>       <hr>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-4" style="color: #ff9900">{{__('Description')}}:</span><br>
                                    <span class="text-muted ">{!! $event->description!!}</span>
                                </div>

                            </div>
                            <!--end::Contact-->
                            <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                                <div class="navi-item mb-2">
                                    <a href="#" class="navi-link py-4 action_click" data-req="home">
															<span class="navi-icon mr-2">
																<span class="svg-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg"
                                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                             width="24px" height="24px"
                                                                             viewBox="0 0 24 24"
                                                                             version="1.1">
																		<g stroke="none" stroke-width="1" fill="none"
                                                                           fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24"/>
																			<path
                                                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                                                fill="#000000" fill-rule="nonzero"
                                                                                opacity="0.3"/>
																			<path
                                                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                                                fill="#000000" fill-rule="nonzero"/>
																		</g>
																	</svg>
                                                                    <!--end::Svg Icon-->
																</span>
															</span>
                                        <span class="navi-text font-size-lg">{{__('Home')}}</span>
                                    </a>
                                </div>
                                <div class="navi-item mb-2">
                                    <a href="#" class="navi-link py-4 action_click" data-req="image">
															<span class="navi-icon mr-2">
																<span class="svg-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg"
                                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                             width="24px" height="24px"
                                                                             viewBox="0 0 24 24"
                                                                             version="1.1">
																		<g stroke="none" stroke-width="1" fill="none"
                                                                           fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24"/>
																			<path
                                                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                                                fill="#000000" fill-rule="nonzero"
                                                                                opacity="0.3"/>
																			<path
                                                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                                                fill="#000000" fill-rule="nonzero"/>
																		</g>
																	</svg>
                                                                    <!--end::Svg Icon-->
																</span>
															</span>
                                        <span class="navi-text font-size-lg">{{__('Images')}}</span>
                                    </a>
                                </div>
                            </div>
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


@section('js')
    <script>
        $( document ).ready(function() {
            var mvar = $('.action_click')[0];
            mvar.click();
        });
        $(document).on('click', '.action_click', function (e) {
            e.preventDefault();
            var elem = $(this);
            var req = $(this).data('req');

            $('.item_box').html('<div class="spinner-border text-success margin-100" role="status"> <span class="sr-only">Loading...</span> </div>');

            $.ajax({
                type: 'get',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                //'/getItems/{req}/{event_id}'
                url: "{{url('admin/getItem')}}"+ "/" + req + "/" + {{$event->id}},
                success: function (response) {
                    $('.item_box').html(response.items);
                    if ($(document).height() > 1500) {
                        window.scrollTo({top: 0, behavior: 'smooth'});
                    }
                },
                error: function (jqXHR, error, errorThrown) {
                    $('.item_box').html(errorBox);
                }
            });

        });
    </script>
@endsection


