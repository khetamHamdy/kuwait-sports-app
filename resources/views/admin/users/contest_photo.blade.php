<div class="card card-custom gutter-b example example-compact">

    <div class="card-header">
        <h3 class="card-title">{{__('Contest photo')}}</h3>
    </div>


    <div class="row">
        <div class="col-md-6">

            <div class="card card-custom  gutter-b">
                <!--begin::Body-->
                @if($contest_user)
                    <div class="card-body">
                        <img width="400px" height="300px" src="{{asset($contest_user->image)}}">
                        <p>{{ $contest_user->description }}</p>
                    </div>
                @endif
                <!--begin::Toolbar-->
                <br>
                <!--end::Toolbar-->
                <button type="submit" id="submitForm" style="display:none"></button>
                <!--end::Body-->
            </div>


        </div>

    </div>
</div>
