@extends('layouts.app')
@section('title', 'Keluarga Management')
@section('content')
  <div class="mt-2">
    <div class="row">
      <div class="col-md-6 mb-3">
        <x-atoms.form-label for="nomor_kk">Nomor KK</x-atoms.form-label>
        <x-atoms.input name="nomor_kk" disabled value="{{ $keluarga->nomor_kk }}" id="nomor_kk"
          placeholder="Masukkan Nomor KK" />
      </div>
      <div class="col-md-6 mb-3">
        <x-atoms.form-label for="nik">Nik</x-atoms.form-label>
        <x-atoms.input name="nik" disabled value="{{ $keluarga->nik }}" id="nik" placeholder="Masukkan Nik" />
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <x-atoms.form-label for="nama_lengkap">Nama Lengkap</x-atoms.form-label>
        <x-atoms.input name="nama_lengkap" disabled value="{{ $keluarga->nama_lengkap }}" id="nama_lengkap" />
      </div>
      <div class="col-md-6 mb-3">
        <x-atoms.form-label for="nama_kecamatan">Kecamatan</x-atoms.form-label>
        <x-atoms.input name="nama_kecamatan" disabled value="{{ $keluarga->kecamatan?->nama_kecamatan }}" id="nama_kecamatan" />
      </div>
      <div class="col-md-6 mb-3">
        <x-atoms.form-label for="nama_kelurahan">Kelurahan</x-atoms.form-label>
        <x-atoms.input name="nama_kelurahan" disabled value="{{ $keluarga->kelurahan->nama_kelurahan }}" id="nama_kelurahan" />
      </div>
      <div class="col-md-6 mb-3">
        <x-atoms.form-label for="status_keluarga">Status Keluarga</x-atoms.form-label>
        <x-atoms.input name="status_keluarga" disabled value="{{ $keluarga->status_keluarga->status_keluarga }}" id="status_keluarga" />
      </div>

      <div class="col-md-6 mb-3">
        <x-atoms.form-label for="rt">Rt</x-atoms.form-label>
        <x-atoms.input name="rt" disabled value="{{ $keluarga->rt }}" id="rt" placeholder="Masukkan Rt" />
      </div>

      <div class="col-md-6 mb-3">
        <x-atoms.form-label for="rw">Rw</x-atoms.form-label>
        <x-atoms.input name="rw" disabled value="{{ $keluarga->rw }}" id="rw" placeholder="Masukkan Rw" />
      </div>
      <div class="col-md-12 mb-3">
        <x-atoms.form-label for="alamat" required>Alamat</x-atoms.form-label>
        <x-atoms.textarea disabled name="alamat" id="alamat" placeholder="Masukkan Alamat"
          rows="4">{{ $keluarga->alamat }}</x-atoms.textarea>
      </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
      <a href="{{ route('krs.keluarga.index') }}" class="btn btn-light me-3">Kembali</a>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(function() {
      $(document).on("form-submitted:create-keluarga_form", function(ev) {
        window.location.href = "{{ route('krs.keluarga.index') }}";
      });
    })
  </script>
@endpush
