@extends('layouts.adminLayout')
@section('title')
    {{ucwords(__('Settings'))}}
@endsection
@section('css')

    <style>
        a:link {
            text-decoration: none;
        }
        #map-canvas {
            width: 800px;
            height: 550px;

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
                        <h3>{{__('Update')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <button id="submitButton" class="btn btn-success ">{{__('Save')}}</button>
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <form class="form" method="post" action="{{route('admin.setting.store')}}"
                          id="form" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="card-header">
                            <h3 class="card-title">{{__('main information')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Email')}}</label>
                                        <input type="email" class="form-control form-control-solid"
                                               name="email" value="{{$setting->email ?? ''}}" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Phone')}}</label>
                                        <input type="text" class="form-control form-control-solid"
                                               name="mobile" value="{{$setting->mobile ?? ''}}" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('facebook')}}</label>
                                        <input type="url" class="form-control form-control-solid"
                                               name="facebook" value="{{$setting->facebook ?? ''}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('twitter')}}</label>
                                        <input type="url" class="form-control form-control-solid"
                                               name="twitter" value="{{$setting->twitter ?? ''}}" required/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('instagram')}}</label>
                                        <input type="url" class="form-control form-control-solid"
                                               name="instagram" value="{{$setting->instagram ?? ''}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('youTube')}}</label>
                                        <input type="url" class="form-control form-control-solid"
                                               name="youTube" value="{{$setting->youTube ?? ''}}" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('TOTAL CLIENTS')}}</label>
                                        <input type="number" class="form-control form-control-solid"
                                               name="count_total_client" min="0"
                                               value="{{$setting->count_total_client ?? ''}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('PROJECT COMPLETE')}}</label>
                                        <input type="number" class="form-control form-control-solid"
                                               name="count_project_complete" min="0"
                                               value="{{$setting->count_project_complete ?? ''}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('ACTIVE EMPLOYEE')}}</label>
                                        <input type="number" class="form-control form-control-solid"
                                               name="count_active_employee" min="0"
                                               value="{{$setting->count_active_employee ?? ''}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('AVG. RATING')}}</label>
                                        <input type="number" class="form-control form-control-solid"
                                               name="count_avg_rating" min="0"
                                               value="{{$setting->count_avg_rating ?? ''}}"
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('weekly product')}}</label>
                                    <select
                                        class="form-control form-control-solid form-control-lg"
                                        name="product_id">
                                        @foreach($product as $one )
                                            <option value="{{$one->id}}"
                                                    @if($setting->product_id == $one->id) selected @endif>{{$one->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            @foreach (config('app.languages') as $key => $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if ($loop->index == 0) show active in @endif"
                                       id="home-tab" data-toggle="tab"
                                       href="#{{ $key }}" role="tab"
                                       aria-controls="home"
                                       aria-selected="true">{{ $lang }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @foreach (config('app.languages') as $key => $lang)
                                <br>
                                <div
                                    class="tab-pane mt-3 fade @if ($loop->index == 0) show active in @endif"
                                    id="{{ $key }}" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="row">
                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('Our Logo')}} <span style="color:#fc2a2a;">{{$lang}}</span> </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[text_ourLogo]" type="text"
                                                    value="{{$setting->translate($key)->text_ourLogo ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('Social Media')}} <span style="color:#fc2a2a;">{{$lang}}</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[text_socialMedia]" type="text"
                                                    value="{{ $setting->translate($key)->text_socialMedia ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('footer text')}}  <span style="color:#fc2a2a;">{{$lang}}</span> </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[text_footer]" type="text"
                                                    value="{{ $setting->translate($key)->text_footer ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('About Us')}} <span style="color:#fc2a2a;">{{$lang}}</span> </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[about_description1]" type="text"
                                                    value="{{ $setting->translate($key)->about_description1 ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('We Provide you')}} <span style="color:#fc2a2a;">{{$lang}}</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[provide_description1]" type="text"
                                                    value="{{ $setting->translate($key)->provide_description1 ?? "" }}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('service title')}} 1  <span style="color:#fc2a2a;">{{$lang}}</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[service_title1]" type="text"
                                                    value="{{ $setting->translate($key)->service_title1 ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('service title')}} 2 <span style="color:#fc2a2a;">{{$lang}}</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[service_title2]" type="text"
                                                    value="{{ $setting->translate($key)->service_title2 ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('service title')}} 3 <span style="color:#fc2a2a;">{{$lang}}</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[service_title3]" type="text"
                                                    value="{{ $setting->translate($key)->service_title3 ?? "" }}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('service description')}}1 <span style="color:#fc2a2a;">{{$lang}}</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[service_description1]" type="text"
                                                    value="{{ $setting->translate($key)->service_description1 ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('service description')}} 2  <span style="color:#fc2a2a;">{{$lang}}</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[service_description2]" type="text"
                                                    value="{{ $setting->translate($key)->service_description2  ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('service description')}}3 <span style="color:#fc2a2a;">{{$lang}}</span> </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[service_description3]" type="text"
                                                    value="{{ $setting->translate($key)->service_description3 ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('Privacy Policy')}} <span style="color:#fc2a2a;">{{$lang}}</span>  </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[privacyPolicy_text]" type="text"
                                                    value="{{ $setting->translate($key)->privacyPolicy_text ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="col-md-6">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('Terms of Use')}} <span style="color:#fc2a2a;">{{$lang}}</span> </label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[terms_condition]" type="text"
                                                    value="{{ $setting->translate($key)->terms_condition ?? ""}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                    </div>
                                    {{--                                        <!--begin::Group-->--}}
                                    {{--                                        <div class="col-md-12">--}}
                                    {{--                                            <label--}}
                                    {{--                                                class="col-xl-3 col-lg-3 col-form-label">{{__('Description')}} {{$key}}--}}
                                    {{--                                            </label>--}}
                                    {{--                                            <div class="col-lg-9 col-xl-9">--}}

                                    {{--                                                <textarea name="{{$key}}[description]"--}}
                                    {{--                                                          class="summernote form-control"--}}
                                    {{--                                                          id="kt_summernote_1">{{"" ?? $setting->translate($key)->description }}</textarea>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <!--end::Group-->--}}
                                </div>

                            @endforeach
                        </div>


                </div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="fileinputForm">
                                <label>{{__('Primary Logo')}}</label>
                                <div class="fileinput-new thumbnail"
                                     onclick="document.getElementById('edit_image2').click()"
                                     style="cursor:pointer">
                                    <img src="{{asset($setting->primaryLogo) ?? ''}}" id="editImage2">
                                </div>
                                <div class="btn btn-change-img red"
                                     onclick="document.getElementById('edit_image2').click()">
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                                <input type="file" class="form-control" name="primaryLogo"
                                       id="edit_image2"
                                       style="display:none">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="fileinputForm">
                                <label>{{__('Secondary Logo')}}</label>
                                <div class="fileinput-new thumbnail"
                                     onclick="document.getElementById('edit_image3').click()"
                                     style="cursor:pointer">
                                    <img src="{{asset($setting->secondaryLogo )?? ''}}" id="editImage3">
                                </div>
                                <div class="btn btn-change-img red"
                                     onclick="document.getElementById('edit_image3').click()">
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                                <input type="file" class="form-control" name="secondaryLogo"
                                       id="edit_image3"
                                       style="display:none">
                            </div>
                        </div>

                    </div>

                </div>
                <hr>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('service image')}} 1</label>
                                <input type="file" class="form-control form-control-solid"
                                       name="service_image1" value="{{$setting->service_image1 ?? ''}}"
                                       required/>
                                <img src="{{asset($setting->service_image1)}}" width="100px" height="100px">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('service image')}} 2</label>
                                <input type="file" class="form-control form-control-solid"
                                       name="service_image2" value="{{$setting->service_image2 ?? ''}}"
                                       required/>
                                <img src="{{asset($setting->service_image2)}}" width="100px" height="100px">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('service image')}} 3</label>
                                <input type="file" class="form-control form-control-solid"
                                       name="service_image3" value="{{$setting->service_image3 ?? ''}}"
                                       required/>
                                <img src="{{asset($setting->service_image3)}}" width="100px" height="100px">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('fav icon')}}</label>
                                <input type="file" class="form-control form-control-solid"
                                       name="fav_icon" value="{{$setting->fav_icon ?? ''}}" required/>
                                <img src="{{asset($setting->fav_icon)}}" width="100px" height="100px">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('image background')}}</label>
                                <input type="file" class="form-control form-control-solid"
                                       name="image_web_all" value="{{$setting->image_web_all ?? ''}}" required/>
                                <img src="{{asset($setting->image_web_all)}}" width="100px" height="100px">
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card-->
                <button type="submit" id="submitForm" style="display:none"></button>
                </form>

                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>
    </div>
    </div>

@endsection
@section('js')

    <script>
        $('#edit_image2').on('change', function (e) {
            readURL(this, $('#editImage2'));
        });
        $('#edit_image3').on('change', function (e) {
            readURL(this, $('#editImage3'));
        });
    </script>
@endsection

@section('script')

@endsection
