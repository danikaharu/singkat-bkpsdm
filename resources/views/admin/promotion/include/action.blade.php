<td>
    @can('show promotions')
        <a href="{{ route('promotion.show', $model->id) }}" class="btn btn-outline-success btn-sm mb-2">
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    @can('edit promotions')
        <a href="{{ route('promotion.edit', $model->id) }}" class="btn btn-outline-primary btn-sm mb-2">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan

    @if ($model->status == 1 || $model->status == 2)
        @can('choose verificator')
            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal"
                data-bs-target="#selectVerificatorModal{{ $model->id }}">
                <i class="fa-solid fa-user-check"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="selectVerificatorModal{{ $model->id }}" tabindex="-1"
                aria-labelledby="selectVerificatorModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="selectVerificatorModalLabel">Verifikator untuk menilai usulan
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('promotion.storeVerificator', $model->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id">
                                <select name="verificator_id" class="form-select">
                                    <option disabled selected>-- Pilih Verifikator --</option>
                                    @foreach ($verificators as $verificator)
                                        <option value="{{ $verificator->id }}"
                                            {{ isset($model) && $model->verificator_id == $verificator->id ? 'selected' : (old('verificator_id') == $verificator->id ? 'selected' : '') }}>
                                            {{ $verificator->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    @endif

    @if ($model->status == 3)
        @can('choose admins')
            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal"
                data-bs-target="#selectAdminModal{{ $model->id }}">
                <i class="fa-solid fa-user-check"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="selectAdminModal{{ $model->id }}" tabindex="-1"
                aria-labelledby="selectAdminModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="selectAdminModalLabel">Admin INKA untuk peremajaan data
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('promotion.storeAdmin', $model->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id">
                                <select name="admin_id" class="form-select">
                                    <option disabled selected>-- Pilih Admin INKA --</option>
                                    @foreach ($admins as $admin)
                                        <option value="{{ $admin->id }}"
                                            {{ isset($model) && $model->admin_id == $admin->id ? 'selected' : (old('admin_id') == $admin->id ? 'selected' : '') }}>
                                            {{ $admin->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    @endif

    @if ($model->status == 7)
        @can('refine datas')
            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal"
                data-bs-target="#agreeDataModal{{ $model->id }}">
                <i class="fa-solid fa-user-check"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="agreeDataModal{{ $model->id }}" tabindex="-1"
                aria-labelledby="agreeDataModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="selectAdminModalLabel">Peremejaan SIASN
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('promotion.agreeData', $model->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id">
                                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    @endif

    @can('approved promotions')
        @if ($model->status == 2)
            <a href="{{ route('promotion.detailApprove', $model->id) }}" class="btn btn-outline-danger btn-sm">
                <i class="fa-solid fa-check"></i>
            </a>
        @endif
    @endcan
</td>
