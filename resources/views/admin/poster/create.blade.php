@extends('layouts.adminLayout')
@section('title')
    {{ucwords(__('Poster'))}}
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
                <form method="post" action="{{ route('admin.poster.store') }}"
                      enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.poster.index') }}"
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
                            <div class="col-lg-9 col-xl-9">
                                <div class="fileinputForm">
                                    <label>{{__('image')}}</label>
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
                            <!--end::Group-->

                            <!--begin::Group-->
                            <div class="form-group row">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('Type')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <select
                                        class="form-control form-control-solid form-control-lg"
                                        name="type">
                                        @foreach($type as $one => $key)
                                            <option value="{{$one}}"
                                                    @if(old('type') == $one) selected @endif>{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Group-->

                            <!--begin::Group-->
                            <div class="form-group row">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('Link')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <input
                                        class="form-control form-control-solid form-control-lg"
                                        name="link" type="text"
                                        value="{{ old("link") }}"/>
                                </div>
                            </div>
                            <!--end::Group-->

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
