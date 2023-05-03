<div class="card card-custom gutter-b example example-compact">

    <div class="card-header">
        <h3 class="card-title">{{__('Edit Profile')}}</h3>
    </div>

    <form method="post" action="{{route('admin.update_user' , $user)}}"
          enctype="multipart/form-data" class="form-horizontal" role="form" id="form">
        {{ csrf_field() }}
        @method('put')


        <div class="row col-sm-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{__('First Name')}}</label>
                    <input type="text" class="form-control form-control-solid"
                           name="first_name" value="{{old('first_name' , $user->first_name)}}" required/>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{__('Last Name')}}</label>
                    <input type="text" class="form-control form-control-solid"
                           name="last_name" value="{{old('last_name' , $user->last_name)}}" required/>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{__('Phone')}}</label>
                    <input type="text" class="form-control form-control-solid" name="phone"
                           value="{{old('phone',$user->phone)}}" maxlength="12" minlength="4" min="0" required/>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{__('Email')}}</label>
                    <input type="email" class="form-control form-control-solid" name="email"
                           value="{{old('email',$user->email )}}" required/>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label>{{__('Status')}}</label>
                    <select class="form-control form-control-solid"
                            name="status" required>
                        <option
                            value="active" {{old('status',$user->status) == 'active'?'selected':''}}>
                            {{__('active')}}
                        </option>
                        <option
                            value="notActivee" {{old('status',$user->status)  == 'notActivee'?'selected':''}}>
                            {{__('not_active')}}
                        </option>
                    </select>
                </div>
            </div>

        </div>


        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <a href="{{url(getLocal().'/admin/user')}}" class="btn btn-secondary  mr-2">{{__('Cancel')}}</a>
            <button id="submitButton" class="btn btn-success ">{{__('Save')}}</button>
        </div>
        <!--end::Toolbar-->
        <button type="submit" id="submitForm" style="display:none"></button>
    </form>

</div>
