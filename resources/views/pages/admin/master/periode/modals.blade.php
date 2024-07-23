<x-mollecules.modal id="edit-periode_modal" action="/master/periode/{id}" method="PUT"
        tableId="periode-table" hasCloseBtn="true">
    <x-slot:title>Edit Periode</x-slot:title>
    <x-slot:footer>
        <button class="btn-primary btn" type="submit" data-text="Save" data-text-loading="Saving">Save</button>
    </x-slot:footer>
    <div>
        <div class="mb-6">
            <x-atoms.form-label required>Tahun</x-atoms.form-label>
            {{-- <x-atoms.input type="number" id="tahun" name="tahun" min="1900"
                max="{{ date('Y') }}" placeholder="Masukkan Tahun"> --}}
            <x-atoms.input id="tahun" name="tahun" type="number" class="form-control"
                placeholder="Masukkan Tahun" />
        </div>

        <div class="mb-6">
            <x-atoms.form-label>Tanggal Mulai</x-atoms.form-label>
            <x-atoms.input id="tanggal_mulai" name="tanggal_mulai" type="date" class="form-control"
                placeholder="Masukkan Tanggal Mulai" />
        </div>

        <div class="mb-6">
            <x-atoms.form-label>Tanggal Selesai</x-atoms.form-label>
            <x-atoms.input id="tanggal_selesai" name="tanggal_selesai" type="date" class="form-control"
                placeholder="Masukkan Tanggal Selesai" />
        </div>
    </div>
</x-mollecules.modal>

<x-mollecules.modal id="add-periode-modal" action="{{ route('master.periode.store') }}" method="POST"
    data-table-id="periode-table" tableId="periode-table" hasCloseBtn="true">
    @csrf
    <x-slot:title>Tambah Periode</x-slot:title>
    <x-slot:footer>
        <button class="btn-primary btn" type="submit" data-text="Save" data-text-loading="Saving">Save</button>
    </x-slot:footer>
    <div>
        <div class="mb-6">
            <div class="mb-6">
                <x-atoms.form-label required>Tahun</x-atoms.form-label>
                <x-atoms.input id="tahun_edit" name="tahun" type="number" class="form-control"
                    placeholder="Masukkan Tahun" />
            </div>

            <div class="mb-6">
                <x-atoms.form-label>Tanggal Mulai</x-atoms.form-label>
                <x-atoms.input id="tanggal_mulai_edit" name="tanggal_mulai" type="date" class="form-control"
                    placeholder="Masukkan Tanggal Mulai" />
            </div>

            <div class="mb-6">
                <x-atoms.form-label>Tanggal Selesai</x-atoms.form-label>
                <x-atoms.input id="tanggal_selesai_edit" name="tanggal_selesai" type="date" class="form-control"
                    placeholder="Masukkan Tanggal Selesai" />
            </div>
        </div>
    </div>
</x-mollecules.modal>
