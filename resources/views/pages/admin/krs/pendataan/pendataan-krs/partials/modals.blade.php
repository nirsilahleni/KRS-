@can($globalModule['create'])
  <x-mollecules.modal id="add-pendataan-krs_modal" size="lg" action="{{ route('krs.pendataan.pendataan-krs.store') }}"
    tableId="pendataankrs-table">
    <x-slot:title>Menambahkan Pendataan KRS</x-slot:title>
    <div class="row gy-4 ps-3 -mt-1 pb-5">
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_field" required>Nama Kepala Keluarga</x-atoms.form-label>
        <x-atoms.select2 parent="#add-pendataan-krs_modal" name="kepala_keluarga_id" placeholder="Pilih Kepala Keluarga"
          source="{{ route('reference.kepala_keluarga') }}" id="kepala_keluarga_field" />
      </div>

      <div class="col-sm-6">
        <x-atoms.form-label for="asi_eksklusif_field" required>Balita/Baduta mendapat ASI eksklusif
          ini</x-atoms.form-label>
        <x-atoms.radio-group value='tidak' :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="asi_eksklusif"
          id="asi_eksklusif_field"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tempat_buang_air_field" required>Tempat Buang Air</x-atoms.form-label>
        <x-atoms.select name="tempat_buang_air_id" id="tempat_buang_air_field" :lists="c_option($ref_tba, 'nama')"
          placeholder="Pilih tempat membuang air" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="sumber_air_minum_field" required>Jenis Sumber Air Minum</x-atoms.form-label>
        <x-atoms.select name="sumber_air_minum_id" :lists="c_option($ref_sumber_air, 'nama')" id="sumber_air_minum_field"
          placeholder="Pilih jenis Air Minum" />
      </div>
      <div class="col-sm-6 ">
        <x-atoms.form-label for="jenis_kb_field" required>Jenis KB</x-atoms.form-label>
        <x-atoms.select name="kb_modern_id" id="jenis_KB_field" :lists="c_option($ref_jenis_kb, 'jenis')" placeholder="Pilih Jenis KB" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="ada_anggota_keluarga_menikah_tahun_ini_field" required>Ada anggota yang menikah tahun
          ini</x-atoms.form-label>
        <x-atoms.radio-group value='tidak' :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="ada_anggota_keluarga_menikah_tahun_ini"
          id="ada_anggota_keluarga_menikah_tahun_ini_field"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="ada_ibu_hamil_field" required>Ada ibu hamil</x-atoms.form-label>
        <x-atoms.radio-group value='tidak' :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="ada_ibu_hamil"
          id="ada_ibu_hamil_field"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="punya_baduta_field" required>Punya Baduta</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="punya_baduta" id="punya_baduta_field"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="punya_balita_field" required>Punya Balita</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="punya_balita" id="punya_balita_field"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="status_pasangan_usia_subur_field" required>Termasuk PUS</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="status_pasangan_usia_subur"
          id="status_pasangan_usia_subur_field"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_muda_field" required>Terlalu Muda</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_muda"
          id="terlalu_muda_field"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_tua_field" required>Terlalu Tua</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_tua" id="terlalu_tua_field"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_dekat_field" required>Terlalu Dekat</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_dekat"
          id="terlalu_dekat_field"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_banyak_anak_field" required>Terlalu Banyak Anak</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_banyak_anak"
          id="terlalu_banyak_anak_field"></x-atoms.radio-group>

      </div>
    </div>
    <x-slot:footer>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan
