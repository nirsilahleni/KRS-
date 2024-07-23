@extends('layouts.app')
@section('title', 'Keluarga Management')
@section('content')
    <div class="mt-2">
        <a href="{{route('krs.keluarga.anggota.index', $anggota->kepala_keluarga_id)}}"
            class="btn btn-light me-3 mb-3">
            <i class="fal fa-chevron-left"></i>
            <span class="ms-3">Kembali</span>
        </a>
        <div class="row">
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="nik">NIK</x-atoms.form-label>
                <x-atoms.input name="nik" disabled value="{{ $anggota->nik }}" id="nik" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="nama_lengkap">Nama Lengkap</x-atoms.form-label>
                <x-atoms.input name="nama_lengkap" disabled value="{{ $anggota->nama_lengkap }}" id="nama_lengkap" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="tempat_lahir">Tempat Lahir</x-atoms.form-label>
                <x-atoms.input name="tempat_lahir" disabled value="{{ $anggota->tempat_lahir }}" id="tempat_lahir" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="tanggal_lahir">Tanggal Lahir</x-atoms.form-label>
                <x-atoms.input name="tanggal_lahir" disabled value="{{ $anggota->tanggal_lahir }}" id="tanggal_lahir" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="pekerjaan">Pekerjaan</x-atoms.form-label>
                <x-atoms.input name="pekerjaan" disabled value="{{ $anggota->pekerjaan }}" id="pekerjaan" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="status_hubungan">Status Hubungan</x-atoms.form-label>
                <x-atoms.input name="status_hubungan" disabled value="{{ $anggota->status_hubungan->status_hubungan }}"
                    id="status_hubungan" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="agama">Agama</x-atoms.form-label>
                <x-atoms.input name="agama" disabled value="{{ $anggota->agama?->agama }}" id="status_hubungan" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="pendidikan">Pendidikan</x-atoms.form-label>
                <x-atoms.input name="pendidikan" disabled value="{{ $anggota->jenjang_pendidikan?->nama_jenjang }}"
                    id="status_hubungan" />
            </div>
            <div class="col-md-6 mb-3">
                <x-atoms.form-label for="jenis_kelamin">Jenis Kelamin</x-atoms.form-label>
                <x-atoms.input name="jenis_kelamin" disabled value="{{ $anggota->jenis_kelamin }}" id="status_hubungan" />
            </div>
            <div class="d-flex justify-content-end mt-3">

            </div>
        </div>
    </div>
@endsection
