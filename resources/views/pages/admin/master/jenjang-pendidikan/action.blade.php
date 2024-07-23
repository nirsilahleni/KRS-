@can($globalModule['update'])
    <button data-action="edit" data-target="#edit-pendidikan_modal"
        data-url="{{ route('master.pendidikan.edit', $jenjangPendidikan->id) }}" class="btn btn-warning">
        <i class="fas fa-pen fs-4"></i>
    </button>
@endcan
@can($globalModule['delete'])
    <button class="btn btn-danger" data-url="{{ route('master.pendidikan.destroy', $jenjangPendidikan->id) }}"
        data-action="delete" data-table-id="jenjangpendidikan-table" data-name="{{ $jenjangPendidikan->nama_jenjang }}"
        class="btn w-100 text-start">
        <i class="fas fa-trash fs-4"></i>
    </button>
@endcan
