@extends("layouts.siteLayout")
@section('title')
    {{__('Edit Profile')}}
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_site">
        <div class="container">
            <div class="cont-sign">
                <div class="head-sign">
                    <h3> {{__('Edit Profile')}}</h3>
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
                <form class="form-st form-register" action="{{route('update.profile')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="image"
                                   value="{{$user->image}}"/>
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url({{asset($user->image)}});">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('First Name')}}</label>
                                <input type="text" class="form-control" placeholder="{{__('First Name')}}" name="first_name"
                                       value="{{$user->first_name}}"/>
                                <i class="fa-regular fa-user"></i>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('Last Name')}}</label>
                                <input type="text" class="form-control" placeholder="{{__('Last Name')}}" name="last_name"
                                       value="{{$user->last_name}}"/>
                                <i class="fa-regular fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input type="text" class="form-control" placeholder="@gmail.com" name="email"
                                       value="{{$user->email}}"/>
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('Phone')}}</label>
                                <input type="text" class="form-control" name="phone" value="{{$user->phone}}"/>
                                <img src="{{asset('front/images/phone.svg')}}" alt=""/>
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
