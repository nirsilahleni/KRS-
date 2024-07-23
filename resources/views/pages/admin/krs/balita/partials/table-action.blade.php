<div class="d-flex justify-content-center align-items-center gap-2">

  @can($globalModule['update'])
    <button data-action="edit" data-url="{{ route('krs.balita.edit', $row->id) }}" data-target="#edit-balita_modal"
      class="btn btn-warning" title="edit">
      <i class="fas fa-pen fs-4"></i>
    </button>
  @endcan
  <button type="button" class="btn btn-light dropdown-toggle" data-bs-boundary="viewport" data-bs-toggle="dropdown"
    aria-expanded="false" title="more-actions">
    <i class="fas fa-ellipsis-v me-2 "></i>
  </button>
  <ul class="dropdown-menu">
    <li>
      @can($globalModule['read'])
        <button data-action="edit" data-target="#detail-balita_modal" data-url="{{ route('krs.balita.show', $row->id) }}"
          title="detail" class="btn w-100 text-start">
          <i class="fas fa-eye fs-4"></i>
          <span class="ms-2">Detail</span>
        </button>
      @endcan
    </li>
    <li>
      @can($globalModule['delete'])
        <button data-action="delete" data-url="{{ route('krs.balita.destroy', $row->id) }}" data-table-id="balita-table"
          data-name="{{ $row->name }}" title="hapus" class="btn w-100 text-start">
          <i class="fas fa-trash fs-4"></i>
          <span class="ms-2">Hapus</span>
        </button>
      @endcan
    </li>
  </ul>
</div>
