@extends('layouts.auth')

@section('title', trans('Log in'))

@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin') }}/css/pages/auth.css">
@endpush

@section('content')
    <div class="row h-100">
        <div class="col-lg-6 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    {{-- <a href="#">
                        <img src="{{ asset('template/admin') }}/images/logo/logo1.svg" alt="Logo">
                    </a> --}}
                </div>
                <h1 class="auth-title">{{ __('SINGKAT') }}</h1>
                <p class="auth-subtitle mb-5">
                    Sistem Informasi Kenaikan Pangkat BKPSDM Bone Bolango
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible show fade">
                        <ul class="ms-0 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>
                                    <p>{{ $error }}</p>
                                </li>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible show fade">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl @error('username') is-invalid @enderror"
                            name="username" autocomplete="username" placeholder="Username" autofocus>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror"
                            placeholder="Password" name="password" autocomplete="current-password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">{{ __('Log in') }}</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div id="auth-right">
                <h3 class="text-white text-center">Syarat Syarat Kenaikan Pangkat</h3>
                <div style="color:white;">
                    <p>Syarat Umum</p>
                    <ol style="list-style:none;list-style-type: number;">
                        <li>SK CPNS (Legalisir BKPSDM)</li>
                        <li>SK PNS (Legalisir BKPSDM)</li>
                        <li>SK Pangkat Terakhir (Legalisir BKPSDM)</li>
                        <li>Ijazah terakhir dan transkrip nilai yang (dilegalisir) oleh Kampus atau Sekolah</li>
                        <li>STTPL bagi yang baru pertama kali mengurus Kenaikan Pangkat (Legalisir BKPSDM)</li>
                        <li>SK Mutasi bagi yang pernah dimutasikan </li>
                        <li>SK Pengalihan Jenis Pegawai dari
                            Badan Kepegawaian Negara bagi Pegawai Negeri Sipil yang pindah antar Provinsi (Legalisir BKPSDM)
                        </li>
                        <li>SK Gubernur bagi Pegawai Negeri Sipil yang pindah dari Daerah lain dalam satu Provinsi
                            (Legalisir BKPSDM)
                        </li>
                    </ol>
                </div>
                <div style="color:white;">
                    <p>Kenaikan Pangkat Otomatis atau Reguler</p>
                    <ol style="list-style:none;list-style-type: number;">
                        <li>Sasaran Kerja Pegawai (SKP) Tahun 2021 dan 2022 yang dilegalisir oleh Kasubag
                            Kepegawaian masing-masing SKPD/Kepala Sekolah/Kepala UPTD
                        </li>
                    </ol>
                </div>
                <div style="color:white;">
                    <p>Jabatan Struktural</p>
                    <ol style="list-style:none;list-style-type: number;">
                        <li>Sertifikat PIM Bagi yang penah mengikuti Diklat (Legalisir BKPSDM)
                        </li>
                        <li>Sasaran Kerja Pegawai (SKP) Tahun 2021 dan 2022 yang dilegalisir oleh Kasubag
                            Kepegawaian masing-masing SKPD/Kepala Sekolah/Kepala UPTD
                        </li>
                        <li>SK Jabatan (Legalisir BKPSDM),</li>
                        <li>Surat Pernyataan Pelantikan (Legalisir BKPSDM)</li>
                        <li>Surat Menduduki Jabatan Lowong (Legalisir BKPSDM)</li>
                        <li>Surat Pernyataan Melaksanakan Tugas (Legalisir BKPSDM)</li>
                        <li>Semua SK Pelantikan yang pernah diduduki (Legalisir BKPSDM)</li>
                    </ol>
                </div>
                <div style="color:white;">
                    <p>Jabatan Fungsional Tertentu</p>
                    <ol style="list-style:none;list-style-type: number;">
                        <li>PAK ASLI (Legalisir)
                        </li>
                        <li>PAK LAMA (Legalisir Dikbud)
                        </li>
                        <li>SK Jabatan Fungsional (inpassing) bagi yang baru pertama kali mengurus
                            Kenaikan Pagkat (Legalisir BKPSDM)
                        </li>
                        <li>SK Asli Penyesuaian Jabatan Fungsional</li>
                        <li>SK Asli kenaikan dalam jabatan fungsional</li>
                    </ol>
                </div>
                <div style="color:white;">
                    <p>Penyesuaian Ijazah (Fungsional Umum)</p>
                    <ol style="list-style:none;list-style-type: number;">
                        <li>SK tentang pemberian Tugas Belajar/Ijin Belajar (Legalisir BKPSDM)
                        </li>
                        <li>Surat Keterangan Lulus Ujian Dinas (Legalisir BKPSDM)
                        </li>
                        <li>Surat Keterangan Perincian Tugas sesuai Tupoksi dan disiplin ilmu yang ditanda tangani oleh
                            Pejabat Esselon II (Asli)
                        </li>
                        <li>Ijazah/transkrip nilai lama sesuai pada SK pangkat terakhir (dilegalisir) oleh kampus
                            atau sekolah
                        </li>
                        <li>Ijazah terakhir/transkrip nilai baru yang (dilegalisir) oleh kampus atau sekolah</li>
                    </ol>
                </div>
                <div style="color:white;">
                    <p>Penyesuaian Ijazah (Fungsional Tertentu)</p>
                    <ol style="list-style:none;list-style-type: number;">
                        <li>PAK ASLI (Legalisir)
                        </li>
                        <li>PAK LAMA (Legalisir Dikbud)
                        </li>
                        <li>SK Jabatan Fungsional (inpassing) bagi yang baru pertama kali mengurus
                            Kenaikan Pagkat (Legalisir BKPSDM)
                        </li>
                        <li>SK Asli Penyesuaian Jabatan Fungsional
                        </li>
                        <li>SK Asli kenaikan dalam jabatan fungsional
                        </li>
                        <li>Ijazah/transkrip nilai lama sesuai pada SK pangkat terakhir (dilegalisir) oleh kampus
                            atau sekolah
                        </li>
                        <li>SK tentang pemberian Tugas Belajar/Ijin Belajar (Legalisir BKPSDM)
                        </li>
                        <li>Ijazah terakhir/transkrip nilai baru yang (dilegalisir) oleh kampus atau sekolah</li>
                    </ol>
                </div>
                <div style="color:white;">
                    <p>Pegawai Negeri Sipil usul Kenaikan Pangkat dari Pangkat/Gol. Ruang Pengatur Tkt. I / II D ke
                        Pangkat/Gol. Ruang Penata Muda / III A melampirkan foto copy sertifikat Ujian Dinas Tingkat I (satu)
                        atau sertifikasi PIM IV dan Pangkat/Gol. Ruang Penata Tkt. I / III D ke Pangkat/Gol. Ruang Pembina /
                        IV A melampirkan foto copy sertifikat Ujian Dinas Tingkat II (dua) atau sertifikat PIM II.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
