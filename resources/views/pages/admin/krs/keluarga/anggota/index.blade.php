@extends('layouts.app')
@section('title', 'Keluarga Management')
@section('content')
  <h4 class="mt-3 mb-4">NO.KK. {{ $keluarga->nomor_kk }}</h4>
  <div class="mb-2 mt-3">
    <div class="d-flex align-items-center justify-content-between position-relative mb-3n">
      <div class="search-box">
        <label class="position-absolute " for="searchBox">
          <i class="fal fa-search fs-3"></i>
        </label>
        <input type="text" data-table-id="kepalakeluargaanggota-table" id="searchBox" data-action="search"
          class="form-control form-control-solid w-250px ps-13" placeholder="Cari Anggota Keluarga" />
      </div>
      <div class="d-flex">
        <a href="{{ route('krs.keluarga.index') }}" class="btn btn-light me-3">Kembali</a>
        @can($globalModule['create'])
          <a href="{{ route('krs.keluarga.anggota.create', $keluarga->id) }}" type="button" class="btn btn-primary">
            <i class="fal fa-plus fs-2"></i>
            <span class="ms-2">Tambah</span>
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
  @endpush
@endsection
