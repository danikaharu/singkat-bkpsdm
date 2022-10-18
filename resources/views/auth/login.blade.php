@extends('layouts.auth')

@section('title', trans('Log in'))

@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin') }}/css/pages/auth.css">
@endpush

@section('content')
    <div class="row h-100">
        <div class="col-lg-6 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    {{-- <a href="#">
                        <img src="{{ asset('template/admin') }}/images/logo/logo1.svg" alt="Logo">
                    </a> --}}
                </div>
                <h1 class="auth-title">{{ __('Log in.') }}</h1>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible show fade">
                        <ul class="ms-0 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>
                                    <p>{{ $error }}</p>
                                </li>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible show fade">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl @error('username') is-invalid @enderror"
                            name="username" autocomplete="username" placeholder="Username" autofocus>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror"
                            placeholder="Password" name="password" autocomplete="current-password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">{{ __('Log in') }}</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6 d-none d-lg-block">
            <div id="auth-right">
            </div>
        </div>
    </div>
@endsection
