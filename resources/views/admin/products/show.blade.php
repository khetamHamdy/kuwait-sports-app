@extends('admin.products.sideMenu')
@section('companyContent')
    <div class="container item_box">
        <div class="card card-custom gutter-b example example-compact" style="padding: 30px">
            <div class="flex-row-fluid ml-lg-8">
                <div class="row">

                    <div class="col-md-9">

                        <div class="card card-custom  gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                @foreach($product->productImages as $img)
                                    <img width="350px" height="200px" src="{{asset($img->image)}}"><hr>
                                @endforeach
                                <!--end::Body-->
                            </div>


                        </div>


                    </div>


                </div>
            </div>
        </div>

    </div>
@endsection
