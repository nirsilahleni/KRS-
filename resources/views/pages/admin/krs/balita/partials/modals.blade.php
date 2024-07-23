@can($globalModule['create'])
  <x-mollecules.modal id="add-balita_modal" size="lg" action="{{ route('krs.balita.store') }}" tableId="balita-table">
    <x-slot:title>Menambahkan Data Balita</x-slot:title>
    <div class="row gy-4 ps-3 -mt-1">
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_field" required>Kepala Keluarga</x-atoms.form-label>
        <x-atoms.select2 name="kepala_keluarga_id" placeholder="Pilih Kepala Keluarga"
          source="{{ route('reference.kepala_keluarga') }}" id="kepala_keluarga_field"></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label>NIK</x-atoms.form-label>
        <x-atoms.input type="number" name="nik" id="nik_field" maxlength="16" placeholder="Masukkan NIK " />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="nama_field" required>Nama Lengkap</x-atoms.form-label>
        <x-atoms.input name="nama_lengkap" id="nama_lengkap_field" placeholder="Masukkan Nama Lengkap" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Jenis Kelamin</x-atoms.form-label>
        <x-atoms.select name="jenis_kelamin" id="jenis_kelamin_field" :lists="[
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
        ]" />
      </div>
      <div class="col-sm-6 ">
        <div class="row align-items-end gx-3 gy-4">
          <div class="col-sm-6 col-md-12 col-lg-6">
            <x-atoms.form-label for="tempat_lahir_field" required>Tempat / Tanggal Lahir</x-atoms.form-label>
            <x-atoms.input name="tempat_lahir" id="tempat_lahir_field" placeholder="Tempat Lahir" />
          </div>
          <div class="col-sm-6 col-md-12 col-lg-6">
            <x-atoms.input name="tanggal_lahir" type="date" id="tanggal_lahir_field" placeholder="Tanggal Lahir" />
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="usia_field" required>Usia (Dalam Minggu)</x-atoms.form-label>
        <x-atoms.input name="usia" type="number" id="usia_field" placeholder="Masukkan Usia (Dalam minggu)" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tinggi_badan_field" required>Tinggi Badan (Dalam CM)</x-atoms.form-label>
        <x-atoms.input name="tinggi_badan" type="number" id="tinggi_badan_field"
          placeholder="Masukkan Tinggi Badan (Dalam CM)" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="berat_badan_field" required>Berat Badan (Dalam Kg)</x-atoms.form-label>
        <x-atoms.input name="berat_badan" type="number" id="berat_badan_field"
          placeholder="Masukkan Berat Badan (Dalam Kg)" />
      </div>
      <div class="col-sm-6 mb-4">
        <x-atoms.form-label for="status_pendampingan_field" required>Status Pendampingan</x-atoms.form-label>
        <x-atoms.select name="perlu_pendampingan" id="perlu_pendampingan_field" :lists="[
            'Y' => 'Diperlukan',
            'T' => 'Tidak Diperlukan',
        ]" />
      </div>
    </div>
    <x-slot:footer>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan


@can($globalModule['update'])
  <x-mollecules.modal id="edit-balita_modal" size="lg" method="PUT" update-modal
    action="{{ route('krs.balita.index') . '/{id}' }}" tableId="balita-table">
    <x-slot:title>Edit Data Balita</x-slot:title>
    <div class="row gy-4 ps-3 -mt-1">
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_field2" required>Kepala Keluarga</x-atoms.form-label>
        <x-atoms.select2 name="kepala_keluarga_id" placeholder="Pilih Kepala Keluarga"
          source="{{ route('reference.kepala_keluarga') }}" id="kepala_keluarga_field2"></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label>NIK</x-atoms.form-label>
        <x-atoms.input type="number" name="nik" id="nik_field2" maxlength="16" placeholder="Masukkan NIK " />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="nama_field2" required>Nama Lengkap</x-atoms.form-label>
        <x-atoms.input name="nama_lengkap" id="nama_lengkap_field2" placeholder="Masukkan Nama Lengkap" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Jenis Kelamin</x-atoms.form-label>
        <x-atoms.select name="jenis_kelamin" id="jenis_kelamin_field2" :lists="[
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
        ]" />
      </div>
      <div class="col-sm-6 ">
        <div class="row align-items-end gx-3 gy-4">
          <div class="col-sm-6 col-md-12 col-lg-6">
            <x-atoms.form-label for="tempat_lahir_field2" required>Tempat / Tanggal Lahir</x-atoms.form-label>
            <x-atoms.input name="tempat_lahir" id="tempat_lahir_field2" placeholder="Tempat Lahir" />
          </div>
          <div class="col-sm-6 col-md-12 col-lg-6">
            <x-atoms.input name="tanggal_lahir" type="date" id="tanggal_lahir_field2" placeholder="Tanggal Lahir" />
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="usia_field2" required>Usia (Dalam Minggu)</x-atoms.form-label>
        <x-atoms.input name="usia" type="number" id="usia_field2" placeholder="Masukkan Usia (Dalam minggu)" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tinggi_badan_field2" required>Tinggi Badan (Dalam CM)</x-atoms.form-label>
        <x-atoms.input name="tinggi_badan" type="number" id="tinggi_badan_field2"
          placeholder="Masukkan Tinggi Badan (Dalam CM)" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="berat_badan_field2" required>Berat Badan (Dalam Kg)</x-atoms.form-label>
        <x-atoms.input name="berat_badan" type="number" id="berat_badan_field2"
          placeholder="Masukkan Berat Badan (Dalam Kg)" />
      </div>
      <div class="col-sm-6 mb-4">
        <x-atoms.form-label for="status_pendampingan_field2" required>Status Pendampingan</x-atoms.form-label>
        <x-atoms.select name="perlu_pendampingan" id="perlu_pendampingan_field2" :lists="[
            'Y' => 'Diperlukan',
            'T' => 'Tidak Diperlukan',
        ]" />
      </div>
    </div>
    <x-slot:footer>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan

