@can($globalModule['create'])
  <x-mollecules.modal id="add-ibuhamil_modal" size="lg" action="{{ route('monitoring.ibu-hamil.store') }}"
    tableId="ibuhamil-table">
    <x-slot:title>Monitoring Data Ibu Hamil</x-slot:title>
    <div class="row gy-4 ps-3 -mt-1">
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_field" required>Kepala Keluarga</x-atoms.form-label>
        <x-atoms.select2 name="kepala_keluarga_id" placeholder="Pilih Kepala Keluarga"
          source="{{ route('reference.kepala_keluarga') }}" id="kepala_keluarga_field"></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_anggota_field" required>Ibu Hamil</x-atoms.form-label>
        <x-atoms.select2 name="kepala_keluarga_anggota_id" placeholder="Pilih Ibu Hamil"
          source="{{ route('reference.ibu_hamil') }}" id="kepala_keluarga_anggota_field"
          title="Pilih Kepala Keluarga anda terlebih dahulu" disabled></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="nomor_kia_field" required>Nomor KIA</x-atoms.form-label>
        <x-atoms.input name="nomor_kia" minlength="16" maxlength="16" id="nomor_kia_field"
          placeholder="Masukkan Nomor KIA" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="posyandu_field" required>Posyandu</x-atoms.form-label>
        <x-atoms.select2 name="posyandu_id" placeholder="Pilih Posyandu" source="{{ route('reference.posyandu') }}"
          title="Pilih Kepala Keluarga anda terlebih dahulu" disabled id="posyandu_field"></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tanggal_perkiraan_lahir_field" required>Tanggal Perkiraan
          Lahir</x-atoms.form-label>
        <x-atoms.input name="tanggal_perkiraan_lahir" type="date" id="tanggal_perkiraan_lahir_field"
          placeholder="Tanggal Perkiraan Lahir" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tanggal_pendampingan_field" required>Tanggal Pendampingan</x-atoms.form-label>
        <x-atoms.input name="tanggal_pendampingan" type="date" id="tanggal_pendampingan_field"
          placeholder="Tanggal Pendampingan" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="bulan_field" required>Bulan Pendampingan</x-atoms.form-label>
        <x-atoms.select name="bulan" id="bulan_field" :value="$bulan" :lists="[
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ]" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="usia_kehamilan_field" required>Usia Kehamilan
          <span class="text-muted">(Dalam Satuan Bulan)</span>
        </x-atoms.form-label>
        <x-atoms.input type="number" min="0" max="9" name="usia_kehamilan" id="usia_kehamilan_field"
          placeholder="Usia Kehamilan" />
      </div>

      <div class="col-sm-6">
        <x-atoms.form-label required>Status Kehamilan</x-atoms.form-label>
        <x-atoms.select name="status_kehamilan" id="status_kehamilan_field" :lists="[
            'N' => 'Normal',
            'Risti' => 'Resiko Tinggi',
            'KEK' => 'Kekurangan Energi Kronis',
        ]" />
      </div>

      <div class="col-sm-6">
        <x-atoms.form-label required>Pemeriksaan Kehamilan</x-atoms.form-label>
        <x-atoms.radio-group name="pemeriksaan_kehamilan" id="pemeriksaan_kehamilan_field" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Pemeriksaan Nifas</x-atoms.form-label>
        <x-atoms.radio-group name="pemeriksaan_nifas" id="pemeriksaan_nifas_field" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Konsumsi Pil FE</x-atoms.form-label>
        <x-atoms.radio-group name="konsumsi_pil_fe" id="konsumsi_pil_fe_field" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Konseling Gizi</x-atoms.form-label>
        <x-atoms.radio-group name="konseling_gizi" id="konseling_gizi_field" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Kunjungan Rumah</x-atoms.form-label>
        <x-atoms.radio-group name="kunjungan_rumah" id="kunjungan_rumah_field" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Akses Air Bersih</x-atoms.form-label>
        <x-atoms.radio-group name="akses_air_bersih" id="akses_air_bersih_field" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Ada Jamban</x-atoms.form-label>
        <x-atoms.radio-group name="ada_jamban" id="ada_jamban_field" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Jaminan Kesehatan</x-atoms.form-label>
        <x-atoms.radio-group name="jaminan_kesehatan" id="jaminan_kesehatan_field" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-12 mb-4">
        <x-atoms.form-label for="catatan" required>Catatan</x-atoms.form-label>
        <x-atoms.textarea name="catatan" id="catatan" placeholder="Masukkan Catatan" rows="4" />
      </div>
    </div>
    <x-slot:footer>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan


