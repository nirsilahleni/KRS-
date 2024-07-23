@can($globalModule['create'])
<x-mollecules.modal id="add-interpretasi_modal" action="{{ route('master.interpretasi.store') }}" tableId="interpretasi-table"
    method="POST">
    <x-slot:title>Tambah Data Interpretasi</x-slot:title>
    <div class="mb-3">
        <x-atoms.form-label for="kode" required>Kode </x-atoms.form-label>
        <x-atoms.input name="kode" id="kode" placeholder="Masukkan Kode Interpretasi" />
    </div>
    <div class="mb-3">
        <x-atoms.form-label for="interpretasi" required>Interpretasi</x-atoms.form-label>
        <x-atoms.input name="interpretasi" id="interpretasi" placeholder="Masukkan Interpretasi" />
    </div>
    <div class="mb-3">
        <x-atoms.form-label for="nilai_minimal" required>Nilai Minimal</x-atoms.form-label>
        <x-atoms.input name="nilai_minimal" id="nilai_minimal" placeholder="Masukkan Nilai Minimal" />
    </div>
    <div class="mb-3">
        <x-atoms.form-label for="nilai_maksimal" required>Nilai Maksimal</x-atoms.form-label>
        <x-atoms.input name="nilai_maksimal" id="nilai_maksimal" placeholder="Masukkan Nilai Maksimal" />
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
    <x-mollecules.modal id="edit-interpretasi_modal" action="/master/interpretasi/{id}" tableId="interpretasi-table"
        method="PUT">
        <x-slot:title>Edit Data Interpretasi</x-slot:title>
        <div class="mb-3">
            <x-atoms.form-label for="kode" required>Kode</x-atoms.form-label>
            <x-atoms.input name="kode" id="kode" placeholder="Masukkan Kode Interpretasi" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="interpretasi" required>Interpretasi</x-atoms.form-label>
            <x-atoms.input name="interpretasi" id="interpretasi" placeholder="Masukkan Interpretasi" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="nilai_minimal" required>Nilai Minimal</x-atoms.form-label>
            <x-atoms.input name="nilai_minimal" id="nilai_minimal" placeholder="Masukkan Nilai Minimal" />
        </div>
        <div class="mb-3">
            <x-atoms.form-label for="nilai_maksimal" required>Nilai Maksimal</x-atoms.form-label>
            <x-atoms.input name="nilai_maksimal" id="nilai_maksimal" placeholder="Masukkan Nilai Maksimal" />
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