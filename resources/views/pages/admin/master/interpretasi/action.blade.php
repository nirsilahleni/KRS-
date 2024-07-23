@can($globalModule['update'])
    <button data-action="edit" data-target="#edit-interpretasi_modal"
        data-url="{{ route('master.interpretasi.edit', $interpretasi->id) }}" class="btn btn-warning">
        <i class="fas fa-pen fs-4"></i>
    </button>
@endcan
@can($globalModule['delete'])
    <button class="btn btn-danger" data-url="{{ route('master.interpretasi.destroy', $interpretasi->id) }}" data-action="delete" data-table-id="interpretasi-table"
        data-name="{{ $interpretasi->interpretasi }}" class="btn w-100 text-start">
        <i class="fas fa-trash fs-4"></i>
    </button>
@endcan