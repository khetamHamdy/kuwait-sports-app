@extends('layouts.adminLayout')
@section('title') {{ucwords(__('Permissions'))}}
@endsection
@section('css')
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
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{route('admin.permission.index')}}" class="btn btn-secondary  mr-2">{{__('Cancel')}}</a>
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
                    <form method="post" action="{{route('admin.permission.store')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                        {{ csrf_field() }}
                        <div class="card-header">
                            <h3 class="card-title">{{__('main information')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach (config('app.languages') as $key => $lang)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('name')}} <span class="text-danger"> {{$lang}} </span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                   {{($key == 'ar') ? 'dir=rtl' :'' }}  name="name_{{$key}}" value="{{old('name_'.$key)}}" required />
                                        </div>
                                    </div>
                                @endforeach
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">{{__('Show')}}</label>
                                    <div >
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox" checked name="show"/>
                                            <span></span>
                                        </label>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">{{__('create')}}</label>
                                    <div >
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox" checked name="create"/>
                                            <span></span>
                                        </label>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">{{__('edit')}}</label>
                                    <div >
                                    <span class="switch">
                                        <label>
                                             <input type="checkbox" checked name="edit"/>
                                            <span></span>
                                        </label>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">{{__('delete')}}</label>
                                    <div >
                                    <span class="switch">
                                        <label>
                                             <input type="checkbox" checked name="delete"/>
                                            <span></span>
                                        </label>
                                    </span>
                                    </div>
                                </div>
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
        $(document).on('click', '#submitButton', function () {
            // $('#submitButton').addClass('spinner spinner-white spinner-left');
            $('#submitForm').click();
        });
    </script>

<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/ckeditor.js"></script>
{{--    <script>--}}
{{--@include('admin.settings.editor_script')--}}
{{--    </script>--}}
@endsection

@section('script')

@endsection
