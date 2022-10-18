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

                            <form action="{{ route('promotion.cancel', $promotion->id) }}" method="post" class="d-inline"
                                role="alert" alert-title="Apakah anda yakin ingin mengirim data ini?"
                                alert-text="Dengan mengirim data ini berarti anda menolak persetujuan usulan yang Anda Periksa">
                                @csrf

                                <div class="mb-3">
                                    <label for="reason" class="form-label">Alasan Pembatalan</label>
                                    <input type="text" id="reason" name="reason"
                                        class="form-control @error('reason')
                                        is-invalid
                                    @enderror">
                                    @error('reason')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="additional_information" class="form-label">Keterangan Tambahan</label>
                                    <textarea cols="10" rows="5" name="additional_information"
                                        class="form-control @error('additional_information')
                                    is-invalid
                                @enderror">
                                    </textarea>
                                    @error('additional_information')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
                                <button type="submit" class="btn btn-outline-danger">
                                    Kirim
                                </button>
                            </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        // Sweet Alert Delete
        $("body").on('submit', `form[role='alert']`, function(event) {
            event.preventDefault();

            Swal.fire({
                title: $(this).attr('alert-title'),
                text: $(this).attr('alert-text'),
                icon: "warning",
                allowOutsideClick: false,
                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonText: "Hapus",
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            })
        });
    </script>
@endpush
