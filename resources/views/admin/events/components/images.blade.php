<div class="card card-custom gutter-b example example-compact" style="padding: 30px">
    <div class="flex-row-fluid ml-lg-8">
        <div class="row">

            <div class="col-md-6">

                <div class="card card-custom  gutter-b">
                    <!--begin::Body-->
                        <div class="card-body">
                            @foreach($event->eventImages as $img)
                                <img width="350px" height="200px" src="{{asset($img->image)}}">
                                <hr>
                            @endforeach
                        </div>
                        @if(! $event->eventImages)
                        <div class="card-body">
                            <h2 style="color: #ff9900">Not Added Images</h2>
                        </div>
                    @endif
                    <!--end::Body-->
                </div>


            </div>


        </div>
    </div>
</div>
