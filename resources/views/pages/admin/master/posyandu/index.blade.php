@extends('layouts.app')
@section('title','Data Posyandu')

@section('content')
    <div class="card-body py-4">
        <div class="d-flex align-items-center justify-content-between position-relative mb-3n">
            <div class="search-box mb-3">
                <label class="position-absolute " for="searchBox">
                    <i class="fal fa-search fs-3"></i>
                </label>
                <input type="text" data-table-id="posyandu-table" id="searchBox" data-action="search"
                    class="form-control form-control-solid w-250px ps-13" placeholder="Cari Posyandu" />
            </div>
            @can($globalModule['create'])
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-posyandu_modal">
                <i class="fal fa-plus fs-3"></i>
                <span class="ms-2">
                    Tambah
                </span>
            </button>
            @endcan
        </div>
        <div class="table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>

    @include('pages.admin.master.posyandu.modal')

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
@endsection
