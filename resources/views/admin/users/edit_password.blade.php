<div class="card card-custom gutter-b example example-compact">

    <div class="card-header">
        <h3 class="card-title">{{__('edit password')}}</h3>
    </div>

    <form method="post" action="{{route('admin.password_update',$user)}}" class="form-horizontal" role="form"
          id="form">
        {{ csrf_field() }}
        @method('put')

        <div class="row col-sm-12">

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{__('password')}}</label>
                    <input type="password" class="form-control form-control-solid" name="password"
                           value="{{ old('password') }}"
                           placeholder="{{__('password')}} " required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{__('confirm password')}}</label>
                    <input type="password" class="form-control form-control-solid" name="password_confirmation"
                           value="{{ old('password_confirmation') }}"
                           placeholder="{{__('confirm password')}} " required>
                </div>
            </div>
        </div>
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <a href="" class="btn btn-secondary  mr-2">{{__('Cancel')}}</a>
            <button id="submitButton" class="btn btn-success ">{{__('Save')}}</button>
        </div>
        <!--end::Toolbar-->
        <button type="submit" id="submitForm" style="display:none"></button>
    </form>

</div>


