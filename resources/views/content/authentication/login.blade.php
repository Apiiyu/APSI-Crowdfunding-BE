@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-cover">
  <div class="auth-inner row m-0">
    <!-- Brand logo-->
    <a class="brand-logo d-flex align-items-center" href="#">
    <img class="img-fluid" src="{{asset('images/logo/rpu-home.png')}}" width="80" height="80" alt="Login V2" />
      <h2 class="brand-text text-primary ms-1">Rumah Peduli Umat</h2>
    </a>
    <!-- /Brand logo-->

    <!-- Left Text-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        @if($configData['theme'] === 'dark')
          <img class="img-fluid" src="{{asset('images/pages/login-v2-dark.svg')}}" alt="Login V2" />
          @else
          <img class="img-fluid" src="{{asset('images/pages/login-v2.svg')}}" alt="Login V2" />
          @endif
      </div>
    </div>
    <!-- /Left Text-->

    <!-- Login-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h2 class="card-title fw-bold mb-1">Welcome to Vuexy! 👋</h2>
        <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
        <form class="auth-login-form mt-2" action="{{ route('login.action') }}" method="POST">
          @csrf
          <div class="mb-1">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" id="email" type="text" name="email" placeholder="john@example.com" aria-describedby="email" autofocus="" tabindex="-1" />
          </div>
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">Password</label>
              <a href="{{url("auth/forgot-password-cover")}}">
                <small>Forgot Password?</small>
              </a>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="-2" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" id="remember_me" type="checkbox" name="remember_me" tabindex="-3" />
              <label class="form-check-label" for="remember_me"> Remember Me</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100" tabindex="-4">Sign in</button>
        </form>
        <p class="text-center mt-2">
          <span>New on our platform?</span>
          <a href="{{url('auth/register-cover')}}"><span>&nbsp;Create an account</span></a>
        </p>
        <div class="divider my-2">
          <div class="divider-text">or</div>
        </div>
        <div class="auth-footer-btn d-flex justify-content-center">
          <a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a>
          <a class="btn btn-twitter white" href="#"><i data-feather="twitter"></i></a>
          <a class="btn btn-google" href="#"><i data-feather="mail"></i></a>
          <a class="btn btn-github" href="#"><i data-feather="github"></i></a>
        </div>
      </div>
    </div>
    <!-- /Login-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-login.js'))}}"></script>
@endsection