@can($globalModule['update'])
  <x-mollecules.modal id="edit-ibuhamil_modal" size="lg" method="PUT" update-modal
    action="{{ route('monitoring.ibu-hamil.index') . '/{id}' }}" tableId="ibuhamil-table">
    <x-slot:title>Edit Data Monitoring Ibu Hamil</x-slot:title>
    <div class="row gy-4 ps-3 -mt-1">
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_field2" required>Kepala Keluarga</x-atoms.form-label>
        <x-atoms.select2 name="kepala_keluarga_id" placeholder="Pilih Kepala Keluarga"
          source="{{ route('reference.kepala_keluarga') }}" id="kepala_keluarga_field2"></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_anggota_field2" required>Ibu Hamil</x-atoms.form-label>
        <x-atoms.select2 name="kepala_keluarga_anggota_id" placeholder="Pilih Ibu Hamil"
          source="{{ route('reference.ibu_hamil') }}" id="kepala_keluarga_anggota_field2"
          title="Pilih Kepala Keluarga anda terlebih dahulu" readonly></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="nomor_kia_field2" required>Nomor KIA</x-atoms.form-label>
        <x-atoms.input name="nomor_kia" minlength="16" maxlength="16" id="nomor_kia_field2"
          placeholder="Masukkan Nomor KIA" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="posyandu_field2" required>Posyandu</x-atoms.form-label>
        <x-atoms.select2 name="posyandu_id" placeholder="Pilih Posyandu" source="{{ route('reference.posyandu') }}"
          title="Pilih Kepala Keluarga anda terlebih dahulu" readonly id="posyandu_field2"></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tanggal_perkiraan_lahir_field2" required>Tanggal Perkiraan
          Lahir</x-atoms.form-label>
        <x-atoms.input name="tanggal_perkiraan_lahir" type="date" id="tanggal_perkiraan_lahir_field2"
          placeholder="Tanggal Perkiraan Lahir" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tanggal_pendampingan_field2" required>Tanggal Pendampingan</x-atoms.form-label>
        <x-atoms.input name="tanggal_pendampingan" type="date" id="tanggal_pendampingan_field2"
          placeholder="Tanggal Pendampingan" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="bulan_field2" required>Bulan Pendampingan</x-atoms.form-label>
        <x-atoms.select name="bulan" id="bulan_field2" :lists="[
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ]" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="usia_kehamilan_field2" required>Usia Kehamilan
          <span class="text-muted">(Dalam Satuan Bulan)</span>
        </x-atoms.form-label>
        <x-atoms.input type="number" min="0" max="9" name="usia_kehamilan" id="usia_kehamilan_field2"
          placeholder="Usia Kehamilan" />
      </div>

      <div class="col-sm-6">
        <x-atoms.form-label required>Status Kehamilan</x-atoms.form-label>
        <x-atoms.select name="status_kehamilan" id="status_kehamilan_field2" :lists="[
            'N' => 'Normal',
            'Risti' => 'Resiko Tinggi',
            'KEK' => 'Kekurangan Energi Kronis',
        ]" />
      </div>

      <div class="col-sm-6">
        <x-atoms.form-label required>Pemeriksaan Kehamilan</x-atoms.form-label>
        <x-atoms.radio-group name="pemeriksaan_kehamilan" id="pemeriksaan_kehamilan_field2" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Pemeriksaan Nifas</x-atoms.form-label>
        <x-atoms.radio-group name="pemeriksaan_nifas" id="pemeriksaan_nifas_field2" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Konsumsi Pil FE</x-atoms.form-label>
        <x-atoms.radio-group name="konsumsi_pil_fe" id="konsumsi_pil_fe_field2" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Konseling Gizi</x-atoms.form-label>
        <x-atoms.radio-group name="konseling_gizi" id="konseling_gizi_field2" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Kunjungan Rumah</x-atoms.form-label>
        <x-atoms.radio-group name="kunjungan_rumah" id="kunjungan_rumah_field2" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Akses Air Bersih</x-atoms.form-label>
        <x-atoms.radio-group name="akses_air_bersih" id="akses_air_bersih_field2" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Ada Jamban</x-atoms.form-label>
        <x-atoms.radio-group name="ada_jamban" id="ada_jamban_field2" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Jaminan Kesehatan</x-atoms.form-label>
        <x-atoms.radio-group name="jaminan_kesehatan" id="jaminan_kesehatan_field2" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-12 mb-4">
        <x-atoms.form-label for="catatan" required>Catatan</x-atoms.form-label>
        <x-atoms.textarea name="catatan" id="catatan2" placeholder="Masukkan Catatan" rows="4" />
      </div>
    </div>
    <x-slot:footer>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan

