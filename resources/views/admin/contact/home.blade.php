@extends('layouts.adminLayout')
@section('title')
    {{ucwords(__('Messages'))}}
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
                        <h3>{{ucwords(__('Messages'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->


                <div>
                    <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">
                        <a class="btn btn-secondary" href="{{url('admin/ExcelMessage')}}">
                            <i class="icon-xl la la-file-excel"></i>
                            <span>{{__('excel')}}</span>
                        </a>
                        <button type="button" class="btn btn-secondary" href="#deleteAll" role="button" data-toggle="modal">
                            <i class="flaticon-delete"></i>
                            <span>{{__('delete')}}</span>
                        </button>
                    </div>
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
                <div class="gutter-b example example-compact">

                    <div class="contentTabel">
                        <button type="button" class="btn btn-secondar btn--filter mr-2"><i
                                class="icon-xl la la-sliders-h"></i>{{__('Filter')}}</button>
                        <div class="container box-filter-collapse">
                            <div class="card">
                                <form class="form-horizontal" method="get"
                                      action="{{route('admin.contact_users.filter')}}">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Full Name')}}</label>
                                                <input type="text"
                                                       value="{{request('name')?request('name'):''}}"
                                                       class="form-control" name="name"
                                                       placeholder="{{__('Full Name')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Email')}}</label>
                                                <input type="text" class="form-control"
                                                       value="{{request('email')?request('email'):''}}" name="email"
                                                       placeholder="{{__('Email')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <button type="submit"
                                                    class="btn sbold btn-default btnSearch">{{__('Search')}}
                                                <i class="fa fa-search"></i>
                                            </button>

                                            <a href="{{route('admin.contact.user')}}" type="submit"
                                               class="btn sbold btn-default btnRest">{{__('Reset')}}
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div
                            class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
                            <div>


                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                <thead>
                                <tr>
                                    <th class="wd-1p no-sort">
                                        <div class="checkbox-inline">
                                            <label class="checkbox">
                                                <input type="checkbox" name="checkAll"/>
                                                <span></span></label>
                                        </div>
                                    </th>
                                    <th class="wd-5p">ID</th>
                                    <th class="wd-25p"> {{ucwords(__('Full Name'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('Email'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('Phone'))}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contact as $one)
                                    <tr class="odd gradeX" id="tr-{{$one->id}}">
                                        <td class="v-align-middle wd-5p">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" value="{{$one->id}}" class="checkboxes"
                                                           name="chkBox"/>
                                                    <span></span></label>
                                            </div>
                                        </td>

                                        <td class="v-align-middle wd-25p">{{$one->id}}</td>
                                        <td class="v-align-middle wd-25p">{{$one->name }}</td>
                                        <td class="v-align-middle wd-25p">{{$one->email}}</td>
                                        <td class="v-align-middle wd-25p">{{$one->mobile}}</td>

                                        {{--                                            <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d') ?? '--'}}</td>--}}
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{$contact->appends($_GET)->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection
@section('js')

@endsection

