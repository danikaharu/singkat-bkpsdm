@extends('layouts.admin')

@section('title', trans('Kenaikan Pangkat'))

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Kenaikan Pangkat') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('List Kenaikan Pangkat.') }}
                    </p>
                </div>
                <div class="col-12 col-md-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Kenaikan Pangkat
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="filter_nip">{{ __('NIP PNS') }}</label>
                                        <input type="text" id="filter_nip" class="form-control" name="filter_nip"
                                            id="filter_nip">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="filter_name">{{ __('Nama PNS') }}</label>
                                        <input type="text" id="filter_name" class="form-control" name="filter_name"
                                            id="filter_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="filter_promotion">{{ __('Jenis Kenaikan Pangkat') }}</label>
                                        <select id="filter_promotion" class="form-select" name="filter_promotion"
                                            id="filter_promotion">
                                            <option disabled selected>-- Pilih Jenis KP --</option>
                                            <option value="1">Reguler</option>
                                            <option value="2">Memperoleh Ijazah/Penyesuaian Ijazah</option>
                                            <option value="3">Struktural</option>
                                            <option value="4">Jabatan Fungsional Tertentu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="filter_status">{{ __('Status Usulan') }}</label>
                                        <select id="filter_status" class="form-select" name="filter_status"
                                            id="filter_status">
                                            <option disabled selected>-- Pilih Status --</option>
                                            <option value="1">Input Berkas</option>
                                            <option value="2">Berkas Disimpan (Terverifikasi)</option>
                                            <option value="3">Approval Surat Usulan</option>
                                            <option value="4">Perbaikan Dokumen</option>
                                            <option value="5">Usulan Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button id="filter" type="submit" class="btn btn-primary">Cari</button>
                            <button id="reset" type="reset" class="btn btn-outline-primary">Reset</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="button" id="btnDetailApprove" class="btn btn-primary my-3 d-none"
                        onclick="detailApprove()">Selanjutnya</button>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            {{-- <th><input type="checkbox" id="head-cb"></th> --}}
                                            <th>{{ __('NIP') }}</th>
                                            <th>{{ __('Nama') }}</th>
                                            <th>{{ __('Jenis Kenaikan Pangkat') }}</th>
                                            <th>{{ __('Tanggal Usulan') }}</th>
                                            <th>{{ __('Status Usulan') }}</th>
                                            <th>{{ __('Aksi') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    <script>
        let checkOne = 0;

        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('promotion.getEmployee') }}",
                type: 'GET',
                data: function(d) {
                    d.filter_promotion = $('#filter_promotion').val();
                    d.filter_name = $('#filter_name').val();
                    d.filter_status = $('#filter_status').val();
                    d.filter_nip = $('#filter_nip').val();
                }
            },
            columns: [
                // {
                //     searchable: false,
                //     orderable: false,
                //     sortable: false,
                //     render: function(data, type, row) {
                //         return `<input type="checkbox" class="cb-child" value="${row.id}">`;
                //     }
                // },
                {
                    data: 'nip',
                    name: 'employee.nip_baru'
                },
                {
                    data: 'nama',
                    name: 'employee.nama'
                },
                {
                    data: 'promotion_type',
                    name: 'promotion_type'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        return '<span class="badge bg-primary badge-md">' + data + '</span>'
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });


        $('#filter').click(function() {
            $('#data-table').DataTable().draw(true);
        });

        $('#reset').click(function() {
            $('#filter_promotion').val('');
            $('#filter_status').val('');
            $('#filter_name').val('');
            $('#filter_nip').val('');
        })



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

        // $(document).ready(function() {
        //     $("#head-cb").on('click', function() {
        //         var isChecked = $("#head-cb").prop('checked')
        //         $(".cb-child").prop('checked', isChecked)
        //         if (isChecked == true) {
        //             $("#btnDetailApprove").removeClass("d-none")
        //         } else {
        //             $("#btnDetailApprove").addClass("d-none")
        //         }
        //     })

        //     $("#data-table tbody").on('click', '.cb-child', function() {
        //         if ($(this).prop('checked') != true) {
        //             $('#head-cb').prop('checked', false)
        //         }

        //         let allCheckbox = $("#data-table tbody .cb-child:checked")
        //         if (allCheckbox.length > 0) {
        //             $("#btnDetailApprove").removeClass("d-none")
        //         } else {
        //             $("#btnDetailApprove").addClass("d-none")
        //         }
        //     })

        // })

        // function detailApprove() {
        //     let choosenCheckbox = $("#data-table tbody .cb-child:checked")
        //     let allId = [];

        //     $.each(choosenCheckbox, function(index, elm) {
        //         allId.push(elm.value);
        //     })

        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: "/admin/promotion/detail",
        //         type: "POST",
        //         data: {
        //             id: allId
        //         },
        //         success: function(data) {
        //             $('#detailApprove').html(data);
        //         }
        //     })
        // }
    </script>
@endpush