@can($globalModule['read'])
  <x-mollecules.modal id="detail-ibuhamil_modal" action="" size="lg">
    <x-slot:title>Detail Data Monitoring Ibu Hamil</x-slot:title>
    <div class="row gy-4 ps-3 -mt-1">
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_field3" required>Kepala Keluarga</x-atoms.form-label>
        <x-atoms.select2 name="kepala_keluarga_id" placeholder="Pilih Kepala Keluarga"
          source="{{ route('reference.kepala_keluarga') }}" disabled id="kepala_keluarga_field3"></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_anggota_field3" required>Ibu Hamil</x-atoms.form-label>
        <x-atoms.select2 name="kepala_keluarga_anggota_id" placeholder="Pilih Ibu Hamil"
          source="{{ route('reference.ibu_hamil') }}" disabled id="kepala_keluarga_anggota_field3"
          title="Pilih Kepala Keluarga anda terlebih dahulu" disabled></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="nomor_kia_field3" required>Nomor KIA</x-atoms.form-label>
        <x-atoms.input name="nomor_kia" maxlength="16" disabled id="nomor_kia_field3"
          placeholder="Masukkan Nomor KIA" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="posyandu_field3" required>Posyandu</x-atoms.form-label>
        <x-atoms.select2 name="posyandu_id" placeholder="Pilih Posyandu" source="{{ route('reference.posyandu') }}"
          disabled id="posyandu_field3"></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tanggal_perkiraan_lahir_field3" required>Tanggal Perkiraan
          Lahir</x-atoms.form-label>
        <x-atoms.input name="tanggal_perkiraan_lahir" type="date" disabled id="tanggal_perkiraan_lahir_field3"
          placeholder="Tanggal Perkiraan Lahir" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tanggal_pendampingan_field3" required>Tanggal Pendampingan</x-atoms.form-label>
        <x-atoms.input name="tanggal_pendampingan" type="date" disabled id="tanggal_pendampingan_field3"
          placeholder="Tanggal Pendampingan" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="bulan_field3" required>Bulan Pendampingan</x-atoms.form-label>
        <x-atoms.select name="bulan" disabled id="bulan_field3" :lists="[
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ]" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="usia_kehamilan_field3" required>Usia Kehamilan
          <span class="text-muted">(Dalam Satuan Bulan)</span>
        </x-atoms.form-label>
        <x-atoms.input type="number" min="0" max="9" name="usia_kehamilan" disabled
          id="usia_kehamilan_field3" placeholder="Usia Kehamilan" />
      </div>

      <div class="col-sm-6">
        <x-atoms.form-label required>Status Kehamilan</x-atoms.form-label>
        <x-atoms.select name="status_kehamilan" disabled id="status_kehamilan_field3" :lists="[
            'N' => 'Normal',
            'Risti' => 'Resiko Tinggi',
            'KEK' => 'Kekurangan Energi Kronis',
        ]" />
      </div>

      <div class="col-sm-6">
        <x-atoms.form-label required>Pemeriksaan Kehamilan</x-atoms.form-label>
        <x-atoms.radio-group name="pemeriksaan_kehamilan" disabled id="pemeriksaan_kehamilan_field3" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Pemeriksaan Nifas</x-atoms.form-label>
        <x-atoms.radio-group name="pemeriksaan_nifas" disabled id="pemeriksaan_nifas_field3" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Konsumsi Pil FE</x-atoms.form-label>
        <x-atoms.radio-group name="konsumsi_pil_fe" disabled id="konsumsi_pil_fe_field3" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Konseling Gizi</x-atoms.form-label>
        <x-atoms.radio-group name="konseling_gizi" disabled id="konseling_gizi_field3" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Kunjungan Rumah</x-atoms.form-label>
        <x-atoms.radio-group name="kunjungan_rumah" disabled id="kunjungan_rumah_field3" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Akses Air Bersih</x-atoms.form-label>
        <x-atoms.radio-group name="akses_air_bersih disabled" id="akses_air_bersih_field3" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Ada Jamban</x-atoms.form-label>
        <x-atoms.radio-group name="ada_jamban" disabled id="ada_jamban_field3" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Jaminan Kesehatan</x-atoms.form-label>
        <x-atoms.radio-group name="jaminan_kesehatan" disabled id="jaminan_kesehatan_field3" value="Y"
          :lists="[
              'Y' => 'Ya',
              'N' => 'Tidak',
          ]"></x-atoms.radio-group>
      </div>
      <div class="col-sm-12 mb-4">
        <x-atoms.form-label for="catatan" required>Catatan</x-atoms.form-label>
        <x-atoms.textarea name="catatan" disabled id="catatan3" placeholder="Masukkan Catatan" rows="4" />
      </div>
    </div>
    <x-slot:footer>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan


