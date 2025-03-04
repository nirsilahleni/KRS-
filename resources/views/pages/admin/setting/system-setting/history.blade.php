@extends('layouts.app')
@section("title","System Setting")

@section('content')
    @include('pages.admin.setting.system-setting.modal')

    <div class="d-flex justify-content-between mt-4 mb-2">
        <a href="{{route('setting.system-setting.index')}}" class="btn btn-light">
            <i class="fal fa-chevron-left"></i>
            <span class="ms-3">Kembali</span>
        </a>
        <div class="search-box">
            <label class="position-absolute " for="searchBox">
                <i class="fal fa-search fs-3"></i>
            </label>
            <input type="text" data-table-id="system-setting-history-table" id="searchBox" data-action="search"
                class="form-control form-control-solid w-250px ps-13" placeholder="Cari Setting" />
        </div>
    </div>
    <div class="table-responsive">
        {{ $dataTable->table() }}
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            $(document).on('action-cofirmed:restore', function(){
                window.LaravelDataTables['system-setting-table'].ajax.reload();
            })
        });
    </script>
@endpush
