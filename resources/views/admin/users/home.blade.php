@extends('layouts.adminLayout')
@section('title')
    {{ucwords(__('users'))}}
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
                        <h3>{{ucwords(__('users'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->


                <div>
                    <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">

                        <a class="btn btn-secondary" href="{{url(app()->getLocale().'admin/ExcelUser')}}">
                            <i class="icon-xl la la-file-excel"></i>
                            <span>{{__('excel')}}</span>
                        </a>

                        <button type="button" class="btn btn-secondary" href="#activation" role="button"
                                data-toggle="modal">
                            <i class="icon-xl la la-check"></i>
                            <span>{{__('activation')}}</span>
                        </button>
                        <button type="button" class="btn btn-secondary" href="#cancel_activation" role="button"
                                data-toggle="modal">
                            <i class="icon-xl la la-ban"></i>
                            <span>{{__('cancel_activation')}}</span>
                        </button>
                        <button type="button" class="btn btn-secondary" href="#deleteAll" role="button"
                                data-toggle="modal">
                            <i class="flaticon-delete"></i>
                            <span>{{__('delete')}}</span>
                        </button>
                    </div>
                    <a href="{{route('admin.add_user')}}" class="btn btn-secondary  mr-2 btn-success">
                        <i class="icon-xl la la-plus"></i>
                        <span>{{__('Add')}}</span>
                    </a>
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
                                <form class="form-horizontal" method="get" action="{{route('admin.users.filter')}}">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">ID</label>
                                                <input type="number" value="{{request('id')?request('id'):''}}"
                                                       class="form-control" name="id" placeholder="ID">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{__('First Name')}}</label>
                                                <input type="text"
                                                       value="{{request('first_name')?request('first_name'):''}}"
                                                       class="form-control" name="first_name"
                                                       placeholder="{{__('first name')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Last Name')}}</label>
                                                <input type="text"
                                                       value="{{request('last_name')?request('last_name'):''}}"
                                                       class="form-control" name="last_name"
                                                       placeholder="{{__('last name')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Email')}}</label>
                                                <input type="text" class="form-control"
                                                       value="{{request('email')?request('email'):''}}" name="email"
                                                       placeholder="{{__('email')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Phone')}}</label>
                                                <input value="{{request('mobile')?request('mobile'):''}}"
                                                       onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                       type="text" class="form-control" name="mobile"
                                                       placeholder="{{__('mobile')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Status')}}</label>
                                                <select id="multiple2" class="form-control"
                                                        name="status">
                                                    <option></option>
                                                    <option
                                                        value="active" {{request('status') == 'active'?'selected':''}}>
                                                        {{__('active')}}
                                                    </option>
                                                    <option
                                                        value="not_active" {{request('status') == 'not_active'?'selected':''}}>
                                                        {{__('not_active')}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit"
                                                    class="btn sbold btn-default btnSearch">{{__('Search')}}
                                                <i class="fa fa-search"></i>
                                            </button>

                                            <a href="{{route('admin.users.index')}}" type="submit"
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
                                    <th class="wd-25p"> {{ucwords(__('First Name'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('Last Name'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('Email'))}}</th>
                                    <th class="wd-25p"> {{ucwords(__('Phone'))}}</th>
                                    <th class="wd-10p"> {{ucwords(__('Status'))}}</th>
                                    <th class="wd-10p"> {{ucwords(__('Created'))}}</th>
                                    <th class="wd-15p"> {{ucwords(__('Action'))}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($user as $one)
                                    <tr class="odd gradeX" id="tr-{{$one->id}}">
                                        <td class="v-align-middle wd-5p">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" value="{{$one->id}}"
                                                           class="checkboxes sub_chk" data-id="{{$one->id}}"
                                                           name="chkBox"/>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </td>
                                        {{--                                        <td class="v-align-middle wd-5p"><img src="{{$one->image}}" width="50px" height="50px"></td>--}}

                                        <td class="v-align-middle wd-25p">{{$one->id}}</td>
                                        <td class="v-align-middle wd-25p">{{$one->first_name }}</td>
                                        <td class="v-align-middle wd-25p">{{$one->last_name }}</td>
                                        <td class="v-align-middle wd-25p">{{$one->email}}</td>
                                        <td class="v-align-middle wd-25p">{{$one->phone}}</td>
                                        <td class="v-align-middle wd-10p"> <span id="label-{{$one->id}}" class="badge badge-pill badge-{{($one->status == "active")
                                            ? "info" : "danger"}}" id="label-{{$one->id}}">

                                            {{__($one->status)}}
                                        </span>
                                        </td>

                                        <td class="v-align-middle wd-10p">{{$one->created_at->format('Y-m-d')}}</td>

                                        <td class="v-align-middle wd-15p optionAddHours">
                                            <a href="{{route('admin.edit_user' ,$one )}}"
                                               class="btn btn-sm btn-clean btn-icon" title="{{__('edit')}}">
                                                <i class="la la-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{$user->appends($_GET)->links("pagination::bootstrap-4") }}
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

