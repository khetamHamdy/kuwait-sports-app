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
                            <h3>{{__('Reset password?')}}</h3>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>{{'Error'}}!</strong>{{__('Wrong data entry')}}<br>
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ __($error) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                <p class="text-green-900">{{ session('status') }}</p>
                            </div>
                        @endif
                        <form class="form-st" method="post" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input type="email" class="form-control" placeholder="@gmail.com" name="email"
                                       value="{{old('email')}}"/>
                                <i class="fa-regular fa-envelope"></i>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-group">
                                    <button type="submit" class="btn-site"><span>{{__('Send')}}</span></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--section_home-->
@endsection
