<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <select id="selectEmployee" class="form-select" name="name" id="name">
                <option disabled selected>-- Pilih Pegawai --</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->nip_baru }}"
                        {{ isset($user) && $user->name == $employee->nama ? 'selected' : (old('name') == $employee->nama ? 'selected' : '') }}>
                        {{ $employee->nama }}</option>
                @endforeach
            </select>
            @error('name')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="username">{{ __('Username') }}</label>
            <input type="text" name="username" id="username"
                class="form-control @error('username') is-invalid @enderror" placeholder="{{ __('Username') }}"
                value="{{ isset($user) ? $user->username : old('username') }}" autocomplete="username" readonly>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}"
                value="{{ isset($user) ? $user->email : old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="unit">{{ __('Unit Kerja') }}</label>
            <select id="selectUnit" class="form-select" name="unit_id">
                <option disabled selected>-- Pilih Instansi --</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->k_unor }}"
                        {{ isset($user) && $user->unit_id == $unit->k_unor ? 'selected' : (old('n_unor') == $unit->n_unor ? 'selected' : '') }}>
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

    <div class="col-md-6">
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}"
                autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="password-confirmation">{{ __('Konfimarsi Password') }}</label>
            <input type="password" name="password_confirmation" id="password-confirmation" class="form-control"
                placeholder="{{ __('Password Confirmation') }}" autocomplete="new-password">
        </div>
    </div>

    @empty($user)
        <div class="col-md-6">
            <div class="form-group">
                <label for="role">{{ __('Role') }}</label>
                <select class="form-select" name="role" id="role">
                    <option selected disabled>-- Select role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')
                    <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    @endempty

    @isset($user)
        <div class="col-md-6">
            <div class="form-group">
                <label for="role">{{ __('Role') }}</label>
                <select class="form-select" name="role" id="role">
                    <option selected disabled>{{ __('-- Pilih role --') }}</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ $user->getRoleNames()->toArray() !== [] && $user->getRoleNames()[0] == $role->name ? 'selected' : '-' }}>
                            {{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')
                    <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    @endisset
</div>
