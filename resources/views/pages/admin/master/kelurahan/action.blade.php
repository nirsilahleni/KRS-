<div class="d-flex justify-content-center align-items-center gap-2">

    @can($globalModule['update'])
        <a href="{{ route('master.kelurahan.edit', $kelurahan->id) }}" title="" class="btn btn-warning">
            <i class="fas fa-pen fs-4"></i>
        </a>
    @endcan
    @can($globalModule['delete'])
        <button class="btn btn-danger" data-url="{{ route('master.kelurahan.destroy', $kelurahan->id) }}"
            data-name="{{ $kelurahan->nama_kelurahan }}" data-action="delete" data-table-id="kelurahan-table">
            <i class="fas fa-trash fs-4"></i>
        </button>
    @endcan

</div>
