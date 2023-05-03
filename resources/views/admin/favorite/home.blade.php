@extends('layouts.adminLayout')
@section('title')
    {{ucwords(__('events'))}}
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
                        <h3>{{ucwords(__('events'))}}</h3>
                    </div>
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div>
                    <div class="btn-group mb-2 m-md-3 mt-md-0 ml-2 ">
                    </div>

                        <a href="{{ route('admin.event.create') }}" class="btn btn-secondary  mr-2 btn-success" style="background: #fe4400 ;border: 0">
                            <i class="icon-xl la la-plus"></i>
                            <span>{{__('add')}}</span>
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
                                class="icon-xl la la-sliders-h"></i>{{__('filter')}}</button>
                        <div class="container box-filter-collapse">
                            <div class="card">
                                <form class="form-horizontal" method="get" action="{{route('admin.event.filter')}}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Title')}}</label>
                                                <input type="text" value="{{old('title')}}" class="form-control"
                                                       name="title" placeholder="{{__('title')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <button style="background: #fe4400 ;border: 0" type="submit"
                                                    class="btn sbold btn-default btnSearch">{{__('search')}}
                                                <i class="fa fa-search"></i>
                                            </button>

                                            <a href="{{route('admin.event.index')}}" type="submit"
                                               class="btn sbold btn-default btnRest">{{__('reset')}}
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div
                            class="card-header d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">

                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover tableWithSearch" id="tableWithSearch">
                                <thead>
                                <tr>
                                    <th class="wd-5p"></th>
                                    <th class="wd-5p"> {{ucwords(__('event title'))}}</th>
                                    <th class="wd-5p"> {{ucwords(__('event image'))}}</th>
                                    <th class="wd-5p"> {{ucwords(__('user name'))}}</th>
                                    <th class="wd-5p"> {{ucwords(__('count likes'))}}</th>



                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($fav as $one)
                                        <tr class="odd gradeX" id="tr-{{$one->id}}">
                                            <td class="v-align-middle wd-25p">{{$loop->iteration }}</td>
                                            <td class="v-align-middle wd-25p">{!!$one->title!!}</td>
                                            <td class="v-align-middle wd-5p"><img src="{{ asset($one->image) }}"
                                                                                  width="90px"
                                                                                  height="90px"></td>

                                            <td class="v-align-middle wd-25p">{!!$one->likeCount!!}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$fav->appends($_GET)->links("pagination::bootstrap-4") }}
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
