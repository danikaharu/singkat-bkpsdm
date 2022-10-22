@extends('layouts.admin')

@section('title', trans('Buat Usulan Kenaikan Pangkat'))

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

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
                                            <label for="name">{{ __('Nama Pegawai') }}</label>
                                            <select id="selectEmployee" class="form-select" name="name">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nip">{{ __('NIP') }}</label>
                                            <input type="text" name="nip_baru" id="nip_baru" class="form-control"
                                                placeholder="{{ __('NIP') }}" readonly>

                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('Cari Pegawai') }}</button>
                                <button type="reset" class="btn btn-outline-primary">{{ __('Reset') }}</button>
                            </form>


                            @if ($employee)
                                @foreach ($employee as $data)
                                    <div class="col-lg-12 mt-5">
                                        <h2>{{ $data->nama }}</h2>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>NIP Baru : {{ $data->nip_baru }}</td>
                                                </tr>
                                                <tr>
                                                    <td>NIP Lama : @if ($data->nip_baru == $data->nip)
                                                            -
                                                        @else
                                                            {{ $data->nip }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Instansi : {{ $data->agency->n_dinas }}</td>
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#selectEmployee').select2({
                allowClear: true,
                placeholder: 'Pilih Pegawai',
                ajax: {
                    url: "{{ route('employee.select') }}",
                    delay: 250,
                    processResults: function({
                        data
                    }) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.nip_baru,
                                    text: item.nama,
                                }
                            })
                        }

                    }
                }
            })

            $('#selectEmployee').change(function() {
                let name = $('#selectEmployee').val();
                $('#nip_baru').val(name);
            })
        });
    </script>
@endpush
