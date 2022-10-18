@extends('layouts.admin')

@section('title', trans('Create Promotion'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Kenaikan Pangkat') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Buat usulan kenaikan pangkat.') }}
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
                            <form action="{{ route('promotion.storeStep2') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nip_baru">{{ __('NIP Baru') }}</label>
                                            <input type="text" name="nip_baru" id="nip_baru"
                                                class="form-control @error('nip_baru') is-invalid @enderror"
                                                placeholder="{{ __('NIP Baru') }}">
                                            @error('nip_baru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nip_lama">{{ __('NIP Lama') }}</label>
                                            <input type="text" name="nip_lama" id="nip_lama"
                                                class="form-control @error('nip_lama') is-invalid @enderror"
                                                placeholder="{{ __('NIP Lama') }}">
                                            @error('nip_lama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('Cari Pegawai') }}</button>
                                <button type="reset" class="btn btn-outline-primary">{{ __('Reset') }}</button>
                            </form>

                            @if ($employee)
                                @foreach ($employee as $employee)
                                    <div class="col-lg-12 mt-5">
                                        <h2>{{ $employee->nama }}</h2>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>NIP Baru : {{ $employee->nip_baru }}</td>
                                                </tr>
                                                <tr>
                                                    <td>NIP Lama : @if ($employee->nip_baru == $employee->nip)
                                                            -
                                                        @else
                                                            {{ $employee->nip }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Instansi : {{ $employee->agency->n_dinas }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="my-4">
                                        <a class="btn btn-outline-primary"
                                            href="{{ route('promotion.step1') }}">Sebelumnya</a>
                                        <a class="btn btn-primary" href="{{ route('promotion.step3') }}">Berikutnya</a>
                                    </div>
                                @endforeach
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
