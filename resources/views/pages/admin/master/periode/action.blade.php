<div class="d-flex justify-content-start align-items-center gap-2">
    @if ($periode->is_active == '1')
        <button class="btn btn-success d-flex align-items-center text-start" disabled>
            <i class="fas fa-check fs-2 me-2"></i>Aktif
        </button>
    @else
        <button data-url="{{ route('master.periode.activate', $periode->id) }}" class="btn btn-warning d-flex align-items-center text-start"
            onclick="activatePeriode(event)"> <i class="fas fa-power-off fs-2 me-2"></i>Aktifkan
        </button>
    @endif
    <button type="button" class="btn btn-light dropdown-toggle" data-bs-boundary="viewport" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fas fa-ellipsis-v me-2"></i>
    </button>
    <ul class="dropdown-menu">
        {{-- @can($globalModule['update']) --}}
            <button data-action="edit" data-url="{{ route('master.periode.edit', $periode->id) }}"
                data-modal-id="edit-periode_modal" data-title="Periode" data-target="#edit-periode_modal"
                class="btn w-100 text-start">
                <i class="fas fa-pen fs-2 me-2"></i>Edit</button>
        {{-- @endcan --}}
        {{-- @can($globalModule['delete']) --}}
            <button data-url="{{ route('master.periode.destroy', $periode->id) }}" data-action="delete"
                data-table-id="periode-table" data-name="{{ $periode->tahun }}" class="btn w-100 text-start"
                {{ $periode->is_active == '1' ? 'disabled' : '' }}>
                <i class="fas fa-trash fs-2 me-2"></i>Hapus</button>
        {{-- @endcan --}}
    </ul>
</div>
