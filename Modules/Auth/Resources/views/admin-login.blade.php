<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{translate('admin_login')}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="robots" content="nofollow, noindex ">
    @php($favIcon = getBusinessSettingsImageFullPath(key: 'business_favicon', settingType: 'business_information', path: 'business/',  defaultPath : 'public/assets/admin-module/img/placeholder.png'))
    <link rel="shortcut icon" href="{{ $favIcon }}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet"/>

    <link href="{{asset('public/assets/admin-module')}}/css/material-icons.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="{{asset('public/assets/admin-module')}}/plugins/perfect-scrollbar/perfect-scrollbar.min.css"/>

    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/css/style.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/admin-module')}}/css/toastr.css">
</head>

<body>
<div class="preloader"></div>
<?php
$logo = getBusinessSettingsImageFullPath(key: 'business_logo', settingType: 'business_information', path: 'business/',  defaultPath : 'public/assets/admin-module/img/placeholder.png');
?>

<div>
    <form action="{{route('admin.auth.login')}}" enctype="multipart/form-data" method="POST"
            id="login-form">
        @csrf
        <div class="login-wrap">
            <div class="login-left d-flex justify-content-center align-items-center bg-center" data-bg-img="{{asset('public/assets/provider-module')}}/img/media/login-bg.png">
                <div class="tf-box d-flex flex-column gap-3 align-items-center justify-content-center p-5 mx-5 h-75">
                    <img class="login-logo mb-2"
                        src="{{ $logo }}"
                        alt="{{ translate('logo') }}">
                    <h2 class="text-center text-dark">Reach <strong class="c1">Hundreds Of Customers </strong> with your services</h2>
                </div>
            </div>

            <div class="login-right-wrap bg-white">

                <div class="login-right w-100 m-auto p-3">
                    <div class="d-flex justify-content-between align-items-start gap-2 mb-5 mt-3">
                        <div class="d-flex flex-column gap-2">
                            <h2 class="c1 fw-medium">{{translate('admin_Sign_In')}}</h2>
                            <p>{{translate('sign_in_to_stay_connected')}}</p>
                        </div>
                        <span class="badge badge-primary fz-12 opacity-75">
                            {{translate('Software_Version')}} : {{ env('SOFTWARE_VERSION') }}
                        </span>
                    </div>

                    {{-- <div class="mb-4">
                        <img class="login-img login-logo mb-2"
                                src="{{onErrorImage(
                                        $logo->live_values,
                                        asset('storage/app/public/business').'/' . $logo->live_values,
                                        asset('public/assets/placeholder.png') ,
                                        'business/')}}"
                                alt="{{ translate('logo') }}">
                        <h5 class="text-uppercase c1 mb-3">{{(business_config('business_name', 'business_information'))->live_values ?? null}}</h5>
                        <h2 class="mb-1">{{translate('sign_in')}}</h2>
                        <p class="opacity-75">{{translate('sign_in_to_stay_connected')}}</p>
                    </div> --}}

                    <div class="mb-4">
                        <div class="mb-5">
                            <div class="form-floating form-floating__icon">
                                <input type="email" name="email_or_phone" class="form-control"
                                        placeholder="{{translate('example@gmail.com')}}" required="" id="email">
                                <label>{{translate('email')}}</label>
                                <span class="material-icons">mail</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating form-floating__icon">
                                <input type="password" name="password" class="form-control"
                                        placeholder="{{translate('********')}}" required=""
                                        id="password">
                                <label>{{translate('password')}}</label>
                                <span class="material-icons togglePassword">visibility_off</span>
                                <span class="material-icons">lock</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-1 align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberMeCheckbox">
                                    <label class="form-check-label" for="rememberMeCheckbox">{{translate('Remember me?')}}</label>
                                </div>
                            </div>
                            {{-- <div class="d-flex gap-1 align-items-center">
                                <a href="{{route('provider.auth.reset-password.index')}}"
                                    class="lh-1">{{translate('Forget Password')}}?</a>
                            </div> --}}
                        </div>
                    </div>

                    @php($recaptcha = business_config('recaptcha', 'third_party'))
                    @if(isset($recaptcha) && $recaptcha->is_active)
                        <div class="recaptcha d-flex justify-content-center mb-4">
                            <div id="recaptcha_element" class="w-100" data-type="image"></div>
                        </div>
                    @endif

                    <div class="d-flex mb-4">
                        <button class="btn btn--primary flex-grow-1 text-capitalize"
                                type="submit">{{translate('sign_in')}}</button>
                    </div>

                    <div class="mt-3 d-flex flex-wrap gap-1 justify-content-center">
                        {{translate('want_to_sign_in_to_your_provider_account')}} ?
                        <a href="{{route('provider.auth.login')}}"
                            class="c1 text-decoration-underline">{{translate('sign_in_here')}}</a>
                    </div>
                </div>

                @if(env('APP_ENV')=='demo')
                    <div class="login-footer d-flex justify-content-between c1-bg text-white">
                        <div>
                            <div>{{translate('email')}} : {{translate('admin@admin.com')}}</div>
                            <div>{{translate('password')}} : {{translate('12345678')}}</div>
                        </div>
                        <button type="button" class="btn login-copy">
                            <span class="material-symbols-outlined m-0">content_copy</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>


<script src="{{asset('public/assets/admin-module')}}/js/jquery-3.6.0.min.js"></script>
<script src="{{asset('public/assets/admin-module')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('public/assets/admin-module')}}/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{asset('public/assets/admin-module')}}/js/main.js"></script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script src="{{asset('public/assets/admin-module')}}/js/sweet_alert.js"></script>
<script src="{{asset('public/assets/admin-module')}}/js/toastr.js"></script>
{!! Toastr::message() !!}

<script>
    "use strict";
    @if(env('APP_ENV')=='demo')
        $('.login-copy').on('click', function () {
            copy_cred()
        })

        function copy_cred() {
            $('#email').val('admin@admin.com');
            $('#password').val('12345678');
            toastr.success('{{translate('Copied successfully')}}', 'Success', {
                CloseButton: true,
                ProgressBar: true
            });
        }
   @endif

    @php($recaptcha = business_config('recaptcha', 'third_party'))
    @if(isset($recaptcha) && $recaptcha->is_active)

        var onloadCallback = function () {
                grecaptcha.render('recaptcha_element', {
                    'sitekey': '{{$recaptcha->live_values['site_key']}}'
                });
            };

            $("#login-form").on('submit', function (e) {
                var response = grecaptcha.getResponse();

                if (response.length === 0) {
                    e.preventDefault();
                    toastr.error("{{translate('please_check_the_recaptcha')}}");
                }
            });
    @endif

    @if ($errors->any())

        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach

   @endif
</script>
</body>
</html>
