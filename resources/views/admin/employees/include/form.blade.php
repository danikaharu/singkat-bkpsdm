<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="unit">{{ __('Unit Kerja') }}</label>
            <select id="selectUnit" class="form-select" name="unit_id">
                <option disabled selected>-- Pilih Instansi --</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->k_unor }}"
                        {{ isset($employee) && $employee->k_unor == $unit->k_unor ? 'selected' : (old('n_unor') == $unit->n_unor ? 'selected' : '') }}>
                        {{ $unit->n_unor }}</option>
                @endforeach
            </select>
            @error('unit')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
