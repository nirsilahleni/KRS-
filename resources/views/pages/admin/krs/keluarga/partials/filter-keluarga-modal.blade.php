<x-mollecules.modal id="filter-keluarga_modal" action="" :custom="true" :resetOnClose="false">
  <x-slot:title>Gunakan Filter</x-slot:title>
  <div class="row gy-4">
    <div>
      <x-atoms.form-label for="kecamatan_field4" required>Kecamatan</x-atoms.form-label>
      <x-atoms.select2 name="kecamatan_id" id="kecamatan_field4" source="{{ route('reference.kecamatan') }}" />
    </div>
    <div>
      <x-atoms.form-label for="kelurahan_field4" required>Kelurahan</x-atoms.form-label>
      <x-atoms.select2 name="kelurahan_id" disabled source="{{ route('reference.kelurahan') }}" id="kelurahan_field4" />
    </div>
    <div>
      <x-atoms.form-label for="rt_field">RT</x-atoms.form-label>
      <x-atoms.input name="rt" id="rt_field4" placeholder="Masukkan RT" />
    </div>
    <div>
      <x-atoms.form-label for="rw_field">RT</x-atoms.form-label>
      <x-atoms.input name="rw" id="rw_field4" placeholder="Masukkan RW" />
    </div>
  </div>
  <x-slot:footer>
    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
  </x-slot:footer>
</x-mollecules.modal>
