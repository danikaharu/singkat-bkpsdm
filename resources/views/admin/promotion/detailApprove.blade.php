@extends('layouts.admin')

@section('title', trans('Promotions'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Promotions') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of all promotions.') }}
                    </p>
                </div>
                <div class="col-12 col-md-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Promotion
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
                                        <td class="fw-bold">{{ __('NIP') }}</td>
                                        <td>{{ $promotion->employee->nip_baru }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Nama') }}</td>
                                        <td>{{ $promotion->employee->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tanggal Usulan') }}</td>
                                        <td>{{ $promotion->created_at->isoFormat('DD-MM-YYYY') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="float-start">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
                            </div>
                            <div class="float-end">
                                <div class="input-group">
                                    <a href="{{ route('promotion.detailCancel', $promotion->id) }}"
                                        class="btn btn-danger btn-md" style="margin-right: 10px;">Tolak
                                        Usulan</a>
                                    <form action="{{ route('promotion.approve', $promotion->id) }}" method="post"
                                        role="alert">
                                        @csrf

                                        <button class="btn btn-primary mb-2 ml-4">
                                            Setujui
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
