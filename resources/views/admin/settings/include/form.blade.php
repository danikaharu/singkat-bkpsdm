<div class="row mb-2">
    {{-- <div class="col-md-6">
        <div class="form-group">
            <label for="period_1">{{ __('Periode 1') }}</label>
            <select class="form-select" name="period_1" id="period_1">
                <option disabled selected>-- Pilih Periode --</option>
                <option value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="Juni">Juni</option>
                <option value="Juli">Juli</option>
                <option value="Agustus">Agustus</option>
                <option value="September">September</option>
                <option value="Oktober">Oktober</option>
                <option value="November">November</option>
                <option value="Desember">Desember</option>
            </select>
            @error('period_1')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="period_2">{{ __('Periode 2') }}</label>
            <select class="form-select" name="period_2" id="period_2">
                <option disabled selected>-- Pilih Periode --</option>
                <option value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="Juni">Juni</option>
                <option value="Juli">Juli</option>
                <option value="Agustus">Agustus</option>
                <option value="September">September</option>
                <option value="Oktober">Oktober</option>
                <option value="November">November</option>
                <option value="Desember">Desember</option>
            </select>
            @error('period_2')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div> --}}

    @isset($setting)
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="period_1">{{ __('Periode 1') }}</label>
                    <select class="form-select" name="period_1" id="period_1">
                        <option disabled selected>-- Pilih Periode --</option>
                        <option value="Januari"
                            {{ isset($setting) && $setting->period_1 == 'Januari' ? 'selected' : (old('period_1') == 'Januari' ? 'selected' : '') }}>
                            Januari</option>
                        <option value="Februari"
                            {{ isset($setting) && $setting->period_1 == 'Februari' ? 'selected' : (old('period_1') == 'Februari' ? 'selected' : '') }}>
                            Februari</option>
                        <option value="Maret"
                            {{ isset($setting) && $setting->period_1 == 'Maret' ? 'selected' : (old('period_1') == 'Maret' ? 'selected' : '') }}>
                            Maret</option>
                        <option value="April"
                            {{ isset($setting) && $setting->period_1 == 'April' ? 'selected' : (old('period_1') == 'April' ? 'selected' : '') }}>
                            April</option>
                        <option value="Mei"
                            {{ isset($setting) && $setting->period_1 == 'Mei' ? 'selected' : (old('period_1') == 'Mei' ? 'selected' : '') }}>
                            Mei</option>
                        <option value="Juni"
                            {{ isset($setting) && $setting->period_1 == 'Juni' ? 'selected' : (old('period_1') == 'Juni' ? 'selected' : '') }}>
                            Juni</option>
                        <option value="Juli"
                            {{ isset($setting) && $setting->period_1 == 'Juli' ? 'selected' : (old('period_1') == 'Juli' ? 'selected' : '') }}>
                            Juli</option>
                        <option value="Agustus"
                            {{ isset($setting) && $setting->period_1 == 'Agustus' ? 'selected' : (old('period_1') == 'Agustus' ? 'selected' : '') }}>
                            Agustus</option>
                        <option value="September"
                            {{ isset($setting) && $setting->period_1 == 'September' ? 'selected' : (old('period_1') == 'September' ? 'selected' : '') }}>
                            September</option>
                        <option value="Oktober"
                            {{ isset($setting) && $setting->period_1 == 'Oktober' ? 'selected' : (old('period_1') == 'Oktober' ? 'selected' : '') }}>
                            Oktober</option>
                        <option value="November"
                            {{ isset($setting) && $setting->period_1 == 'November' ? 'selected' : (old('period_1') == 'November' ? 'selected' : '') }}>
                            November</option>
                        <option value="Desember"
                            {{ isset($setting) && $setting->period_1 == 'Desember' ? 'selected' : (old('period_1') == 'Desember' ? 'selected' : '') }}>
                            Desember</option>
                    </select>
                    @error('period_1')
                        <div class="invalid-feedback">
                            <i class="bx bx-radio-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="period_2">{{ __('Periode 2') }}</label>
                    <select class="form-select" name="period_2" id="period_2">
                        <option disabled selected>-- Pilih Periode --</option>
                        <option value="Januari"
                            {{ isset($setting) && $setting->period_2 == 'Januari' ? 'selected' : (old('period_2') == 'Januari' ? 'selected' : '') }}>
                            Januari</option>
                        <option value="Februari"
                            {{ isset($setting) && $setting->period_2 == 'Februari' ? 'selected' : (old('period_2') == 'Februari' ? 'selected' : '') }}>
                            Februari</option>
                        <option value="Maret"
                            {{ isset($setting) && $setting->period_2 == 'Maret' ? 'selected' : (old('period_2') == 'Maret' ? 'selected' : '') }}>
                            Maret</option>
                        <option value="April"
                            {{ isset($setting) && $setting->period_2 == 'April' ? 'selected' : (old('period_2') == 'April' ? 'selected' : '') }}>
                            April</option>
                        <option value="Mei"
                            {{ isset($setting) && $setting->period_2 == 'Mei' ? 'selected' : (old('period_2') == 'Mei' ? 'selected' : '') }}>
                            Mei</option>
                        <option value="Juni"
                            {{ isset($setting) && $setting->period_2 == 'Juni' ? 'selected' : (old('period_2') == 'Juni' ? 'selected' : '') }}>
                            Juni</option>
                        <option value="Juli"
                            {{ isset($setting) && $setting->period_2 == 'Juli' ? 'selected' : (old('period_2') == 'Juli' ? 'selected' : '') }}>
                            Juli</option>
                        <option value="Agustus"
                            {{ isset($setting) && $setting->period_2 == 'Agustus' ? 'selected' : (old('period_2') == 'Agustus' ? 'selected' : '') }}>
                            Agustus</option>
                        <option value="September"
                            {{ isset($setting) && $setting->period_2 == 'September' ? 'selected' : (old('period_2') == 'September' ? 'selected' : '') }}>
                            September</option>
                        <option value="Oktober"
                            {{ isset($setting) && $setting->period_2 == 'Oktober' ? 'selected' : (old('period_2') == 'Oktober' ? 'selected' : '') }}>
                            Oktober</option>
                        <option value="November"
                            {{ isset($setting) && $setting->period_2 == 'November' ? 'selected' : (old('period_2') == 'November' ? 'selected' : '') }}>
                            November</option>
                        <option value="Desember"
                            {{ isset($setting) && $setting->period_2 == 'Desember' ? 'selected' : (old('period_2') == 'Desember' ? 'selected' : '') }}>
                            Desember</option>
                    </select>
                    @error('period_2')
                        <div class="invalid-feedback">
                            <i class="bx bx-radio-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    @endisset
</div>
