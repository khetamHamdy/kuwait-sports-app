@extends("layouts.siteLayout")
@section('title')
    {{__('Register')}}
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_site">
        <div class="container">
            <div class="cont-sign">
                <div class="head-sign">
                    <h3>{{__('Register')}}</h3>
                </div>

                <form class="form-st form-register" action="{{route('register.store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg" name="image"
                                   value="{{old('image')}}"/>

                            <label for="imageUpload"></label>


                        </div>

                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url();">
                            </div>
                        </div>
                        @if ($errors->has('image'))
                            <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('image') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('First Name')}}</label>
                                <input type="text" class="form-control" name="first_name"

                                       value="{{old('first_name')}}"/>
                                <i class="fa-regular fa-user"></i>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('Last Name')}}</label>
                                <input type="text" class="form-control" name="last_name"

                                       value="{{old('last_name')}}"/>
                                <i class="fa-regular fa-user"></i>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input type="text" class="form-control" name="email"
                                       value="{{old('email')}}"/>
                                <i class="fa-regular fa-envelope"></i>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('Phone')}}</label>
                                <input type="text" class="form-control" name="phone"
                                       value="{{old('phone')}}"/>
                                <img src="{{asset('front/images/phone.svg')}}" alt=""/>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label> {{__('password')}}</label>
                                <input type="password" class="form-control"
                                       name="password" value="{{old('password')}}"/>
                                <img src="{{asset('front/images/lock.svg')}}" alt=""/>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>{{__('confirm password')}}</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                       value="{{old('password_confirmation')}}"
                                />
                                <img src="{{asset('front/images/lock.svg')}}" alt=""/>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong
                                            class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="d-flex align-items-center mt-40">

                                <div class="form-group">
                                    <button type="submit" class="btn-site"><span>{{__('Register')}}</span></button>
                                </div>

                                <div class="form-group">
                                    <a href="{{route('login')}}" class="btn-create">{{__('Sign In')}}</a>
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
