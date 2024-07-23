<x-mollecules.modal id="import_modal" action="{{ route('monitoring.balita.import') }}">
  <x-slot:title>Import data pendampingan</x-slot:title>
  <div class="row gy-4">
    <div>
      <x-atoms.form-label required for="file_field">File</x-atoms.form-label>
      <x-atoms.dropzone name="file" id="file_field"
        accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
    </div>
    <div>
      <x-atoms.form-label required for="sheet_field">Sheet</x-atoms.form-label>
      <x-atoms.select value="" name="sheet" id="sheet_field" placeholder="Pilih sheet yang diimport">
        <option value="all" selected>Semua sheet</option>
      </x-atoms.select>
    </div>
  </div>
  <x-slot:footer>
    <button type="submit" class="btn btn-primary">Import</button>
  </x-slot:footer>
</x-mollecules.modal>
