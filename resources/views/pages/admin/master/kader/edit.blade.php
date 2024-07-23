@extends('layouts.app')
@section('title', 'Edit Data Kader')

@section('content')
    <div class="mt-2">
        <form action="{{ route('master.kader.update', $kader->id) }}" method="POST" id="edit-kader_form">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="nama_lengkap" required>Nama Lengkap</x-atoms.form-label>
                    <x-atoms.input name="nama_lengkap" id="nama_lengkap" value="{{ $kader->nama_lengkap }}"
                        placeholder="Masukkan Nama Lengkap" />
                </div>
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="nik" required>NIK</x-atoms.form-label>
                    <x-atoms.input name="nik" id="nik" maxlength="16" minlength="16" value="{{ $kader->nik }}"
                        placeholder="Masukkan NIK" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="email" required>Email</x-atoms.form-label>
                    <x-atoms.input name="email" id="email" value="{{ $kader->email }}" placeholder="Pilih Email">
                        </x-atoms.select2>
                </div>
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="jenis_kelamin" required>Jenis Kelamin</x-atoms.form-label>
                    <x-atoms.select2 name="jenis_kelamin" id="jenis_kelamin" placeholder="Pilih Jenis Kelamin">
                        <option value="L" {{ $kader->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="P" {{ $kader->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </x-atoms.select2>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="tempat_lahir" required>Tempat Lahir</x-atoms.form-label>
                    <x-atoms.input name="tempat_lahir" id="tempat_lahir" value="{{ $kader->tempat_lahir }}"
                        placeholder="Masukkan Tempat Lahir" />
                </div>
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="tanggal_lahir" required>Tanggal Lahir</x-atoms.form-label>
                    <x-atoms.input type="date" name="tanggal_lahir" id="tanggal_lahir"
                        value="{{ $kader->tanggal_lahir }}" placeholder="Masukkan Tanggal Lahir" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="nomor_hp" required>Nomor HP</x-atoms.form-label>
                    <x-atoms.input name="nomor_hp" id="nomor_hp" placeholder="Masukkan Nomor HP" type="number"
                        value="{{ $kader->nomor_hp }}" />
                </div>
                <div class="col-md-3 mb-3">
                    <x-atoms.form-label for="rt" required>RT</x-atoms.form-label>
                    <x-atoms.input name="rt" id="rt" value="{{ $kader->rt }}" placeholder="0"
                        type="number" />
                </div>
                <div class="col-md-3 mb-3">
                    <x-atoms.form-label for="rw" required>RW</x-atoms.form-label>
                    <x-atoms.input name="rw" id="rw" value="{{ $kader->rw }}" placeholder="0"
                        type="number" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="alamat" required>Alamat</x-atoms.form-label>
                    <x-atoms.input name="alamat" id="alamat" value="{{ $kader->alamat }}"
                        placeholder="Masukkan Alamat" />
                </div>
                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="kecamatan_id">Kecamatan</x-atoms.form-label>
                    <x-atoms.select2 name="kecamatan_id" id="kecamatan_id" :value="[
                        't' => $kader->kecamatan->nama_kecamatan,
                        'v' => $kader->kecamatan_id,
                    ]" placeholder="Pilih Kecamatan"
                        source="{{ route('reference.kecamatan') }}" />
                </div>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="kelurahan_id" required>Kelurahan</x-atoms.form-label>
                    <x-atoms.select2 name="kelurahan_id" id="kelurahan_id" :value="[
                        't' => $kader->kelurahan->nama_kelurahan,
                        'v' => $kader->kelurahan_id,
                    ]" placeholder="Pilih Kelurahan"
                        source="{{ route('reference.kelurahan') }}?kecamatan_id={{ $kader->kecamatan_id }}" />
                </div>

                <div class="col-md-6 mb-3">
                    <x-atoms.form-label for="posyandu_id" required>Posyandu</x-atoms.form-label>
                    <x-atoms.select2 name="posyandu_id" id="posyandu_id" :value="[
                        't' => $kader->posyandu->nama_posyandu,
                        'v' => $kader->posyandu_id,
                    ]" placeholder="Pilih Posyandu"
                        source="{{ route('reference.posyandu') }}?kelurahan_id={{ $kader->kelurahan_id }}" />
                </div>
            </div>

    </div>

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('master.kader.index') }}" class="btn btn-light me-3">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    </form>
    </div>

    @push('scripts')
        <script>
            $(document).on("form-submitted:edit-kader_form", function(ev) {
                window.location.href = "{{ route('master.kader.index') }}";
            });

            $(document).ready(function() {
                const kecamatan_id = $('[name="kecamatan_id"]');
                const kelurahan_id = $('[name="kelurahan_id"]');
                const posyandu_id = $('[name="posyandu_id"]');

                kecamatan_id.on('change', function() {
                    if (!kecamatan_id.val()) {
                        kelurahan_id.empty();
                        posyandu_id.empty();
                        kelurahan_id.attr('disabled', true);
                        posyandu_id.attr('disabled', true);
                        return;
                    }
                    kelurahan_id.empty();
                    posyandu_id.empty();
                    kelurahan_id.attr('disabled', false);
                    posyandu_id.attr('disabled', true);

                    const kelurahanSelect2Setting = {
                        allowClear: true,
                        ajax: {
                            url: `{{ route('reference.kelurahan') }}`,
                            data: function(params) {
                                return {
                                    search: params.term,
                                    kecamatan_id: kecamatan_id.val()
                                }
                            },
                            processResults: function(data) {
                                return {
                                    results: data.data
                                }
                            }
                        }
                    }
                    kelurahan_id.select2(kelurahanSelect2Setting);
                })

                kelurahan_id.on('change', function() {
                    if (!kelurahan_id.val()) {
                        posyandu_id.empty();
                        posyandu_id.attr('disabled', true);
                        return;
                    }
                    posyandu_id.empty();
                    posyandu_id.attr('disabled', false);

                    const posyanduSelect2Setting = {
                        allowClear: true,
                        ajax: {
                            url: `{{ route('reference.posyandu') }}`,
                            data: function(params) {
                                return {
                                    search: params.term,
                                    kelurahan_id: kelurahan_id.val()
                                }
                            },
                            processResults: function(data) {
                                return {
                                    results: data.data
                                }
                            }
                        }
                    }
                    posyandu_id.select2(posyanduSelect2Setting);
                })

            })
        </script>
    @endpush
@endsection
