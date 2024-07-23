@extends('layouts.app')
@section('title', 'Data Monitoring Ibu Hamil')
@section('content')
    @include('pages.admin.monitoring.ibu-hamil.partials.modals')
    <div class="mb-2 mt-3">
        <div class="d-flex align-items-center justify-content-between position-relative mb-3n">
            <div class="d-flex gap-4">
                <div class="search-box">
                    <label class="position-absolute " for="searchBox">
                        <i class="fal fa-search fs-3"></i>
                    </label>
                    <input type="text" data-table-id="ibuhamil-table" id="searchBox" data-action="search"
                        class="form-control form-control-solid w-250px ps-13" placeholder="Cari Ibu Hamil" />
                </div>
                <button class="btn btn-success"data-bs-target="#filter-ibuhamil_modal" data-bs-toggle="modal">
                    <i class="fal fa-filter fs-4 me-1"></i>
                    <span class="ms-2">Filter</span>
                </button>

            </div>
            <div class="d-flex">
                @can($globalModule['create'])
                    <button data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#add-ibuhamil_modal" class="ms-2">
                        <i class="fal fa-plus fs-2"></i>
                        <span class="ms-2">Tambahkan Ibu Hamil</span>
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
                // create
                $("#kepala_keluarga_field").on("change", function() {

                    $("#kepala_keluarga_anggota_field").select2({
                        placeholder: "Pilih Ibu Hamil",
                        disabled: false,
                        ajax: {
                            url: `{{ route('reference.ibu_hamil') }}?kepala_keluarga_id=${$(this).val()}`,
                            dataType: 'json',
                            processResults: function(data) {
                                return {
                                    results: data.data,
                                };
                            },
                        }
                    });

                    if ($(this).val()) {
                        $.ajax({
                            url: `{{ route('reference.kelurahan_posyandu') }}?kepala_keluarga_id=${$(this).val()}`,
                            dataType: 'json',
                            success: function(data) {
                                if (data.data) {
                                    $("#posyandu_field").select2({
                                        placeholder: "Pilih Posyandu",
                                        disabled: false,
                                        ajax: {
                                            url: `{{ route('reference.posyandu') }}?kelurahan_id=${data.data}`,
                                            dataType: 'json',
                                            processResults: function(data) {
                                                return {
                                                    results: data.data,
                                                };
                                            },
                                        }
                                    });
                                }
                            }
                        });
                        $.ajax({
                            url: `{{ route('reference.nomor_kia') }}?kepala_keluarga_id=${$(this).val()}`,
                            dataType: 'json',
                            success: function(data) {
                                console.log(data)
                                if (data?.data?.length > 0) {
                                    $("#nomor_kia_field").val(data.data);
                                } else {
                                    $("#nomor_kia_field").val("");
                                }
                            }
                        });
                    } else {
                        $("#kepala_keluarga_anggota_field").select2({
                            placeholder: "Pilih Ibu Hamil",
                            disabled: true,
                        });
                        $("#posyandu_field").select2({
                            placeholder: "Pilih Posyandu",
                            disabled: true,
                        });
                        $("#nomor_kia_field").val("");
                    }

                });

                // update
                $("#kepala_keluarga_field2").on("change", function() {

                    $("#kepala_keluarga_anggota_field2").select2({
                        placeholder: "Pilih Ibu Hamil",
                        readonly: false,
                        ajax: {
                            url: `{{ route('reference.ibu_hamil') }}?kepala_keluarga_id=${$(this).val()}`,
                            dataType: 'json',
                            processResults: function(data) {
                                return {
                                    results: data.data,
                                };
                            },
                        }
                    });

                    if ($(this).val()) {
                        $.ajax({
                            url: `{{ route('reference.kelurahan_posyandu') }}?kepala_keluarga_id=${$(this).val()}`,
                            dataType: 'json',
                            success: function(data) {
                                if (data.data) {
                                    $("#posyandu_field2").select2({
                                        placeholder: "Pilih Posyandu",
                                        readonly: false,
                                        ajax: {
                                            url: `{{ route('reference.posyandu') }}?kelurahan_id=${data.data}`,
                                            dataType: 'json',
                                            processResults: function(data) {
                                                return {
                                                    results: data.data,
                                                };
                                            },
                                        }
                                    });
                                }
                            }
                        });
                        $.ajax({
                            url: `{{ route('reference.nomor_kia') }}?kepala_keluarga_id=${$(this).val()}`,
                            dataType: 'json',
                            success: function(data) {
                                if (data?.data?.length > 0) {
                                    $("#nomor_kia_field2").val(data.data);
                                } else {
                                    $("#nomor_kia_field2").val("");
                                }
                            }
                        });
                    }

                });

                $("#nomor_kia_field").on("keypress", function(e) {
                    if (e.which < 48 || e.which > 57) {
                        e.preventDefault();
                    }
                });

                $("#nomor_kia_field2").on("keypress", function(e) {
                    if (e.which < 48 || e.which > 57) {
                        e.preventDefault();
                    }
                });

                $("#filter-ibuhamil_modal button[data-bs-dismiss='modal']").on("click", function(ev) {
                    let form = $("#filter-ibuhamil_modal form");
                    window.LaravelDataTables["ibuhamil-table"].ajax.url(`{{ route('monitoring.ibu-hamil.index') }}`).load();
                    resetForm($("#filter-ibuhamil_modal form"));
                    $("#filter-ibuhamil_modal").modal("hide");
                })

                $("#filter-ibuhamil_modal form").on("submit", function(ev) {
                    ev.preventDefault();
                    window.LaravelDataTables["ibuhamil-table"].ajax.reload();
                    $('#filter-ibuhamil_modal').modal('hide');
                })
            });
        </script>
    @endpush
@endsection
