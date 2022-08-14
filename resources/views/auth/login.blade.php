{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

@extends('layouts.auth')
@section('content')
    <!-- PAGE -->
    <div class="page">
        <div class="">

            <!-- CONTAINER OPEN -->
            {{-- <div class="col col-login mx-auto mt-7">
                <div class="text-center">
                    <img src="../assets/images/brand/logo-white.png" class="header-brand-img" alt="">
                </div>
            </div> --}}

            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form class="login100-form validate-form" method="POST" action="{{ route('login.action') }}">
                        @csrf

                        <span class="login100-form-title pb-5">
                            Login
                        </span>
                        <div class="panel panel-primary">
                            <div class="panel-body tabs-menu-body p-0 pt-5">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab5">

                                        @if (\Session::has('success'))
                                            <div class="alert alert-success" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-hidden="true">×</button>
                                                {{ session()->get('success') }}
                                            </div>
                                            @php
                                                Session::forget('success');
                                            @endphp
                                        @endif
                                        @if (\Session::has('warning'))
                                            <div class="alert alert-warning" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-hidden="true">×</button>
                                                {{ session()->get('warning') }}
                                            </div>
                                            @php
                                                Session::forget('warning');
                                            @endphp
                                        @endif
                                        @if (\Session::has('error'))
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-hidden="true">×</button>
                                                {{ session()->get('error') }}
                                            </div>
                                            @php
                                                Session::forget('error');
                                            @endphp
                                        @endif
                                        <div class="wrap-input100 validate-input input-group"
                                            data-bs-validate="Valid email is required: ex@abc.xyz">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="email"
                                                id="email" placeholder="Email" name="email" :value="old('email')"
                                                required autofocu>
                                        </div>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="password"
                                                id="password" placeholder="Password" name="password" required
                                                autocomplete="current-password">
                                        </div>
                                        <div class="text-end pt-4">
                                            <p class="mb-0"><a class="text-primary ms-1">Forgot Password?</a></p>
                                        </div>
                                        <div class="container-login100-form-btn">
                                            <button type="submit" class="login100-form-btn btn-primary">
                                                Login
                                            </button>
                                        </div>
                                        <div class="text-center pt-3">
                                            <p class="text-dark mb-0">Not a member?<a href="register.html"
                                                    class="text-primary ms-1">Sign UP</a></p>
                                        </div>
                                        <label class="login-social-icon"><span>Login with Social</span></label>
                                        <div class="d-flex justify-content-center">
                                            <a href="javascript:void(0)">
                                                <div class="social-login me-4 text-center">
                                                    <i class="fa fa-google"></i>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)">
                                                <div class="social-login me-4 text-center">
                                                    <i class="fa fa-facebook"></i>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)">
                                                <div class="social-login text-center">
                                                    <i class="fa fa-twitter"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- End PAGE -->
@endsection
