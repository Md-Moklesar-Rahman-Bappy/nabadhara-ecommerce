@extends('frontend.layouts.app')

@section('content')
    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini p-4">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Login</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Login</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- START MAIN CONTENT -->
    <div class="main_content">

    <!-- START LOGIN SECTION -->
    <div class="login_register_wrap section pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3>Login</h3>
                            </div>
                            <form role="form" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                        <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email" >
                                    @else
                                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                    @endif
                                    @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                        <span class="opacity-60" style="font-size: 12px;">{{  translate('Use country code before number') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password">
                                </div>
                                <div class="login_footer form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox aiz-checkbox">
                                            <input class="form-check-input" type="checkbox" name="remember" id="exampleCheckbox1" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="exampleCheckbox1"><span>{{  translate('Remember Me') }}</span></label>
                                        </div>
                                    </div>
                                    <a href="{{ route('password.request') }}">{{  translate('Forgot password?') }}</a>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-fill-out btn-block" name="login">{{translate('Log in')}}</button>
                                </div>
                            </form>
                            @if (env("DEMO_MODE") == "On")
                                <div class="mb-5">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <td>{{ translate('Seller Account')}}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-fill-out" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ translate('Customer Account')}}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-fill-out" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            <div class="different_login">
                                <span> {{translate('or')}}</span>
                            </div>
                            <ul class="btn-login list_none text-center">
                                @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                    
                                    @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                        <li>
                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a>
                                        </li>
                                    @endif
                                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                        <li>
                                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a>
                                        </li>
                                    @endif
                                    {{-- @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                        <li class="list-inline-item">
                                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                <i class="lab la-twitter"></i>
                                            </a>
                                        </li>
                                    @endif --}}
                                @endif
                            </ul>
                            <div class="form-note text-center">{{ translate('Dont have an account?')}} <a href="{{ route('user.registration') }}">{{ translate('Sign up now')}}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGIN SECTION -->


    </div>
    <!-- END MAIN CONTENT -->
    {{-- <section class="gry-bg py-5">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center pt-4">
                                <h1 class="h4 fw-600">
                                    {{ translate('Login to your account.')}}
                                </h1>
                            </div>

                            <div class="px-4 py-3 py-lg-4">
                                <div class="">
                                    <form class="form-default" role="form" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                                <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                            @else
                                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                            @endif
                                            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                                <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password">
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="aiz-checkbox">
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                                    <span class="aiz-square-check"></span>
                                                </label>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                            </div>
                                        </div>

                                        <div class="mb-5">
                                            <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                                        </div>
                                    </form>

                                    @if (env("DEMO_MODE") == "On")
                                        <div class="mb-5">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>{{ translate('Seller Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Customer Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                        <div class="separator mb-3">
                                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                                        </div>
                                        <ul class="list-inline social colored text-center mb-5">
                                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                        <i class="lab la-facebook-f"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                                        <i class="lab la-google"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                        <i class="lab la-twitter"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                                    <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@section('script')
    <script type="text/javascript">
        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection
