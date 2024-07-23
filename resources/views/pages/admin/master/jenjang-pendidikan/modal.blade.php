@can($globalModule['create'])
<x-mollecules.modal id="add-pendidikan_modal" action="{{ route('master.pendidikan.store') }}" tableId="jenjangpendidikan-table"
    method="POST">
    <x-slot:title>Tambah Jenjang Pendidikan</x-slot:title>
    <div class="mb-3">
        <x-atoms.form-label for="kode" required>Kode</x-atoms.form-label>
        <x-atoms.input name="kode" id="kode" placeholder="Masukkan Kode" />
    </div>
    <div class="mb-3">
        <x-atoms.form-label for="nama_jenjang" required>Nama Jenjang</x-atoms.form-label>
        <x-atoms.input name="nama_jenjang" id="nama_jenjang" placeholder="Masukkan Nama Jenjang" />
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
    <x-mollecules.modal id="edit-pendidikan_modal" action="/master/pendidikan/{id}" tableId="jenjangpendidikan-table"
        method="PUT">
        <x-slot:title>Edit Data Jenjang Pendidikan</x-slot:title>
        <div class="mb-3">
            <x-atoms.form-label for="kode" required>Kode</x-atoms.form-label>
            <x-atoms.input name="kode" id="kode" placeholder="Masukkan Kode" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="nama_jenjang" required>Nama Jenjang</x-atoms.form-label>
            <x-atoms.input name="nama_jenjang" id="nama_jenjang" placeholder="Masukkan Nama Jenjang" />
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
