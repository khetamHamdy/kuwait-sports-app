@extends('layouts.adminLayout')
@section('title')
    {{ucwords(__('admins'))}}
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
                        <h3>{{__('admins')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{route('admin.home')}}" class="btn btn-secondary  mr-2">{{__('Cancel')}}</a>
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
                    <form method="post" action="{{ route('admin.updateMyPassword') }}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">{{__('edit password')}}</h3>
                            <br>
                        </div>


                        <div class="row col-sm-12">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('password')}}</label>
                                    <input type="text" class="form-control form-control-solid" name="password"
                                           value="{{ old('password') }}"
                                           placeholder="{{__('password')}} " required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('confirm password')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="confirm_password"
                                           value="{{ old('confirm_password') }}"
                                           placeholder="{{__('confirm password')}} " required>
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
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        $('#edit_image1').on('change', function (e) {
            readURL(this, $('#editImage1'));
        });
        $(document).on('click', '#submitButton', function () {
            // $('#submitButton').addClass('spinner spinner-white spinner-left');
            $('#submitForm').click();
        });
    </script>

@endsection

@section('script')

@endsection
