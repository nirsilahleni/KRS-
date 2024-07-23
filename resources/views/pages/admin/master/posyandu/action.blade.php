<div class="d-flex justify-content-center align-items-center gap-2">
    @can($globalModule['update'])
        <button data-action="edit" title="edit" data-target="#edit-posyandu_modal"
            data-url="{{ route('master.posyandu.edit', $posyandu->id) }}" class="btn btn-warning ">
            <i class="fas fa-pen fs-4"></i>
        </button>
    @endcan

    @can($globalModule['delete'])
        <button class="btn btn-danger" data-url="{{ route('master.posyandu.destroy', $posyandu->id) }}" data-name="{{ $posyandu->nama_posyandu }}"
            data-action="delete" data-table-id="posyandu-table">
            <i class="fas fa-trash fs-4"></i>
        </button>
    @endcan

</div>
