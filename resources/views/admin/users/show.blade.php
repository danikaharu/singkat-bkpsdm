@extends('layouts.admin')

@section('title', trans('Detail User'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('User') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail user information.') }}
                    </p>
                </div>

                <div class="col-12 col-md-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('users.index') }}">{{ __('User') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ __('Detail') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <div class="avatar avatar-xl">
                                                @if ($user->avatar == null)
                                                    <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}&s=500"
                                                        alt="Avatar">
                                                @else
                                                    <img src="{{ asset("uploads/images/avatars/$user->avatar") }}"
                                                        alt="Avatar">
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Name') }}</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Username') }}</td>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Email') }}</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Role') }}</td>
                                        <td>{{ $user->getRoleNames()->toArray() !== [] ? $user->getRoleNames()[0] : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tanggal dibuat') }}</td>
                                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tanggal diedit') }}</td>
                                        <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
