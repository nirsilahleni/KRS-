<div class="d-flex justify-content-center align-items-center gap-2">
    @can($globalModule['create'])
        <a href="{{ route('krs.keluarga.edit', $kk->id) }}" title="" class="btn btn-warning">
            <i class="fas fa-pen fs-4"></i>
        </a>
    @endcan
    <button type="button" class="btn btn-light dropdown-toggle" data-bs-boundary="viewport" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fas fa-ellipsis-v me-2 "></i>
    </button>
    <ul class="dropdown-menu">
        <li>
            @can($globalModule['read'])
                <a href="{{ route('krs.keluarga.show', $kk->id) }}" class="btn w-100 text-start">
                    <i class="fas fa-eye fs-4"></i>
                    <span class="ms-2">Detail KK</span>
                </a>
            @endcan
        </li>
        <li>
            @can($globalModule['read'])
                <a href="{{ route('krs.keluarga.anggota.index', $kk->id) }}" class="btn w-100 text-start">
                    <i class="fas fa-eye fs-4"></i>
                    <span class="ms-2">Anggota</span>
                </a>
            @endcan
        </li>
        <li>
            @can($globalModule['delete'])
                <button data-action="delete" data-url="{{ route('krs.keluarga.destroy', $kk->id) }}"
                    data-table-id="datakepalakeluarga-table" data-name="{{ $kk->nik }}" class="btn w-100 text-start">
                    <i class="fas fa-trash fs-4"></i>
                    <span class="ms-2">Hapus</span>
                </button>
            @endcan
        </li>
    </ul>
</div>
