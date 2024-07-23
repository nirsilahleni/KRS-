@extends('layouts.app')
@section('title', 'Keluarga Management')
@section('content')
  <h4 class="mt-3">NO.KK. {{ $keluarga->nomor_kk }}</h4>
  <small class="text-uppercase">{{ $keluarga->nama_lengkap }}</small> -
  <small class="text-uppercase">{{ $keluarga->alamat }}</small>
  <div class="mt-4">
    <form action="{{ route('krs.keluarga.anggota.store', $keluarga->id) }}" method="POST" id="create-keluarga_anggota_form">
      @csrf
      <div class="row">
        <div class="col-md-6 mb-3">
          <x-atoms.form-label for="nik" required>NIK</x-atoms.form-label>
          <x-atoms.input name="nik" type="number" id="nik" placeholder="Masukkan Nik" />
        </div>
        <div class="col-md-6 mb-3">
          <x-atoms.form-label for="nama_lengkap" required>Nama Lengkap</x-atoms.form-label>
          <x-atoms.input name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" />
        </div>

        <div class="col-md-6 mb-3">
          <x-atoms.form-label for="tempat_lahir" required>Tempat Lahir</x-atoms.form-label>
          <x-atoms.input name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" />
        </div>

        <div class="col-md-6 mb-3">
          <x-atoms.form-label for="pekerjaan" >Pekerjaan</x-atoms.form-label>
          <x-atoms.input name="pekerjaan" id="pekerjaan" placeholder="Masukkan Pekerjaan" />
        </div>

        <div class="col-md-6 mb-3">
          <x-atoms.form-label for="tanggal_lahir" required>Tanggal Lahir</x-atoms.form-label>
          <x-atoms.input name="tanggal_lahir" type="date" id="tanggal_lahir" placeholder="Masukkan Tempat Lahir" />
        </div>

        <div class="col-md-6 mb-3">
          <x-atoms.form-label for="status_hubungan_id" required>Status Hubungan</x-atoms.form-label>
          <x-atoms.select2 id="status_hubungan_id" name="status_hubungan_id" :lists="c_option($hubungans, 'status_hubungan')">
          </x-atoms.select2>
        </div>

        <div class="col-md-6 mb-3">
          <x-atoms.form-label for="agama_id">Agama</x-atoms.form-label>
          <x-atoms.select2 id="agama_id" name="agama_id" :lists="c_option($agamas, 'agama')">
          </x-atoms.select2>
        </div>

        <div class="col-md-6 mb-3">
          <x-atoms.form-label for="jenjang_pendidikan_id">Pendidikan</x-atoms.form-label>
          <x-atoms.select2 id="jenjang_pendidikan_id" name="jenjang_pendidikan_id" :lists="c_option($pendidikans, 'nama_jenjang')">
          </x-atoms.select2>
        </div>

        <div class="col-md-6 mb-3">
          <x-atoms.form-label for="jenis_kelamin" required>Jenis Kelamin</x-atoms.form-label>
          <x-atoms.select placeholder="Pilih Jenis Kelamin" id="jenis_kelamin" name="jenis_kelamin"
            :lists="[
                'L' => 'Laki-laki',
                'P' => 'Perempuuan',
            ]"></x-atoms.select2>
        </div>
      </div>

      <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('krs.keluarga.anggota.index', $keluarga->id) }}" class="btn btn-light me-3">Kembali</a>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
    </form>
  </div>
@endsection
@push('scripts')
  <script>
    $(function() {
      $(document).on("form-submitted:create-keluarga_anggota_form", function(ev) {
        window.location.href = "{{ route('krs.keluarga.anggota.index', $keluarga->id) }}";
      });
      $("#nik, #nomor_kk").on("input", function(){
        if($(this).val().length > 16){
            $(this).val($(this).val().slice(0, 16));
        }
      })
    })
  </script>
@endpush
