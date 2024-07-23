@extends('layouts.app')
@section('title','Data Kecamatan')

@section('content')
    <div class="app-container">
        <div class="py-4">
            <div class="d-flex align-items-center justify-content-between position-relative mb-3">
                <div class="search-box">
                    <label class="position-absolute " for="searchBox">
                        <i class="fal fa-search fs-3"></i>
                    </label>
                    <input type="text" data-table-id="kecamatan-table" id="searchBox" data-action="search"
                        class="form-control form-control-solid w-250px ps-13" placeholder="Cari Kecamatan" />
                </div>
                <div class="d-flex">
                    @can($globalModule['create'])
                        <button type="button" data-bs-toggle="modal" data-bs-target="#add-kecamatan_modal"
                            class="btn btn-primary">
                            <i class="fas fa-plus fs-3"></i>
                            <span class="ms-2">
                                Tambah
                            </span>
                        </button>
                    @endcan
                </div>
            </div>
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @include('pages.admin.master.kecamatan.modal')

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            function cekInput(input) {
                var regex = /[^0-9.,-]/g;
                input.value = input.value.replace(regex, "");
            }
        </script>
    @endpush
@endsection
