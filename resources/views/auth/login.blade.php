@extends("layouts.siteLayout")
@section('title')
    Login
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
                            <h3>{{__('Sign In')}}</h3>
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
                        </div>
                        <form class="form-st form-sign" method="post" action="{{route('login')}}">
                            @csrf
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input type="email" class="form-control" placeholder="@gmail.com"  name="email" required/>
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <div class="form-group">
                                <label>{{__('password')}}</label>
                                <input type="password" class="form-control" placeholder="**********" name="password" required/>
                                <img src="{{asset('front/images/lock.svg')}}" alt="" />
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-group">
                                    <button class="btn-site"><span>{{__('Sign In')}}</span></button>
                                </div>
                                <div class="form-group">
                                    <a href="{{route('register')}}" class="btn-create">{{__('Create an account?')}}</a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="form-group text-center">
                                    <a href="{{route('password.request')}}" class="btn-rest">{{__('Reset password?')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
