<td>
    <a href="{{ route('employees.show', $model->nip_baru) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    @can('edit user')
        <a href="{{ route('employees.edit', $model->nip_baru) }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-pencil-alt"></i>
        </a>
    @endcan
</td>
