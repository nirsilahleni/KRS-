@can($globalModule['update'])
    <button data-action="edit" data-target="#edit-keluarga_modal"
        data-url="{{ route('master.keluarga.edit', $statusKeluarga->id) }}" class="btn btn-warning">
        <i class="fas fa-pen fs-4"></i>
    </button>
@endcan
@can($globalModule['delete'])
    <button class="btn btn-danger" data-url="{{ route('master.keluarga.destroy', $statusKeluarga->id) }}" data-action="delete" data-table-id="statuskeluarga-table"
        data-name="{{ $statusKeluarga->status_keluarga }}" class="btn w-100 text-start">
        <i class="fas fa-trash fs-4"></i>
    </button>
@endcan
