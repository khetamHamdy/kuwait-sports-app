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
                        <h3>{{__('Updated')}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <form method="post" action="{{ route('admin.product.update' , $product) }}"
                      enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                    @csrf
                    @method('put')
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.product.index') }}"
                           class="btn btn-secondary mr-2"> {{__('Cancel')}} </a>
                        <button id="submitButton" class="btn btn-success"
                                style="background-color:#ff4500 ;color: #ffffff; border: 0">{{__('Update')}}</button>
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
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('image')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <input
                                        class="form-control form-control-solid form-control-lg"
                                        name="image" type="file"
                                        value="{{ old("image") }}"/>
                                    <img src="{{asset($product->image)}}" height="200px" width="200px">
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
                                        value="{{ $product->link }}"/>
                                </div>
                            </div>
                            <!--end::Group-->
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
                                                    @if($product->status == $one) selected @endif>{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Group-->
                            <!--begin::Group-->
                            <div class="form-group row">
                                <label
                                    class="col-xl-3 col-lg-3 col-form-label">{{__('multiple image')}} </label>
                                <div class="col-lg-9 col-xl-9">
                                    <input
                                        class="form-control form-control-solid form-control-lg"
                                        name="images[]" type="file" multiple
                                        value="{{ $product->images }}"/>
                                </div>
                                <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                    @foreach($product->productImages as $one)

                                        <tr class="prod_image_tr">
                                            <td class="v-align-middle wd-25p">
                                                <img src="{{asset($one->image)}}"
                                                     style="height:50px ; width: 200px ; margin: 1rem">
                                            </td>
                                            <td class="v-align-middle wd-25p">
                                                <button type="button"
                                                        class="deleteProductImageBtn btn btn-danger btn-sm text-white"
                                                        value="{{$one->id}}">Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <!--end::Group-->
                            <div class="row">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                @foreach (config('app.languages') as $key => $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($loop->index == 0) show active in @endif"
                                           id="home-tab" data-toggle="tab"
                                           href="#{{ $key }}" role="tab"
                                           style="background-color:#ff4500 ;color: #ffffff;"
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
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('Title')}}  ( {{$lang}} )</label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="{{$key}}[title]" type="text"
                                                    value="{{$product->translate($key)->title}}"/>
                                            </div>
                                        </div>
                                        <!--end::Group-->

                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('Description')}} ( {{$lang}} )
                                            </label>
                                            <div class="col-lg-9 col-xl-9">
                                         <textarea name="{{$key}}[description]"
                                                   class="summernote form-control"
                                                   id="kt_summernote_1">{{$product->translate($key)->description}}</textarea>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                    </div>

                                @endforeach
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {

            $(document).on('click', '.deleteProductImageBtn', function () {
                var product_image_id = $(this).val();
                var this_click = $(this);
                $.ajax({
                    type: "GET",
                    url: "/admin/"+"product-image/" + product_image_id + "/delete",
                    success: function (response) {
                        alert(response.message);
                        this_click.closest('.prod_image_tr').remove();
                    }
                })
            });
        })
    </script>
@endsection
