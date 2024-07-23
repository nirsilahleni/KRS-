@extends('layouts.app')
@section('title', 'Management Status Keluarga')
@section('content')
    @include('pages.admin.master.status-keluarga.partials.modals', ['newCode' => $newCode])
    <div class="app-container">
        <div class="py-4">
            <div class="d-flex align-items-center justify-content-between position-relative mb-3">
                <div class="search-box">
                    <label class="position-absolute " for="searchBox">
                        <i class="fal fa-search fs-3"></i>
                    </label>
                    <input type="text" data-table-id="statuskeluarga-table" id="searchBox" data-action="search"
                        class="form-control form-control-solid w-250px ps-13" placeholder="Cari status keluarga" />
                </div>
                <div class="d-flex">
                    @can($globalModule['create'])
                        <button type="button" data-bs-toggle="modal" data-bs-target="#add-keluarga_modal" class="btn btn-primary">
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
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
