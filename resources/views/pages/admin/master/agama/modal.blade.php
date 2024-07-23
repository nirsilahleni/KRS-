@can($globalModule['create'])
    <x-mollecules.modal id="add-agama_modal" action="{{ route('master.agama.store') }}" tableId="agama-table" method="POST">
        <x-slot:title>Tambah Agama</x-slot:title>
        <div class="mb-3">
            <x-atoms.form-label for="agama" required>Agama</x-atoms.form-label>
            <x-atoms.input name="agama" id="agama" placeholder="Masukkan Agama" />
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
    <x-mollecules.modal id="edit-agama_modal" action="/master/agama/{id}" tableId="agama-table" method="PUT">
        <x-slot:title>Edit Data Agama</x-slot:title>
        <div class="mb-3">
            <x-atoms.form-label for="agama" required>Agama</x-atoms.form-label>
            <x-atoms.input name="agama" id="agama" placeholder="Masukkan Agama" />
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
