@extends('admin.media.sideMenu')
@section('companyContent' )

    <div class="container item_box_contest">
        <div class="card card-custom gutter-b example example-compact" style="padding: 30px">
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Row-->
                <div class="row">

                    <div class="col-md-6">
                        @if($medium->video)
                            <div class="card card-custom bg-dark gutter-b" style="width:500px ;height:300px ">

                                <iframe src="{{asset($medium->video )}}" width="500px"
                                        height="300px">{{asset($medium->video)}}</iframe>

                            </div>
                        @else
                            <div class="card card-custom bg-dark gutter-b" style="width:500px ;height:300px ">
                                   <h3 class="text-white text-center ">No Video Added</h3>

                            </div>
                        @endif
                    </div>


                </div>

            </div>
        </div>

    </div>
@endsection