<x-mollecules.modal id="filter-ibuhamil_modal" action="" :custom="true" :resetOnClose="false">
  <x-slot:title>Gunakan Filter</x-slot:title>
  <div class="row gy-4">
    <div class="">
      <x-atoms.form-label for="periode_field" required>Periode</x-atoms.form-label>
      <x-atoms.select2 name="periode_id" :value="[
          'v' => $current_periode['id'],
          't' => $current_periode['tahun'],
      ]" placeholder="Pilih Periode"
        source="{{ route('reference.periode') }}" id="periode_field4"></x-atoms.select2>
    </div>
    <div class="">
      <x-atoms.form-label for="bulan_field4" required>Bulan</x-atoms.form-label>
      <x-atoms.select name="bulan" id="bulan_field4" :lists="[
          '1' => 'Januari',
          '2' => 'Februari',
          '3' => 'Maret',
          '4' => 'April',
          '5' => 'Mei',
          '6' => 'Juni',
          '7' => 'Juli',
          '8' => 'Agustus',
          '9' => 'September',
          '10' => 'Oktober',
          '11' => 'November',
          '12' => 'Desember',
      ]" />
    </div>
    <div class="">
      <x-atoms.form-label for="posyandu_field4" required>Posyandu</x-atoms.form-label>
      <x-atoms.select2 name="posyandu_id" placeholder="Pilih Posyandu" source="{{ route('reference.posyandu') }}"
        id="posyandu_field4"></x-atoms.select2>
    </div>
  </div>
  <x-slot:footer>
    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
  </x-slot:footer>
</x-mollecules.modal>
