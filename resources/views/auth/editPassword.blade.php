@extends("layouts.siteLayout")
@section('title')
    Edit Password
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_site">
        <div class="container">
            <div class="cont-sign">
                <div class="head-sign">
                    <h3>{{__('edit password')}}</h3>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>{{'Error'}}!</strong>{{__('Wrong data entry')}}<br>
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-st form-register" action="{{route('update.password')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('password')}}</label>
                                <input type="text" class="form-control" placeholder="{{__('password')}}" name="password"
                                       value="{{old('password')}}"/>
                                <img src="{{asset('front/images/lock.svg')}}" alt=""/>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('confirm password')}}</label>
                                <input type="text" class="form-control" placeholder="{{__('confirm password')}}" name="password_confirmation"
                                       value="{{old('password_confirmation')}}"/>
                                <img src="{{asset('front/images/lock.svg')}}" alt=""/>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="d-flex align-items-center mt-40">
                                <div class="form-group">
                                    <button type="submit" class=btn-site><span>{{__('Update')}}</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--section_home-->
@endsection
@section('js')
    <script>
        new WOW().init();

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function () {
            readURL(this);
        });
    </script>
@endsection
