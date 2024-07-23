@can($globalModule['update'])
    <button data-action="edit" data-target="#edit-agama_modal" data-url="{{ route('master.agama.edit', $agama->id) }}"
        class="btn btn-warning">
        <i class="fas fa-pen fs-4">

        </i>
    </button>
@endcan
@can($globalModule['delete'])
    <button class="btn btn-danger" data-url="{{ route('master.agama.destroy', $agama->id) }}" data-action="delete"
        data-table-id="agama-table" data-name="{{ $agama->agama }}" class="btn w-100 text-start">
        <i class="fas fa-trash fs-4"></i>
    </button>
@endcan
