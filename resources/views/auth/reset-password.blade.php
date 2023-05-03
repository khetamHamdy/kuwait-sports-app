@extends("layouts.siteLayout")
@section('title')
    {{__('Reset password?')}}
@endsection
@section('css')
@endsection
@section("content")
    <section class="section_page_site">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="cont-sign">
                        <div class="head-sign">
                            <h3>{{__('password update')}}</h3>
                        </div>
                        <form class="form-st " method="post" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{__('Email')}}</label>
                                    <input type="email" class="form-control" placeholder="@gmail.com" name="email"
                                           value="{{old('email', $request->email)}}"/>
                                    <i class="fa-regular fa-envelope"></i>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{__('password')}}</label>
                                    <input type="password" class="form-control" placeholder="******" name="password"/>
                                    <img src="{{asset('front/images/lock.svg')}}" alt=""/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{__('Confirm Password')}}</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           value="{{old('password_confirmation')}}"
                                           placeholder="******"/>
                                    <img src="{{asset('front/images/lock.svg')}}" alt=""/>
                                </div>
                            </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-group">
                            <button type="submit" class=btn-site><span>{{__('Reset Password')}}</span></button>
                        </div>
                    </div>
                </div>
                    </form>
                </div>
            </div>

    </section>
    <!--section_home-->
@endsection
