@extends('admin.subscribe.sideMenu')
@section('companyContent')
    <div class="flex-row-fluid ml-lg-8">
        <div class="card card-custom gutter-b example example-compact">

            <div class="card-header">
                <h3 class="card-title">{{__('edit')}}</h3>
            </div>

            <form method="post" action="{{route('admin.newsletter.update',$subscribe)}}"
                  enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
                {{ csrf_field() }}
                @method('put')


                <div class="row col-sm-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('sender name')}}</label>
                            <input type="text" class="form-control form-control-solid"
                                   name="sender_name" value="{{old('sender_name',$subscribe->sender_name)}}" required/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('email')}}</label>
                            <input type="email" class="form-control form-control-solid" name="email"
                                   value="{{old('email',$subscribe->email)}}" required/>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('status')}}</label>
                            <select class="form-control form-control-solid"
                                    name="status" required>
                                <option
                                    value="active" {{old('status',$subscribe->status) == 'active'?'selected':''}}>
                                    {{__('active')}}
                                </option>
                                <option
                                    value="not_active" {{old('status',$subscribe->status)  == 'not_active'?'selected':''}}>
                                    {{__('not_active')}}
                                </option>
                            </select>
                        </div>
                    </div>

                </div>


                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <a href="{{url('admin/newsletter/index')}}" class="btn btn-secondary  mr-2">{{__('cancel')}}</a>
                    <button id="submitButton" class="btn btn-success ">{{__('save')}}</button>
                </div>
                <!--end::Toolbar-->
                <button type="submit" id="submitForm" style="display:none"></button>
            </form>

        </div>
    </div>
@endsection
@section('js')

    <script>
        $(document).on('click', '#submitButton', function () {
            $('#submitForm').click();
        });
    </script>
@endsection
