@extends('layouts.admin')

@section('title', trans('Buat Usulan Kenaikan Pangkat'))


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Kenaikan Pangkat') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Buat usulan kenaikan pangkat') }}
                    </p>
                </div>

            </div>
        </div>

        <section class="section">
            <div class="row">
                @if ($employee)
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
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
                        </div>

                    </div>
                @else
                @endif

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="preview-tab" data-bs-toggle="tab" href="#preview" role="tab"
                                        aria-controls="preview" aria-selected="false" tabindex="-1">Preview Dokumen</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="preview" role="tabpanel"
                                    aria-labelledby="preview-tab">
                                    <div class="accordion accordion-flush mt-3" id="accordionFlushDocument">
                                        @foreach ($files as $item)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapse1"
                                                        aria-expanded="false" aria-controls="flush-collapse1">
                                                        SK CPNS
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse1" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushDocument">
                                                    <div class="accordion-body">
                                                        <iframe
                                                            src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_cpns }} "
                                                            frameborder="0" width='100%' height='300' allowfullscreen
                                                            webkitallowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapse2"
                                                        aria-expanded="false" aria-controls="flush-collapse2">
                                                        SK PNS
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse2" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushDocument">
                                                    <div class="accordion-body">
                                                        <iframe
                                                            src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_pns }} "
                                                            frameborder="0" width='100%' height='300' allowfullscreen
                                                            webkitallowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapse3"
                                                        aria-expanded="false" aria-controls="flush-collapse3">
                                                        SK Pangkat Terakhir
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse3" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushDocument">
                                                    <div class="accordion-body">
                                                        <iframe
                                                            src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_pangkat_terakhir }} "
                                                            frameborder="0" width='100%' height='300' allowfullscreen
                                                            webkitallowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapse4"
                                                        aria-expanded="false" aria-controls="flush-collapse4">
                                                        Kartu Pegawai
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse4" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushDocument">
                                                    <div class="accordion-body">
                                                        <iframe
                                                            src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->kartu_pegawai }} "
                                                            frameborder="0" width='100%' height='300' allowfullscreen
                                                            webkitallowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($item->ijazah_lama)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse5"
                                                            aria-expanded="false" aria-controls="flush-collapse5">
                                                            Ijazah Lama
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse5" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->ijazah_lama }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapse6"
                                                        aria-expanded="false" aria-controls="flush-collapse6">
                                                        Ijazah Terbaru
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse6" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushDocument">
                                                    <div class="accordion-body">
                                                        <iframe
                                                            src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->ijazah_baru }} "
                                                            frameborder="0" width='100%' height='300' allowfullscreen
                                                            webkitallowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($item->transkrip_lama)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse7"
                                                            aria-expanded="false" aria-controls="flush-collapse7">
                                                            Transkrip Nilai Lama
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse7" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->transkrip_lama }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapse8"
                                                        aria-expanded="false" aria-controls="flush-collapse8">
                                                        Transkrip Nilai Terakhir
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse8" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushDocument">
                                                    <div class="accordion-body">
                                                        <iframe
                                                            src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->transkrip_baru }} "
                                                            frameborder="0" width='100%' height='300' allowfullscreen
                                                            webkitallowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapse9"
                                                        aria-expanded="false" aria-controls="flush-collapse9">
                                                        SKP Tahun 2021
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse9" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushDocument">
                                                    <div class="accordion-body">
                                                        <iframe
                                                            src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->skp_lama }} "
                                                            frameborder="0" width='100%' height='300' allowfullscreen
                                                            webkitallowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapse10"
                                                        aria-expanded="false" aria-controls="flush-collapse10">
                                                        SKP Tahun 2022
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse10" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushDocument">
                                                    <div class="accordion-body">
                                                        <iframe
                                                            src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->skp_baru }} "
                                                            frameborder="0" width='100%' height='300' allowfullscreen
                                                            webkitallowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($item->sttpl)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse11"
                                                            aria-expanded="false" aria-controls="flush-collapse11">
                                                            STTPL
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse11" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sttpl }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->sk_mutasi)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse12"
                                                            aria-expanded="false" aria-controls="flush-collapse12">
                                                            SK Mutasi
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse12" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_mutasi }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->sk_pengalihan)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse13"
                                                            aria-expanded="false" aria-controls="flush-collapse13">
                                                            SK Pengalihan Jenis Pegawai dari BKN
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse13" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_pengalihan }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->sk_fungsional)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse14"
                                                            aria-expanded="false" aria-controls="flush-collapse14">
                                                            SK Jabatan Fungsional (Inpassing)
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse14" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_fungsional }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->pak_asli)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse15"
                                                            aria-expanded="false" aria-controls="flush-collapse15">
                                                            PAK Asli
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse15" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->pak_asli }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->pak_lama)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse16"
                                                            aria-expanded="false" aria-controls="flush-collapse16">
                                                            PAK Lama
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse16" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->pak_lama }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->sk_penyesuaian_fungsional)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse17"
                                                            aria-expanded="false" aria-controls="flush-collapse17">
                                                            SK Penyesuaian Fungsional
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse17" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_penyesuaian_fungsional }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->sk_kenaikan_fungsional)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse18"
                                                            aria-expanded="false" aria-controls="flush-collapse18">
                                                            SK Kenaikan Fungsional
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse18" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_kenaikan_fungsional }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->sertifikat_pim)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse19"
                                                            aria-expanded="false" aria-controls="flush-collapse19">
                                                            Sertifikat PIM
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse19" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sertifikat_pim }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->surat_pelantikan)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse20"
                                                            aria-expanded="false" aria-controls="flush-collapse20">
                                                            Surat Pernyataan Pelantikan
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse20" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->surat_pelantikan }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->surat_lowong)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse21"
                                                            aria-expanded="false" aria-controls="flush-collapse21">
                                                            Surat Menduduki Jabatan Lowong
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse21" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->surat_lowong }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->surat_tugas)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse22"
                                                            aria-expanded="false" aria-controls="flush-collapse22">
                                                            Surat Pernyataan Melaksanankan Tugas
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse22" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->surat_tugas }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->surat_pelantikan)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse23"
                                                            aria-expanded="false" aria-controls="flush-collapse23">
                                                            Semua SK Pelantikan yang pernah diduduki
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse23" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_pelantikan }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->sk_jabatan)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse24"
                                                            aria-expanded="false" aria-controls="flush-collapse24">
                                                            SK Jabatan
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse24" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_jabatan }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->sk_belajar)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse25"
                                                            aria-expanded="false" aria-controls="flush-collapse25">
                                                            SK Tugas/Ijin Belajar
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse25" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_belajar }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->sk_lulus_ujian)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse25"
                                                            aria-expanded="false" aria-controls="flush-collapse25">
                                                            SK Lulus Ujian Dinas
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse25" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_belajar }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->uraian_tugas)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse25"
                                                            aria-expanded="false" aria-controls="flush-collapse25">
                                                            SK Perincian Tugas sesuai Tupoksi atau disiplin
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse25" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_belajar }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->lainnya)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse25"
                                                            aria-expanded="false" aria-controls="flush-collapse25">
                                                            Dokumen Lainnya
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse25" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushDocument">
                                                        <div class="accordion-body">
                                                            <iframe
                                                                src="{{ asset('ViewerJS/#../') }}/storage/upload/berkas/{{ $item->sk_belajar }} "
                                                                frameborder="0" width='100%' height='300'
                                                                allowfullscreen webkitallowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
