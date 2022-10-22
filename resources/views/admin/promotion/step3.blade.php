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
                                    <a class="nav-link active" id="upload-tab" data-bs-toggle="tab" href="#upload"
                                        role="tab" aria-controls="upload" aria-selected="true">Unggah Dokumen</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="upload" role="tabpanel"
                                    aria-labelledby="upload-tab">
                                    <form action="{{ route('promotion.storeStep3') }}" method="POST"
                                        enctype="multipart/form-data" class="dropzone">
                                        @csrf
                                        @method('POST')

                                        <div class="row mb-2 mt-5">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="sk_cpns">{{ __('SK CPNS') }} <span
                                                                    class="text-danger"> &#42;</span></label>
                                                            <input type="file" name="sk_cpns" id="sk_cpns"
                                                                class="form-control @error('sk_cpns') is-invalid @enderror">
                                                            @error('sk_cpns')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="sk_pns">{{ __('SK PNS') }} <span
                                                                    class="text-danger"> &#42;</span></label>
                                                            <input type="file" name="sk_pns" id="sk_pns"
                                                                class="form-control @error('sk_pns') is-invalid @enderror">
                                                            @error('sk_pns')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="sk_pangkat_terakhir">{{ __('SK Pangkat Terakhir') }}
                                                                <span class="text-danger"> &#42;</span></label>
                                                            <input type="file" name="sk_pangkat_terakhir"
                                                                id="sk_pangkat_terakhir"
                                                                class="form-control @error('sk_pangkat_terakhir') is-invalid @enderror">
                                                            @error('sk_pangkat_terakhir')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="kartu_pegawai">{{ __('Kartu Pegawai') }}
                                                                <span class="text-danger"> &#42;</span></label>
                                                            <input type="file" name="kartu_pegawai" id="kartu_pegawai"
                                                                class="form-control @error('kartu_pegawai') is-invalid @enderror">
                                                            @error('kartu_pegawai')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @if ($promotion->promotion_type == 2)
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="ijazah_lama">{{ __('Ijazah Lama Sesuai SK Pangkat Terakhir') }}
                                                                    <span class="text-danger"> &#42;</span>
                                                                </label>
                                                                <input type="file" name="ijazah_lama" id="ijazah_lama"
                                                                    class="form-control @error('ijazah_lama') is-invalid @enderror">
                                                                @error('ijazah_lama')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="ijazah_baru">{{ __('Ijazah Terakhir') }}
                                                                <span class="text-danger"> &#42;</span></label>
                                                            <input type="file" name="ijazah_baru" id="ijazah_baru"
                                                                class="form-control @error('ijazah_baru') is-invalid @enderror">
                                                            @error('ijazah_baru')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @if ($promotion->promotion_type == 2)
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="transkrip_lama">{{ __('Transkrip Nilai Lama') }}
                                                                    <span class="text-danger"> &#42;</span>
                                                                </label>
                                                                <input type="file" name="transkrip_lama"
                                                                    id="transkrip_lama"
                                                                    class="form-control @error('transkrip_lama') is-invalid @enderror">
                                                                @error('transkrip_lama')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="transkrip_baru">{{ __('Transkrip Nilai Terakhir') }}
                                                                <span class="text-danger"> &#42;</span></label>
                                                            <input type="file" name="transkrip_baru"
                                                                id="transkrip_baru"
                                                                class="form-control @error('transkrip_baru') is-invalid @enderror">
                                                            @error('transkrip_baru')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="skp_lama">SKP Tahun
                                                                {{ \Carbon\Carbon::now()->subYear()->isoFormat('Y') }}
                                                                <span class="text-danger"> &#42;</span></label>
                                                            <input type="file" name="skp_lama" id="skp_lama"
                                                                class="form-control @error('skp_lama') is-invalid @enderror">
                                                            @error('skp_lama')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="skp_baru">SKP
                                                                Tahun
                                                                {{ \Carbon\Carbon::today()->isoFormat('Y') }}
                                                                <span class="text-danger"> &#42;</span></label>
                                                            <input type="file" name="skp_baru" id="skp_baru"
                                                                class="form-control @error('skp_baru') is-invalid @enderror">
                                                            @error('skp_baru')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="sttpl">{{ __('STTPL') }} </label>
                                                            <input type="file" name="sttpl" id="sttpl"
                                                                class="form-control @error('sttpl') is-invalid @enderror">
                                                            @error('sttpl')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="sk_mutasi">{{ __('SK Mutasi') }} </label>
                                                            <input type="file" name="sk_mutasi" id="sk_mutasi"
                                                                class="form-control @error('sk_mutasi') is-invalid @enderror">
                                                            @error('sk_mutasi')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="sk_pengalihan">{{ __('SK Pengalihan Jenis Pegawai dari BKN') }}</label>
                                                            <input type="file" name="sk_pengalihan" id="sk_pengalihan"
                                                                class="form-control @error('sk_pengalihan') is-invalid @enderror">
                                                            @error('sk_pengalihan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @if ($promotion->promotion_type == 4)
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="sk_fungsional">{{ __('SK Jabatan Fungsional (Inpassing)') }}</label>
                                                                <input type="file" name="sk_fungsional"
                                                                    id="sk_fungsional"
                                                                    class="form-control @error('sk_fungsional') is-invalid @enderror">
                                                                @error('sk_fungsional')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="pak_asli">{{ __('PAK Asli') }} <span
                                                                        class="text-danger"> &#42;</span></label>
                                                                <input type="file" name="pak_asli" id="pak_asli"
                                                                    class="form-control @error('pak_asli') is-invalid @enderror">
                                                                @error('pak_asli')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="pak_lama">{{ __('PAK Lama') }} <span
                                                                        class="text-danger"> &#42;</span></label>
                                                                <input type="file" name="pak_lama" id="pak_lama"
                                                                    class="form-control @error('pak_lama') is-invalid @enderror">
                                                                @error('pak_lama')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="sk_penyesuaian_fungsional">{{ __('SK Penyesuaian Jabatan Fungsional') }}
                                                                    <span class="text-danger"> &#42;</span></label>
                                                                <input type="file" name="sk_penyesuaian_fungsional"
                                                                    id="sk_penyesuaian_fungsional"
                                                                    class="form-control @error('sk_penyesuaian_fungsional') is-invalid @enderror">
                                                                @error('sk_penyesuaian_fungsional')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="sk_kenaikan_fungsional">{{ __('SK Kenaikan Jabatan Fungsional') }}
                                                                    <span class="text-danger"> &#42;</span></label>
                                                                <input type="file" name="sk_kenaikan_fungsional"
                                                                    id="sk_kenaikan_fungsional"
                                                                    class="form-control @error('sk_kenaikan_fungsional') is-invalid @enderror">
                                                                @error('sk_kenaikan_fungsional')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($promotion->promotion_type == 3)
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="sertifikat_pim">{{ __('Sertifikat PIM') }}
                                                                    <span class="text-danger"> &#42;</span></label>
                                                                <input type="file" name="sertifikat_pim"
                                                                    id="sertifikat_pim"
                                                                    class="form-control @error('sertifikat_pim') is-invalid @enderror">
                                                                @error('sertifikat_pim')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="surat_pelantikan">{{ __('Surat Pernyataan Pelantikan') }}
                                                                    <span class="text-danger"> &#42;</span></label>
                                                                <input type="file" name="surat_pelantikan"
                                                                    id="surat_pelantikan"
                                                                    class="form-control @error('surat_pelantikan') is-invalid @enderror">
                                                                @error('surat_pelantikan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="surat_lowong">{{ __('Surat Menduduki Jabatan Lowong') }}
                                                                    <span class="text-danger"> &#42;</span>
                                                                </label>
                                                                <input type="file" name="surat_lowong"
                                                                    id="surat_lowong"
                                                                    class="form-control @error('surat_lowong') is-invalid @enderror">
                                                                @error('surat_lowong')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="surat_tugas">{{ __('Surat Pernyataan Melaksanakan Tugas') }}<span
                                                                        class="text-danger"> &#42;</span></label>
                                                                <input type="file" name="surat_tugas" id="surat_tugas"
                                                                    class="form-control @error('surat_tugas') is-invalid @enderror">
                                                                @error('surat_tugas')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="sk_pelantikan">{{ __('Semua SK Pelantikan yang pernah diduduki') }}
                                                                    <span class="text-danger"> &#42;</span></label>
                                                                <input type="file" name="sk_pelantikan"
                                                                    id="sk_pelantikan"
                                                                    class="form-control @error('sk_pelantikan') is-invalid @enderror">
                                                                @error('sk_pelantikan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="sk_jabatan">{{ __('SK Jabatan') }}
                                                                    <span class="text-danger"> &#42;</span></label>
                                                                <input type="file" name="sk_jabatan" id="sk_jabatan"
                                                                    class="form-control @error('sk_jabatan') is-invalid @enderror">
                                                                @error('sk_jabatan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($promotion->promotion_type == 2)
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="sk_belajar">{{ __('SK Tugas/Ijin Belajar') }}
                                                                    <span class="text-danger"> &#42;</span></label>
                                                                <input type="file" name="sk_belajar" id="sk_belajar"
                                                                    class="form-control @error('sk_belajar') is-invalid @enderror">
                                                                @error('sk_belajar')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
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
