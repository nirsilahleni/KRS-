@can($globalModule['create'])
    <x-mollecules.modal id="add-keluarga_modal" action="{{ route('master.keluarga.store') }}"
        tableId="statuskeluarga-table" method="POST">
        <x-slot:title>Tambah Status Keluarga</x-slot:title>
        <div class="mb-3">
            <x-atoms.form-label for="kode" required>Kode</x-atoms.form-label>
            <x-atoms.input name="kode" id="kode" value="{{ $newCode }}"
                placeholder="Example: SK-1" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="status_keluarga" required>Status Keluarga</x-atoms.form-label>
            <x-atoms.input name="status_keluarga" id="status_keluarga" placeholder="Masukkan Status Keluarga" />
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
    <x-mollecules.modal id="edit-keluarga_modal" action="/master/keluarga/{id}" tableId="statuskeluarga-table"
        tableId="statuskeluarga-table" method="PUT">
        <x-slot:title>Edit Status Keluarga</x-slot:title>
        <div class="mb-3">
            <x-atoms.form-label for="kode" required>Kode</x-atoms.form-label>
            <x-atoms.input name="kode" id="kode" placeholder="Example: SK-1" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="status_keluarga" required>Status Keluarga</x-atoms.form-label>
            <x-atoms.input name="status_keluarga" id="status_keluarga" placeholder="Masukkan Status Keluarga" />
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
