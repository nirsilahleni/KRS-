@extends('layouts.app')
@section('title', 'Keluarga Management')
@section('content')
    <div class="mt-2">
        <form action="{{ route('krs.keluarga.store') }}" method="POST" id="create-keluarga_form">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="nomor_kk" required>Nomor KK</x-atoms.form-label>
                    <x-atoms.input name="nomor_kk" id="nomor_kk" type="number" placeholder="Masukkan Nomor KK"
                        maxlength="16" />
                </div>
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="nik" required>NIK</x-atoms.form-label>
                    <x-atoms.input name="nik" type="number" id="nik" placeholder="Masukkan Nik" maxlength="16" />
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="nama_lengkap" required>Nama Lengkap</x-atoms.form-label>
                    <x-atoms.input name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" />
                </div>

                @if (auth()->user()->getRoleNames()->first() == 'kader')
                    <input type="hidden" name="kecamatan_id" value="{{ auth()->user()->asKaderInstance?->kecamatan_id }}">
                    <input type="hidden" name="kelurahan_id" value="{{ auth()->user()->asKaderInstance?->kelurahan_id }}">
                @else
                    <div class="col-md-6 mb-3">
                        <x-atoms.form-label for="kecamatan_id" required>Kecamatan</x-atoms.form-label>
                        <x-atoms.select2 id="kecamatan_id" name="kecamatan_id" placeholder="Pilih Kecamatan anda"
                            source="{{ route('reference.kecamatan') }}">
                        </x-atoms.select2>
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-atoms.form-label for="kelurahan_id" required>Kelurahan</x-atoms.form-label>
                        <x-atoms.select2 id="kelurahan_id" name="kelurahan_id" title="Pilih Kecamatan anda terlebih dahulu"
                            disabled source="{{ route('reference.kelurahan') }}">
                        </x-atoms.select2>
                    </div>
                @endif

                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="status_keluarga_id" required>Status Keluarga</x-atoms.form-label>
                    <x-atoms.select2 id="status_keluarga_id" name="status_keluarga_id" :lists="c_option($statusKeluarga, 'status_keluarga')">
                    </x-atoms.select2>
                </div>

                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="rt" required>Rt</x-atoms.form-label>
                    <x-atoms.input name="rt" id="rt" placeholder="Masukkan Rt" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="rw" required>Rw</x-atoms.form-label>
                    <x-atoms.input name="rw" id="rw" placeholder="Masukkan Rw" />
                </div>

                <div class="col-md-12 mb-3">
                    <x-atoms.form-label for="alamat" required>Alamat</x-atoms.form-label>
                    <x-atoms.textarea name="alamat" id="alamat" placeholder="Masukkan Alamat" rows="4" />
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('krs.keluarga.index') }}" class="btn btn-light me-3">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $(document).on("form-submitted:create-keluarga_form", function(ev) {
                window.location.href = "{{ route('krs.keluarga.index') }}";
            });
            $("#nik, #nomor_kk").on("input", function() {
                if ($(this).val().length > 16) {
                    $(this).val($(this).val().slice(0, 16));
                }
            })

            $("#kecamatan_id").on("change", function() {

                $("#kelurahan_id").select2({
                    placeholder: "Pilih Kelurahan anda",
                    disabled: false,
                    ajax: {
                        url: `{{ route('reference.kelurahan') }}?kecamatan_id=${$(this).val()}`,
                        dataType: 'json',
                        processResults: function(data) {
                            return {
                                results: data.data,
                            };
                        },
                    }
                });

            });

        })
    </script>
@endpush
