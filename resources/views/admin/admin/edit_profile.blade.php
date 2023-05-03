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
                        <h3>{{__('edit profile')}}</h3>
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
                    <form method="post" action="{{ route('admin.updateProfile') }}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        @csrf

                        <div class="card-header">
                            <h3 class="card-title">{{__('main information')}}</h3>
                        </div>

                        <div class="row col-sm-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('Full Name')}}</label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="name" value="{{old('name',$item->name) }}" required/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('Email')}}</label>
                                    <input type="email" class="form-control form-control-solid" name="email"
                                           value="{{old('email',$item->email) }}" required/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('Phone')}}</label>
                                    <input
                                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"

                                        type="text" class="form-control form-control-solid" name="mobile"
                                        value="{{old('mobile',$item->mobile) }}" required/>
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
