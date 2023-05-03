<div class="card card-custom gutter-b example example-compact" style="padding: 30px">
    <div class="flex-row-fluid ml-lg-8">
        <div class="row">

            <div class="col-md-6">

                <div class="card card-custom  gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        @if($event->video)
                        <video width="520" height="340" controls>
                                <source src="{{asset($event->video)}}">
                            Your browser does not support the video tag.
                        </video>
                        @endif
                        <!--end::Body-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
