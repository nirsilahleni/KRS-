@extends('layouts.app')
@section('title','Interpretasi')

@section('content')
    <div class="app-container">
        <div class="py-4">
            <div class="d-flex align-items-center justify-content-between position-relative mb-3">
                <div class="search-box">
                    <label class="position-absolute " for="searchBox">
                        <i class="fal fa-search fs-3"></i>
                    </label>
                    <input type="text" data-table-id="interpretasi-table" id="searchBox" data-action="search"
                        class="form-control form-control-solid w-250px ps-13" placeholder="Cari Interpretasi" />
                </div>
                <div class="d-flex">
                    @can($globalModule['create'])
                        <button type="button" data-bs-toggle="modal" data-bs-target="#add-interpretasi_modal"
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

    @include('pages.admin.master.interpretasi.modal')

    @push('scripts')
        {{ $dataTable->scripts() }}
     
    @endpush
@endsection