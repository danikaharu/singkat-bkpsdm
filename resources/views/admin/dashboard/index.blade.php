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
                                    <h4>Cetak Laporan</h4>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('promotion.exportExcel') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Periode</label>
                                                    <select style="cursor:pointer;" class="form-select" name="month">
                                                        <option disabled selected>-- Pilih Periode --</option>
                                                        @php
                                                            for ($m = 1; $m <= 12; ++$m) {
                                                                $month_label = date('F', mktime(0, 0, 0, $m, 1));
                                                                echo '<option value=' . $month_label . '>' . $month_label . '</option>';
                                                            }
                                                        @endphp
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Tahun</label>
                                                    <select style="cursor:pointer;" class="form-select" id="tag_select"
                                                        name="year">
                                                        <option disabled selected>-- Pilih Tahun --</option>
                                                        @php
                                                            $year = date('Y');
                                                            $min = $year - 5;
                                                            $max = $year;
                                                            for ($i = $max; $i >= $min; $i--) {
                                                                echo '<option value=' . $i . '>' . $i . '</option>';
                                                            }
                                                        @endphp
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Cetak</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
