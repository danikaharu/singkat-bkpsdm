<td>
    @can('show promotions')
        <a href="{{ route('promotion.show', $model->id) }}" class="btn btn-outline-success btn-sm mb-2">
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    @if ($model->status == 1 || $model->status == 4)
        @can('edit promotions')
            <a href="{{ route('promotion.edit', $model->id) }}" class="btn btn-outline-primary btn-sm mb-2">
                <i class="fa fa-pencil-alt"></i>
            </a>
        @endcan
    @endif

    @if ($model->status == 1 || $model->status == 4)
        @can('delete promotions')
            <form action="{{ route('promotion.destroy', $model->id) }}" method="post" class="d-inline" role="alert"
                alert-title="Apakah anda yakin ingin menghapus data ini?" alert-text="Data yang dihapus tidak bisa kembali">
                @csrf
                @method('delete')

                <button class="btn btn-outline-danger btn-sm mb-2">
                    <i class="ace-icon fa fa-trash-alt"></i>
                </button>
            </form>
        @endcan
    @endif

    @if ($model->status == 1)
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

    @can('approved promotions')
        @if ($model->status == 2)
            <a href="{{ route('promotion.detailApprove', $model->id) }}" class="btn btn-outline-danger btn-sm">
                <i class="fa-solid fa-check"></i>
            </a>
        @endif
    @endcan
</td>
