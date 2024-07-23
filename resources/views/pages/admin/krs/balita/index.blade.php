@extends('layouts.app')
@section('title', 'Data Balita')
@section('content')
  @include('pages.admin.krs.balita.partials.modals')
  <div class="mb-2 mt-3">
    <div class="d-flex align-items-center justify-content-between position-relative mb-3n">
      <div class="d-flex gap-4">
        <div class="search-box">
          <label class="position-absolute " for="searchBox">
            <i class="fal fa-search fs-3"></i>
          </label>
          <input type="text" data-table-id="balita-table" id="searchBox" data-action="search"
            class="form-control form-control-solid w-250px ps-13" placeholder="Cari Balita" />
        </div>
        <button class="btn btn-success"data-bs-target="#filter-balita_modal" data-bs-toggle="modal">
          <i class="fal fa-filter fs-4 me-1"></i>
          <span class="ms-2">Filter</span>
        </button>

      </div>
      <div class="d-flex">
        @can($globalModule['create'])
          <button data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#add-balita_modal" class="ms-2">
            <i class="fal fa-plus fs-2"></i>
            <span class="ms-2">Tambahkan Balita</span>
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
    <script>
      $(function() {
        $("input[name='nik']").on('input', function(ev) {
          let value = $(this).val()
          if (value.length > 16) {
            $(this).val(value.slice(0, 16))
          }
        })
        $("#tanggal_lahir_field").on('change', function(ev) {
          let birthDate = new Date($(this).val());
          let currentDate = new Date();
          let ageInWeeks = Math.floor((currentDate - birthDate) / (7 * 24 * 60 * 60 * 1000));
          $("#usia_field").val(ageInWeeks)
        })
        $("#tanggal_lahir_field2").on('change', function(ev) {
          let birthDate = new Date($(this).val());
          let currentDate = new Date();
          let ageInWeeks = Math.floor((currentDate - birthDate) / (7 * 24 * 60 * 60 * 1000));
          $("#usia_field2").val(ageInWeeks)
        })
        $("input[name='berat_badan']").on('change', function(ev) {
          let value = $(this).val();
          $(this).val(parseFloat(value).toFixed(2));
        })
        $("input[name='tinggi_badan']").on('change', function(ev) {
          let value = $(this).val();
          $(this).val(parseFloat(value).toFixed(1));
        });

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
              dropdownParent: $("#filter-balita_modal"),
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

        $("#filter-balita_modal button[data-bs-dismiss='modal']").on("click", function(ev) {
          let form = $("#filter-balita_modal form");
          window.LaravelDataTables["balita-table"].ajax.url(`{{ route('krs.balita.index') }}`).load();
          resetForm($("#filter-balita_modal form"));
          $("#filter-balita_modal").modal("hide");
        })

        $("#filter-balita_modal form").on("submit", function(ev) {
          ev.preventDefault();
          let data = $(this).serialize();
          window.LaravelDataTables["balita-table"].ajax.url(`{{ route('krs.balita.index') }}?${data}`).load();
          $('#filter-balita_modal').modal('hide');
        })
      })
    </script>
  @endpush
@endsection