@can($globalModule['update'])
  <x-mollecules.modal id="edit-pendataan-krs_modal" size="lg" method="PUT"
    action="{{ route('krs.pendataan.pendataan-krs.index') }}/{id}" tableId="pendataankrs-table">
    <x-slot:title>Edit Pendataan KRS</x-slot:title>
    <div class="row gy-4 ps-3 -mt-1 pb-5">
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_field2" required>Nama Kepala Keluarga</x-atoms.form-label>
        <x-atoms.select2 parent="#edit-pendataan-krs_modal" disabled name="kepala_keluarga_id"
          placeholder="Pilih Kepala Keluarga" source="{{ route('reference.kepala_keluarga') }}"
          id="kepala_keluarga_field2" />
      </div>

      <div class="col-sm-6">
        <x-atoms.form-label for="asi_eksklusif_field2" required>Balita/Baduta mendapat ASI eksklusif</x-atoms.form-label>
        <x-atoms.radio-group value='tidak' :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="asi_eksklusif"
          id="asi_eksklusif_field2"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tempat_buang_air_field2" required>Tempat Buang Air</x-atoms.form-label>
        <x-atoms.select name="tempat_buang_air_id" id="tempat_buang_air_field2" :lists="c_option($ref_tba, 'nama')"
          placeholder="Pilih tempat membuang air" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="sumber_air_minum_field2" required>Jenis Sumber Air Minum</x-atoms.form-label>
        <x-atoms.select name="sumber_air_minum_id" :lists="c_option($ref_sumber_air, 'nama')" id="sumber_air_minum_field2"
          placeholder="Pilih jenis Air Minum" />
      </div>
      <div class="col-sm-6 ">
        <x-atoms.form-label for="jenis_kb_field2" required>Jenis KB</x-atoms.form-label>
        <x-atoms.select name="kb_modern_id" id="jenis_KB_field2" :lists="c_option($ref_jenis_kb, 'jenis')" placeholder="Pilih Jenis KB" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="ada_anggota_keluarga_menikah_tahun_ini_field2" required>Ada anggota yang menikah tahun
          ini</x-atoms.form-label>
        <x-atoms.radio-group value='tidak' :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="ada_anggota_keluarga_menikah_tahun_ini"
          id="ada_anggota_keluarga_menikah_tahun_ini_field2"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="ada_ibu_hamil_field2" required>Ada ibu hamil</x-atoms.form-label>
        <x-atoms.radio-group value='tidak' :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="ada_ibu_hamil"
          id="ada_ibu_hamil_field2"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="punya_baduta_field2" required>Punya Baduta</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="punya_baduta"
          id="punya_baduta_field2"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="punya_balita_field2" required>Punya Balita</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="punya_balita"
          id="punya_balita_field2"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="status_pasangan_usia_subur_field2" required>Termasuk PUS</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="status_pasangan_usia_subur"
          id="status_pasangan_usia_subur_field2"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_muda_field2" required>Terlalu Muda</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_muda"
          id="terlalu_muda_field2"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_tua_field2" required>Terlalu Tua</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_tua"
          id="terlalu_tua_field2"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_dekat_field2" required>Terlalu Dekat</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_dekat"
          id="terlalu_dekat_field2"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_banyak_anak_field2" required>Terlalu Banyak Anak</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_banyak_anak"
          id="terlalu_banyak_anak_field2"></x-atoms.radio-group>
      </div>
    </div>
    <x-slot:footer>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan
@can($globalModule['read'])
  <x-mollecules.modal id="show-pendataan-krs_modal" size="lg" action="" tableId="pendataankrs-table">
    <x-slot:title>Detail Pendataan KRS</x-slot:title>
    <div class="row gy-4 ps-3 -mt-1 pb-5">
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_field3" required>Nama Kepala Keluarga</x-atoms.form-label>
        <x-atoms.select2 parent="#edit-pendataan-krs_modal" disabled name="kepala_keluarga_id"
          placeholder="Pilih Kepala Keluarga" source="{{ route('reference.kepala_keluarga') }}"
          id="kepala_keluarga_field3" />
      </div>

      <div class="col-sm-6">
        <x-atoms.form-label for="asi_eksklusif_field3" required>Balita/Baduta mendapat ASI eksklusif
          ini</x-atoms.form-label>
        <x-atoms.radio-group value='tidak' disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="asi_eksklusif"
          id="asi_eksklusif_field3"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tempat_buang_air_field3" required>Tempat Buang Air</x-atoms.form-label>
        <x-atoms.select name="tempat_buang_air_id" disabled id="tempat_buang_air_field3" :lists="c_option($ref_tba, 'nama')"
          placeholder="Pilih tempat membuang air" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="sumber_air_minum_field3" required>Jenis Sumber Air Minum</x-atoms.form-label>
        <x-atoms.select name="sumber_air_minum_id" disabled :lists="c_option($ref_sumber_air, 'nama')" id="sumber_air_minum_field3"
          placeholder="Pilih jenis Air Minum" />
      </div>
      <div class="col-sm-6 ">
        <x-atoms.form-label for="jenis_kb_field3" required>Jenis KB</x-atoms.form-label>
        <x-atoms.select name="kb_modern_id" id="jenis_KB_field3" disabled :lists="c_option($ref_jenis_kb, 'jenis')"
          placeholder="Pilih Jenis KB" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="ada_anggota_keluarga_menikah_tahun_ini_field3" required>Ada anggota yang menikah tahun
          ini</x-atoms.form-label>
        <x-atoms.radio-group value='tidak' disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="ada_anggota_keluarga_menikah_tahun_ini"
          id="ada_anggota_keluarga_menikah_tahun_ini_field3"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="ada_ibu_hamil_field3" required>Ada ibu hamil</x-atoms.form-label>
        <x-atoms.radio-group value='tidak' disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="ada_ibu_hamil"
          id="ada_ibu_hamil_field3"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="punya_baduta_field3" required>Punya Baduta</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="punya_baduta"
          id="punya_baduta_field3"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="punya_balita_field3" required>Punya Balita</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="punya_balita"
          id="punya_balita_field3"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="status_pasangan_usia_subur_field3" required>Termasuk PUS</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="status_pasangan_usia_subur"
          id="status_pasangan_usia_subur_field3"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_muda_field3" required>Terlalu Muda</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_muda"
          id="terlalu_muda_field3"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_tua_field3" required>Terlalu Tua</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_tua"
          id="terlalu_tua_field3"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_dekat_field3" required>Terlalu Dekat</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_dekat"
          id="terlalu_dekat_field3"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="terlalu_banyak_anak_field3" required>Terlalu Banyak Anak</x-atoms.form-label>
        <x-atoms.radio-group disabled :lists="[
            'ya' => 'Ya',
            'tidak' => 'Tidak',
        ]" name="terlalu_banyak_anak"
          id="terlalu_banyak_anak_field3"></x-atoms.radio-group>
      </div>
    </div>
    <x-slot:footer>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan

