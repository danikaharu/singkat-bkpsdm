@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible show fade">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h4>Hi 👋, {{ auth()->user()->name }}</h4>
                    </div>
                </div>

                @hasanyrole('Super Admin')
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Usulan Terbaru</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Nama Pegawai</th>
                                                    <th>Jenis Kenaikan Pangkat</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($latestPromotions as $promotion)
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                <p class="font-bold ms-3 mb-0">{{ $promotion->employee->nama }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">{{ $promotion->promotion_type() }}</p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0"><span
                                                                    class="badge bg-primary">{{ $promotion->status() }}</span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    Maaf, belum ada data
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole

            </div>
        </section>
    </div>
@endsection
