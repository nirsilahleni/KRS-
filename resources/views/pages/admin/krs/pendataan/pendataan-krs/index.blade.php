@extends('layouts.app')
@section('title', 'Keluarga Management')
@section('content')
  @include('pages.admin.krs.pendataan.pendataan-krs.partials.modals')
  <div class="mb-2 mt-3">
    <div class="d-flex align-items-center justify-content-between position-relative mb-3n">
      <div class="d-flex gap-4">
        <div class="search-box">
          <label class="position-absolute " for="searchBox">
            <i class="fal fa-search fs-3"></i>
          </label>
          <input type="text" data-table-id="pendataankrs-table" id="searchBox" data-action="search"
            class="form-control form-control-solid w-250px ps-13" placeholder="Cari pendataan krs" />
        </div>
        <button class="btn btn-success"data-bs-target="#filter-pendataan-krs_modal" data-bs-toggle="modal">
          <i class="fal fa-filter fs-4 me-1"></i>
          <span class="ms-2">Filter</span>
        </button>
      </div>
      <div class="d-flex">
        @can($globalModule['create'])
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-pendataan-krs_modal">
            <i class="fal fa-plus fs-2"></i>
            <span class="ms-2">Tambah</span>
          </button>
        @endcan
      </div>
    </div>
  </div>
  <div class="card-body py-4">
    <div class="table-relative">
      {{ $dataTable->table() }}
    </div>
  </div>

  @push('scripts')
    {{ $dataTable->scripts() }}
  @endpush
@endsection

@push('scripts')
  <script>
    $(function() {
      $("#kepala_keluarga_field").on("change", function(ev) {
        const value = $(this).val();
        if (!value) {
          $("#balita_field").select2({
            placeholder: "Pilih Balita",
            allowClear: true,
            disabled: true,
            dropdownParent: $("#add-pendataan-krs_modal"),
          });
          return;
        }


        $.ajax({
          url: `{{ route('krs.pendataan.pendataan-krs.index') }}/${value}/calculate`,
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            kepala_keluarga_id: value
          },
          beforeSend: showPageOverlay,
          complete: hidePageOverlay,
          success: function(response) {
            fillForm($("#add-pendataan-krs_modal form"), response.data);
          },
          error: function(err) {
            handleAjaxError(err);
            $("#add-pendataan-krs_modal").modal("hide");

          }
        })
      })
      $("#filter-pendataan-krs_modal button[data-bs-dismiss='modal']").on("click", function(ev) {
        let form = $("#filter-pendataan-krs_modal form");
        window.LaravelDataTables["pendataankrs-table"].ajax.url(`{{ route('krs.pendataan.pendataan-krs.index') }}`).load();
        resetForm($("#filter-pendataan-krs_modal form"));
        $("#filter-pendataan-krs_modal").modal("hide");
      })

      $("#filter-pendataan-krs_modal form").on("submit", function(ev) {
        ev.preventDefault();
        let data = $(this).serialize();
        window.LaravelDataTables["pendataankrs-table"].ajax.url(`{{ route('krs.pendataan.pendataan-krs.index') }}?${data}`).load();
        toastr.success( 'Filter berhasil diterapkan');
        $('#filter-pendataan-krs_modal').modal('hide');
      })
    })
  </script>
@endpush
