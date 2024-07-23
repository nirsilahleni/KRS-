@extends('layouts.app')
@section('title', 'Edit Data Kelurahan')

@section('content')
    <div class="mt-2">
        <form action="{{ route('master.kelurahan.update', $kelurahan->id) }}" method="POST" id="edit-kelurahan_form">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <x-atoms.form-label for="kecamatan_id" required>Kecamatan</x-atoms.form-label>
                <x-atoms.select2 name="kecamatan_id" id="kecamatan_id" placeholder="Pilih Kecamatan">
                    @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}"
                            {{ $kelurahan->kecamatan_id == $kecamatan->id ? 'selected' : '' }}>
                            {{ $kecamatan->nama_kecamatan }}
                        </option>
                    @endforeach
                </x-atoms.select2>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="kode_kelurahan" required>Kode Kelurahan</x-atoms.form-label>
                    <x-atoms.input name="kode_kelurahan" id="kode_kelurahan" value="{{ $kelurahan->kode_kelurahan }}"
                        placeholder="Kode Kelurahan" />
                </div>
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="nama_kelurahan" required>Nama Kelurahan</x-atoms.form-label>
                    <x-atoms.input name="nama_kelurahan" id="nama_kelurahan" value="{{ $kelurahan->nama_kelurahan }}"
                        placeholder="Nama Kelurahan" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="latitude">Latitude</x-atoms.form-label>
                    <x-atoms.input oninput="cekInput(this)" name="latitude" id="latitude"
                        value="{{ $kelurahan->latitude }}" placeholder="Latitude" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="longitude">Longitude</x-atoms.form-label>
                    <x-atoms.input oninput="cekInput(this)" name="longitude" id="longitude"
                        value="{{ $kelurahan->longitude }}" placeholder="Longitude" />
                </div>
            </div>
            <div class="mb-3">
                <x-atoms.form-label for="keterangan">Keterangan</x-atoms.form-label>
                <x-atoms.input name="keterangan" id="keterangan" value="{{ $kelurahan->keterangan }}"
                    placeholder="Keterangan" />
            </div>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('master.kelurahan.index') }}" class="btn btn-light me-3">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            $(document).on("form-submitted:edit-kelurahan_form", function(ev) {
                window.location.href = "{{ route('master.kelurahan.index') }}";
            });

            function cekInput(input) {
                var regex = /[^0-9.,-]/g;
                input.value = input.value.replace(regex, "");
            }
        </script>
    @endpush
@endsection
