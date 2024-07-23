@extends('layouts.app')
@section('title', 'Keluarga Management')
@section('content')
  @include('pages.admin.krs.keluarga.partials.filter-keluarga-modal')
  <div class="mb-2 mt-3">
    <div class="d-flex align-items-center justify-content-between position-relative mb-3n">
      <div class="d-flex gap-3">
        <div class="search-box">
          <label class="position-absolute " for="searchBox">
            <i class="fal fa-search fs-3"></i>
          </label>
          <input type="text" data-table-id="datakepalakeluarga-table" id="searchBox" data-action="search"
            class="form-control form-control-solid w-250px ps-13" placeholder="Cari Kepala Keluarga" />
        </div>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#filter-keluarga_modal">
          <i class="fal fa-filter fs-4 me-1"></i>
          <span class="ms-2">Filter</span>
        </button>
      </div>
      <div class="d-flex">
        @can($globalModule['create'])
          <a href="{{ route('krs.keluarga.create') }}" class="ms-2">
            <button type="button" class="btn btn-primary">
              <i class="fal fa-plus fs-2"></i>
              <span class="ms-2">Tambah</span>
            </button>
          </a>
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
    <script>
      $(function() {
        $("#filter-keluarga_modal button[data-bs-dismiss='modal']").on("click", function(ev) {
          let form = $("#filter-keluarga_modal form");
          resetForm($("#filter-keluarga_modal form"));
          window.LaravelDataTables["datakepalakeluarga-table"].ajax.url(`{{ route('krs.keluarga.index') }}`)
            .load();
          $("#filter-keluarga_modal").modal("hide");
        })

        $("#kecamatan_field4").on("change", function() {
          if (!$(this).val()) {
            $("#kelurahan_field4").select2({
              disabled: true,
              placeholder: "Pilih Kelurahan"
            });
          } else {
            $("#kelurahan_field4").select2("destroy");
            $("#kelurahan_field4").select2({
              disabled: false,
              placeholder: "Pilih Kelurahan",
              dropdownParent: $("#filter-keluarga_modal"),
              ajax: {
                url: `{{ route('reference.kelurahan') }}?kecamatan_id=${$(this).val()}`,
                dataType: 'json',
                processResults: function(data) {
                  return {
                    results: data.data
                  }
                }
              }
            });
          }

        })


        $("#filter-keluarga_modal form").on("submit", function(ev) {
          ev.preventDefault();
          let data = $(this).serialize();
          window.LaravelDataTables["datakepalakeluarga-table"].ajax.url(
              `{{ route('krs.keluarga.index') }}?${data}`)
            .load();
          $('#filter-keluarga_modal').modal('hide');
        })
      })
    </script>
  @endpush
@endsection
