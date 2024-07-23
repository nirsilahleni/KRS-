<div class="d-flex justify-content-center align-items-center gap-2">
    @can($globalModule['update'])
        <a href="{{ route('master.kader.edit', $kader->id) }}" title="" class="btn btn-warning">
            <i class="fas fa-pen fs-4"></i>
        </a>
    @endcan
    <button type="button" class="btn btn-light dropdown-toggle" data-bs-boundary="viewport" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fas fa-ellipsis-v me-2"></i>
    </button>
    <ul class="dropdown-menu">
        @can($globalModule['read'])
            <li>
                <button data-action="detail" title="detail" data-url="{{ route('master.kader.show', $kader->id) }}"
                    data-target="#detail-kader_modal" class="btn w-100 text-start">
                    <i class="fas fa-eye fs-2 me-2"></i>
                    Pratinjau
                </button>
            </li>
        @endcan
        @can($globalModule['delete'])
            <li>
                <button class="btn w-100 text-start" data-url="{{ route('master.kader.destroy', $kader->id) }}"
                    data-name="{{ $kader->nama_kader }}" data-action="delete" data-table-id="kader-table">
                    <i class="fas fa-trash fs-2 me-2"></i>
                    Hapus
                </button>
            </li>
        @endcan
    </ul>
</div>