@can($globalModule['read'])
  <x-mollecules.modal id="detail-balita_modal" size="lg" action="">
    <x-slot:title>Detail Data Balita</x-slot:title>
    <div class="row gy-4 ps-3 -mt-1">
      <div class="col-sm-6">
        <x-atoms.form-label for="kepala_keluarga_field3" required>Kepala Keluarga</x-atoms.form-label>
        <x-atoms.select2 name="kepala_keluarga_id" disabled placeholder="Pilih Kepala Keluarga"
          source="{{ route('reference.kepala_keluarga') }}" id="kepala_keluarga_field3"></x-atoms.select2>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label>NIK</x-atoms.form-label>
        <x-atoms.input type="number" name="nik" readonly id="nik_field3" maxlength="16"
          placeholder="Masukkan NIK " />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="nama_field3" required>Nama Lengkap</x-atoms.form-label>
        <x-atoms.input name="nama_lengkap" readonly id="nama_lengkap_field3" placeholder="Masukkan Nama Lengkap" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label required>Jenis Kelamin</x-atoms.form-label>
        <x-atoms.select name="jenis_kelamin" disabled id="jenis_kelamin_field3" :lists="[
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
        ]" />
      </div>
      <div class="col-sm-6 ">
        <div class="row align-items-end gx-3 gy-4">
          <div class="col-sm-6 col-md-12 col-lg-6">
            <x-atoms.form-label for="tempat_lahir_field3" required>Tempat / Tanggal Lahir</x-atoms.form-label>
            <x-atoms.input name="tempat_lahir" readonly id="tempat_lahir_field3" placeholder="Tempat Lahir" />
          </div>
          <div class="col-sm-6 col-md-12 col-lg-6">
            <x-atoms.input name="tanggal_lahir" readonly type="date" id="tanggal_lahir_field3"
              placeholder="Tanggal Lahir" />
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="usia_field3" required>Usia (Dalam Minggu)</x-atoms.form-label>
        <x-atoms.input name="usia" type="number" readonly id="usia_field3"
          placeholder="Masukkan Usia (Dalam minggu)" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="tinggi_badan_field3" required>Tinggi Badan (Dalam CM)</x-atoms.form-label>
        <x-atoms.input name="tinggi_badan" readonly type="number" id="tinggi_badan_field3"
          placeholder="Masukkan Tinggi Badan (Dalam CM)" />
      </div>
      <div class="col-sm-6">
        <x-atoms.form-label for="berat_badan_field3" required>Berat Badan (Dalam Kg)</x-atoms.form-label>
        <x-atoms.input name="berat_badan" readonly type="number" id="berat_badan_field3"
          placeholder="Masukkan Berat Badan (Dalam Kg)" />
      </div>
      <div class="col-sm-6 mb-4">
        <x-atoms.form-label for="status_pendampingan_field3" required>Status Pendampingan</x-atoms.form-label>
        <x-atoms.select name="perlu_pendampingan" disabled id="perlu_pendampingan_field3" :lists="[
            'Y' => 'Diperlukan',
            'T' => 'Tidak Diperlukan',
        ]" />
      </div>
    </div>
    <x-slot:footer>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan

<x-mollecules.modal id="filter-balita_modal" action="" size="lg" :custom="true" :resetOnClose="false">
  <x-slot:title>Gunakan Filter</x-slot:title>
  <div class="row gy-4">
    <div class="col-md-6">
      <x-atoms.form-label for="kepala_keluarga_field4">Kepala Keluarga</x-atoms.form-label>
      <x-atoms.select2 name="kepala_keluarga_id" placeholder="Pilih Kepala Keluarga"
        source="{{ route('reference.kepala_keluarga') }}" id="kepala_keluarga_field4"></x-atoms.select2>
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="jenis_kelamin_field_3">Jenis Kelamin</x-atoms.form-label>
      <x-atoms.select name="jenis_kelamin" id="jenis_kelamin_field4" :lists="[
          'L' => 'Laki-laki',
          'P' => 'Perempuan',
      ]" />
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="kecamatan_field4">Kecamatan</x-atoms.form-label>
      <x-atoms.select2 name="kecamatan_id" id="kecamatan_field4" source="{{ route('reference.kecamatan') }}" />
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="kelurahan_field4">Kelurahan</x-atoms.form-label>
      <x-atoms.select2 name="kelurahan_id" disabled title="pilih kecamatan terlebih dahulu"
        source="{{ route('reference.kelurahan') }}" id="kelurahan_field4" />
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="rt_field4">RT</x-atoms.form-label>
      <x-atoms.input name="rt" id="rt_field4" placeholder="Masukkan RT"/>
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="rw_field4">RT</x-atoms.form-label>
      <x-atoms.input name="rw" id="rw_field4" placeholder="Masukkan RW" />
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="status_pendampingan_field4">Status Pendampingan</x-atoms.form-label>
      <x-atoms.select name="perlu_pendampingan" id="perlu_pendampingan_field4" :lists="[
          'Y' => 'Diperlukan',
          'T' => 'Tidak Diperlukan',
      ]" />
    </div>
  </div>
  <x-slot:footer>
    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
  </x-slot:footer>
</x-mollecules.modal>
