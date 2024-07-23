@can($globalModule['create'])
    <x-mollecules.modal id="add-kecamatan_modal" action="{{ route('master.kecamatan.store') }}" tableId="kecamatan-table"
        method="POST">
        <x-slot:title>Tambah Data Kecamatan</x-slot:title>
        <div class="mb-3">
            <x-atoms.form-label for="kode_kecamatan" required>Kode</x-atoms.form-label>
            <x-atoms.input name="kode_kecamatan" id="kode_kecamatan" placeholder="Masukkan Kode Kecamatan" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="nama_kecamatan" required>Nama Kecamatan</x-atoms.form-label>
            <x-atoms.input name="nama_kecamatan" id="nama_kecamatan" placeholder="Masukkan Nama Kecamatan" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="latitude">Latitude</x-atoms.form-label>
            <x-atoms.input oninput="cekInput(this)" name="latitude" id="latitude" placeholder="Masukkan Latitude" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="longitude">Longitude</x-atoms.form-label>
            <x-atoms.input oninput="cekInput(this)" name="longitude" id="longitude" placeholder="Masukkan Longitude" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="keterangan">Keterangan</x-atoms.form-label>
            <x-atoms.input name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" />
        </div>
        <x-slot:footer>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </x-slot:footer>
    </x-mollecules.modal>
@endcan

@can($globalModule['update'])
    <x-mollecules.modal id="edit-kecamatan_modal" action="/master/kecamatan/{id}" tableId="kecamatan-table" method="PUT">
        <x-slot:title>Edit Data Kecamatan</x-slot:title>
        <div class="mb-3">
            <x-atoms.form-label for="kode_kecamatan" required>Kode</x-atoms.form-label>
            <x-atoms.input name="kode_kecamatan" id="kode_kecamatan" placeholder="Masukkan Kode Kecamatan" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="nama_kecamatan" required>Nama Kecamatan</x-atoms.form-label>
            <x-atoms.input name="nama_kecamatan" id="nama_kecamatan" placeholder="Masukkan Nama Kecamatan" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="latitude">Latitude</x-atoms.form-label>
            <x-atoms.input oninput="cekInput(this)" name="latitude" id="latitude" placeholder="Masukkan Latitude" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="longitude">Longitude</x-atoms.form-label>
            <x-atoms.input oninput="cekInput(this)" name="longitude" id="longitude" placeholder="Masukkan Longitude" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="keterangan">Keterangan</x-atoms.form-label>
            <x-atoms.input name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" />
        </div>
        <x-slot:footer>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </x-slot:footer>
    </x-mollecules.modal>
@endcan
