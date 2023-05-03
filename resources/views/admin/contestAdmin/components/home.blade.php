<div class="card card-custom gutter-b example example-compact" style="padding: 30px">
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Row-->
        <div class="row">

            <div class="col-md-6">

                <div class="card card-custom bg-dark gutter-b" style="width:500px ;height:300px ">
                    @if($contest->video)
                        <iframe src="{{asset($contest->video)}}" width="500px"
                                height="300px">{{asset($contest->video)}}</iframe>
                    @endif

                    <br>
                    <hr>
                    <div class="d-flex align-items-center text-white  justify-content-between mb-6">
                        <p class="text-white text-hover-primary">{!! $contest->description !!}</p>
                    </div>
                </div>

            </div>


        </div>

    </div>
</div>
