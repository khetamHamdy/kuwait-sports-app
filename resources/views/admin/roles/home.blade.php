@extends('layouts.adminLayout')
@section('title') {{ucwords(__('Role'))}}
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
                        <h3>{{ucwords(__('Role'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->


                <div>
                    <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">

                        <button type="button" class="btn btn-secondary" href="#deleteAll" role="button" data-toggle="modal">
                            <i class="flaticon-delete"></i>
                            <span>{{__('delete')}}</span>
                        </button>
                    </div>
                    <a href="{{route('admin.roles.create')}}" class="btn btn-secondary  mr-2 btn-success">
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
                     <div class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
                         <div class="table-responsive">
                            <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                <thead>
                                <tr>
                                    <th class="wd-1p no-sort">
                                        <div class="checkbox-inline">
                                            <label class="checkbox">
                                                <input type="checkbox" name="checkAll" />
                                                <span></span></label>
                                        </div>
                                    </th>


                                    <th class="wd-25p"> {{ucwords(__('Full Name'))}}</th>
                                    <th class="wd-10p"> {{ucwords(__('Created'))}}</th>
                                    <th class="wd-15p"> {{ucwords(__('Action'))}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($items as $one)

                                    <tr class="odd gradeX" id="tr-{{$one->id}}">

                                        <td class="v-align-middle wd-5p">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" value="{{$one->id}}" class="checkboxes" name="chkBox" />
                                                    <span></span></label>
                                            </div>
                                        </td>

                                        <td class="v-align-middle wd-25p">{{$one->name}}</td>

                                        <td class="v-align-middle wd-10p">{{@$one->created_at->format('Y-m-d')}}</td>

                                        <td class="v-align-middle wd-15p optionAddHours">

                                            <a href="{{route('admin.roles.edit',$one)}}"
                                               class="btn btn-sm btn-clean btn-icon" title="{{__('edit')}}">
                                                <i class="la la-edit"></i>
                                            </a>


                                        </td>
                                    </tr>
                                @empty

                                @endforelse


                                </tbody>
                            </table>
                            {{$items->appends($_GET)->links("pagination::bootstrap-4") }}
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

@section('script')

@endsection
