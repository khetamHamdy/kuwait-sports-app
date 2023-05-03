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
                        <h3>{{__('Add')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <form method="post" action="{{ route('admin.contest.store') }}"
                      enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.contest.index') }}"
                           class="btn btn-secondary mr-2"> {{__('Cancel')}} </a>
                        <button id="submitButton" class="btn btn-success"
                                style="background-color:#ff4500 ;color: #ffffff; border: 0">{{__('Save')}}</button>
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

                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">{{__('main information')}}</h3>
                    </div>
                    <div class="row col-sm-12">

                        <div class="card-body">

                            <!--begin::Group-->
                            <div class="form-group row">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('Status')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <select
                                        class="form-control form-control-solid form-control-lg"
                                        name="status">
                                        @foreach($status as $one => $key)
                                            <option value="{{$one}}"
                                                    @if(old('status') == $one) selected @endif>{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Group-->

                            <!--begin::Group-->
                            <div class="form-group row">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('video')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="file" class="form-control form-control-solid form-control-lg" name="video" value="{{old('video')}}">
                                </div>
                            </div>
                            <!--end::Group-->

                            <!--begin::Group-->
                            <div class="form-group row">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('image')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <div class="fileinputForm">
                                        <label>{{__('contest')}}</label>
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image3').click()"
                                             style="cursor:pointer">
                                            <img src="" id="editImage3">
                                        </div>
                                        <div class="btn btn-change-img red"
                                             onclick="document.getElementById('edit_image3').click()">
                                            <i class="fas fa-pencil-alt"></i>
                                        </div>
                                        <input type="file" class="form-control" name="image"
                                               id="edit_image3" value="{{old('image')}}"
                                               style="display:none">
                                    </div>
                                </div>
                            </div>
                            <!--end::Group-->
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
                                    <div
                                        class="tab-pane mt-3 fade @if ($loop->index == 0) show active in @endif"
                                        id="{{ $key }}" role="tabpanel"
                                        aria-labelledby="home-tab">

                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('Description')}} {{$key}}
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                         <textarea name="{{$key}}[description]"
                                                   class="summernote form-control"
                                                   id="kt_summernote_1">{{ old("$key.description") }}</textarea>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                    </div>

                                @endforeach
                            </div>
                        </div>

                    </div>
                    <button type="submit" id="submitForm" style="display:none"></button>
                    </form>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
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
