@extends('layouts.app')
@section('title', 'Monitoring Balita')
@section('content')
  @include('pages.admin.monitoring.balita.partials.modals')
  @include('pages.admin.monitoring.balita.partials.import-modal')
  <div class="mb-2 mt-3">
    <div class="d-flex align-items-center justify-content-between position-relative mb-3n">
      <div class="d-flex gap-4">
        <div class="search-box">
          <label class="position-absolute " for="searchBox">
            <i class="fal fa-search fs-3"></i>
          </label>
          <input type="text" data-table-id="monitoring-balita-table" id="searchBox" data-action="search"
            class="form-control form-control-solid w-250px ps-13" placeholder="Cari ..." />
        </div>
        <button class="btn btn-success"data-bs-target="#filter-pendampingan_modal" data-bs-toggle="modal">
          <i class="fal fa-filter fs-4 me-1"></i>
          <span class="ms-2">Filter</span>
        </button>
      </div>
      <div class="d-flex gap-3">
        @can($globalModule['create'])
          <button class="btn btn-success" data-bs-target="#import_modal" data-bs-toggle="modal">
            <i class="fal fa-file-excel fs-3"></i>
            <span class="ms-2">Import Data Pendampingan</span>
          </button>
          <button data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#add-pendampingan_modal" class="ms-2">
            <i class="fal fa-plus fs-2"></i>
            <span class="ms-2">Tambahkan Data Pendampingan</span>
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
      $(document).on(`dropzone:addedfiles-file_field`, function(ev) {
        const dzInstance = Dropzone.forElement("#file_field");
        const files = dzInstance?.files;
        const formdata = new FormData();

        formdata.append("file", files[0]);
        formdata.append("_token", "{{ csrf_token() }}");
        $.ajax({
          url: "{{ route('monitoring.balita.import') }}?initialize=true",
          type: "POST",
          contentType: false,
          processData: false,
          data: formdata,
          beforeSend: function() {
            showPageOverlay();
          },
          complete: () => {
            hidePageOverlay();

          },
          success: (data) => {
            $("#sheet_field").empty();
            const sheets = data.data.sheets;

            $("#sheet_field").append(
              `<option value="" disabled>Pilih sheet yang diimport</option>
              <option value="all" selected>Semua sheet</option>`
            );
            sheets.forEach((sheet) => {
              $("#sheet_field").append(
                `<option value="${sheet}" >${sheet}</option>`
              )
            })
          },
          error: (xhr) => {
            handleAjaxError(xhr);
          }
        })
      })

      $(function() {
        $("input[name='berat_badan']").on('change', function(ev) {
          let value = $(this).val();
          $(this).val(parseFloat(value).toFixed(2));
        })
        $("input[name='tinggi_badan']").on('change', function(ev) {
          let value = $(this).val();
          $(this).val(parseFloat(value).toFixed(1));
        })

        $("#tanggal_pendampingan_field").on("change", function(ev) {
          let value = $("#balita_field").val();
          const currentDate = new Date($(this).val());
          if (!value) return;
          $.ajax({
            url: `{{ route('reference.balita') }}?balita_id${value}&get_all=true`,
            method: "GET",
            beforeSend: function() {
              $("#usia_field").val("");
              showPageOverlay();
            },
            complete: function() {
              hidePageOverlay();
            },
            success: function(res) {
              const data = res.data;
              const birthDate = new Date(data[0].tanggal_lahir);
              const diffInMilliseconds = currentDate - birthDate;
              const diffInWeeks = Math.floor(diffInMilliseconds / (1000 * 60 * 60 * 24 * 7));
              $("#usia_field").val(diffInWeeks);
            }
          })
        })
        $("#tanggal_pendampingan_field2").on("change", function(ev) {
          let value = $("#balita_field2").val();
          const currentDate = new Date($(this).val());
          if (!value) return;
          $.ajax({
            url: `{{ route('reference.balita') }}?balita_id${value}&get_all=true`,
            method: "GET",
            beforeSend: function() {
              $("#usia_field2").val("");
              showPageOverlay();
            },
            complete: function() {
              hidePageOverlay();
            },
            success: function(res) {
              const data = res.data;
              const birthDate = new Date(data[0].tanggal_lahir);
              const diffInMilliseconds = currentDate - birthDate;
              const diffInWeeks = Math.floor(diffInMilliseconds / (1000 * 60 * 60 * 24 * 7));
              console.log(diffInWeeks)
              $("#usia_field2").val(diffInWeeks);
            }
          })
        })

        $("#filter-pendampingan_modal button[data-bs-dismiss='modal']").on("click", function(ev) {
          let form = $("#filter-pendampingan_modal form");
          resetForm($("#filter-pendampingan_modal form"));
          window.LaravelDataTables["monitoring-balita-table"].ajax.url(`{{ route('monitoring.balita.index') }}`)
            .load();
          $("#filter-pendampingan_modal").modal("hide");
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
              dropdownParent: $("#filter-pendampingan_modal"),
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


        $("#filter-pendampingan_modal form").on("submit", function(ev) {
          ev.preventDefault();
          let data = $(this).serialize();
          window.LaravelDataTables["monitoring-balita-table"].ajax.url(
              `{{ route('monitoring.balita.index') }}?${data}`)
            .load();
          $('#filter-pendampingan_modal').modal('hide');
        })
      })
    </script>
  @endpush
@endsection
