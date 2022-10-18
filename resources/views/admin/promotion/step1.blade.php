@extends('layouts.admin')

@section('title', trans('Kenaikan Pangkat'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Kenaikan Pangkat') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Buat Usulan kenaikan Pangkat') }}
                    </p>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
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
                            <form action="{{ route('promotion.storeStep1') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="period">{{ __('Periode') }}</label>
                                            <input type="text" name="period" id="period"
                                                class="form-control @error('username') is-invalid @enderror"
                                                value="{{ $setting == $today ? $setting : '' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="year">{{ __('Tahun') }}</label>
                                            <input type="text" name="year" id="year"
                                                class="form-control @error('year') is-invalid @enderror"
                                                value="{{ $year == \Carbon\Carbon::today()->isoFormat('Y') ? $year : '' }}"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <label for="">Jenis Prosedur</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="procedure_type"
                                                id="procedure_type1" value="1">
                                            <label class="form-check-label" for="procedure_type1">
                                                III/D Ke Bawah
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="procedure_type"
                                                id="procedure_type1" value="2">
                                            <label class="form-check-label" for="procedure_type1">
                                                IV/A sampai IV/B
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="procedure_type"
                                                id="procedure_type1" value="3">
                                            <label class="form-check-label" for="procedure_type1">
                                                IV/C Ke Atas
                                            </label>
                                        </div>
                                        @error('procedure_type')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="promotion_type">{{ __('Jenis Kenaikan Pangkat') }}</label>
                                            <select id="selectEmployee" class="form-select" name="promotion_type"
                                                id="name">
                                                <option disabled selected>-- Pilih Jenis KP --</option>
                                                <option value="1">Reguler</option>
                                                <option value="2">Memperoleh Ijazah/Penyesuaian Ijazah</option>
                                                <option value="3">Struktural</option>
                                                <option value="4">Jabatan Fungsional Tertentu</option>
                                            </select>
                                            @error('promotion_type')
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="job_type">{{ __('Jenis Jabatan') }}</label>
                                            <select id="selectEmployee" class="form-select" name="job_type" id="job_type">
                                                <option disabled selected>-- Pilih Jenis Jabatan --</option>
                                                <option value="1">Fungsional Umum/Pelaksana</option>
                                                <option value="2">Struktural</option>
                                                <option value="3">Jabatan Fungsional</option>
                                            </select>
                                            @error('job_type')
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
