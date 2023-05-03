@extends('layouts.adminLayout')
@section('title') {{ucwords(__('roles'))}}
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
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a  href="{{route('admin.roles.index')}}" class="btn btn-secondary  mr-2">{{__('Cancel')}}</a>
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
                        <form class="form" method="post" action="{{route('admin.roles.store')}}" enctype="multipart/form-data" >
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">{{__('main information')}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach (config('app.languages') as $key => $lang)
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('name_'.$lang)}}</label>
                                                <input type="text" {{($key == 'ar') ? 'dir=rtl' :'' }}   class="form-control form-control-solid" name="name_{{$key}}" value="{{ old('name_'.$key) }}" required />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                             <div class="card-body">
                                <div class="card-header">
                                <h3 class="card-title">{{__('Permissions')}}</h3>
                                </div>
                                <div class="row">
                                   @foreach($permissions as $permission)
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="{{$permission->slug}}" class="col-6 col-form-label px-8">{{$permission->name}}</label>
                                                <span class="switch switch-icon">
    												<label>
    													<input id="{{$permission->slug}}" type="checkbox" name="permissions[]" {{in_array($permission->roleSlug,old('permissions',[]))?"checked":""}}
                                                          value="{{$permission->id}}">
    													<span></span>
    												</label>
    											</span>

                                            </div>
                                        </div>
                                @endforeach
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
        $(document).on('click', '#submitButton', function(){
           // $('#submitButton').addClass('spinner spinner-white spinner-left');
        $('#submitForm').click();
    });

</script>
@endsection

@section('script')

@endsection
