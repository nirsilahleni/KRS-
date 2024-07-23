@can($globalModule['update'])
    <button data-action="edit" data-target="#edit-kecamatan_modal"
        data-url="{{ route('master.kecamatan.edit', $kecamatan->id) }}" class="btn btn-warning">
        <i class="fas fa-pen fs-4"></i>
    </button>
@endcan
@can($globalModule['delete'])
    <button class="btn btn-danger" data-url="{{ route('master.kecamatan.destroy', $kecamatan->id) }}" data-action="delete"
        data-table-id="kecamatan-table" data-name="{{ $kecamatan->nama_kecamatan }}" class="btn w-100 text-start">
        <i class="fas fa-trash fs-4"></i>
    </button>
@endcan