<x-mollecules.modal id="filter-pendataan-krs_modal" action="" size="lg" :custom="true" :resetOnClose="false">
  <x-slot:title>Gunakan Filter</x-slot:title>
  <div class="row gy-4">
    <div class="col-lg-6">
      <x-atoms.form-label for="kepala_keluarga_field4" >Kepala Keluarga</x-atoms.form-label>
      <x-atoms.select2 name="kepala_keluarga_id" placeholder="Pilih Kepala Keluarga"
        source="{{ route('reference.kepala_keluarga') }}" id="kepala_keluarga_field4"></x-atoms.select2>
    </div>
    <div class="col-lg-6">
      <x-atoms.form-label for="tempat_buang_air_field4" >Tempat Buang Air</x-atoms.form-label>
      <x-atoms.select name="tempat_buang_air_id" id="tempat_buang_air_field4" :lists="c_option($ref_tba, 'nama')"
        placeholder="Pilih tempat membuang air" />
    </div>
    <div class="col-lg-6">
      <x-atoms.form-label for="sumber_air_minum_field4" >Jenis Sumber Air Minum</x-atoms.form-label>
      <x-atoms.select name="sumber_air_minum_id" :lists="c_option($ref_sumber_air, 'nama')" id="sumber_air_minum_field4"
        placeholder="Pilih jenis Air Minum" />
    </div>
    <div class="col-lg-6 ">
      <x-atoms.form-label for="jenis_kb_field4" >Jenis KB</x-atoms.form-label>
      <x-atoms.select name="kb_modern_id" id="jenis_KB_field4" :lists="c_option($ref_jenis_kb, 'jenis')"
        placeholder="Pilih Jenis KB" />
    </div>

    <div class="col-lg-6">
      <x-atoms.form-label for="status_krs" >Status Krs</x-atoms.form-label>
      <x-atoms.select name="status_krs" id="status_krs" :lists="[
          'beresiko' => 'Beresiko',
          'tidak beresiko' => 'Tidak Beresiko',
      ]" />
    </div>
    <div>
        <x-atoms.form-label  >Filter Lainnya</x-atoms.form-label>
        <div class="row gy-3 ">
            <x-atoms.checkbox class="col-sm-6" name="punya_baduta">Punya Baduta</x-atoms.checkbox>
            <x-atoms.checkbox class="col-sm-6" name="punya_balita">Punya Balita</x-atoms.checkbox>
            <x-atoms.checkbox class="col-sm-6" name="status_pasangan_usia_subur">Termasuk PUS</x-atoms.checkbox>
            <x-atoms.checkbox class="col-sm-6" name="asi_eksklusif">Asi Eksklusif</x-atoms.checkbox>
            <x-atoms.checkbox class="col-sm-6" name="ada_ibu_hamil">Ada Ibu Hamil</x-atoms.checkbox>
            <x-atoms.checkbox class="col-sm-6" name="terlalu_muda">Terlalu Muda</x-atoms.checkbox>
            <x-atoms.checkbox class="col-sm-6" name="terlalu_tua">Terlalu Tua</x-atoms.checkbox>
            <x-atoms.checkbox class="col-sm-6" name="terlalu_dekat">Terlalu Dekat</x-atoms.checkbox>
            <x-atoms.checkbox class="col-sm-6" name="terlalu_banyak_anak">Terlalu Banyak Anak</x-atoms.checkbox>
            <x-atoms.checkbox class="col-sm-6" name="ada_anggota_keluarga_yang_menikah_tahun_ini">Ada Anggota Keluarga Yang Menikah Tahun ini</x-atoms.checkbox>
        </div>
    </div>
  </div>
  <x-slot:footer>
    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
  </x-slot:footer>
</x-mollecules.modal>
