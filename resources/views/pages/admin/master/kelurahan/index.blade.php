    @extends('layouts.app')
    @section('title', 'Data Kelurahan')

    @section('content')
        <div class="mb-2 mt-3">
            <div class="d-flex align-items-center justify-content-between position-relative mb-3n">
                <div class="search-box">
                    <label class="position-absolute " for="searchBox">
                        <i class="fal fa-search fs-3"></i>
                    </label>
                    <input type="text" data-table-id="kelurahan-table" id="searchBox" data-action="search"
                        class="form-control form-control-solid w-250px ps-13" placeholder="Cari Kelurahan" />
                </div>
                <div class="d-flex">
                    @can($globalModule['create'])
                        <a href="{{ route('master.kelurahan.create') }}" class="ms-2">
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
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>


        @push('scripts')
            {{ $dataTable->scripts() }}
        @endpush
    @endsection
