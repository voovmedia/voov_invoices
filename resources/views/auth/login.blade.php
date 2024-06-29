
@extends('layouts.auth')
@section('title')
    {{ __('messages.login.login') }}
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-4">
    <div class="width-540" >
            @include('flash::message')
            @include('layouts.errors')
        </div>    
    <div class="col-12 text-center mb-0"> <!-- Adjusted margin-bottom to 0 -->
            <a href="{{ url('/') }}" class="login-logo image  mb-sm-2 image-medium">
                <img alt="Logo" src="/assets/images/logo.png" style="height: fit-content" class="img-fluid object-contain">
            </a>
        </div>
   
        <div class="bg-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto" "> <!-- Added inline style for margin-top -->
            <h1 class="text-center mb-7">{{ __('messages.login.sign_in') }}</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-sm-7 mb-4">
                    <label for="email" class="form-label">
                        {{ __('messages.login.email') . ':' }}<span class="required"></span>
                    </label>
                    <input name="email" type="email" class="form-control" autofocus id="email"
                        aria-describedby="emailHelp" required placeholder=" {{ __('messages.login.email') }}">
                </div>
                <div class="mb-sm-7 mb-4">
                    <div class="d-flex justify-content-between">
                        <label for="password" class="form-label">{{ __('messages.login.password') . ':' }}<span
                                class="required"></span></label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="link-info fs-6 text-decoration-none">
                                {{ __('messages.login.forget_your_password') }}
                            </a>
                        @endif
                    </div>
                    <div class="mb-3 position-relative">
                        <input name="password" type="password" class="form-control" id="password" required
                            placeholder="{{ __('messages.login.password') }}" aria-label="Password" data-toggle="password">
                        <span
                            class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                            <i class="bi bi-eye-slash-fill"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-sm-7 mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me">
                    <label class="form-check-label" for="remember_me">{{ __('messages.login.remember_me') }}</label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{ __('messages.login.login') }}</button>
                </div>
            </form>
            <!-- @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->
        </div>
    </div>
@endsection
