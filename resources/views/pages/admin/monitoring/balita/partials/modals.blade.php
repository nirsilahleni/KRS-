@can($globalModule['create'])
  <x-mollecules.modal id="add-pendampingan_modal" size="lg" action="{{ route('monitoring.balita.store') }}"
    tableId="monitoring-balita-table">
    <x-slot:title>Menambahkan Data Pendampingan</x-slot:title>
    <div class="row gy-3 ">
      <input type="hidden" name="periode_id" value="{{ $current_periode }}">
      <div class="">
        <x-atoms.form-label for="balita_field" required>Nama Balita</x-atoms.form-label>
        <x-atoms.select2 name="balita_id" placeholder="Pilih Balita" source="{{ route('reference.balita') }}"
          id="balita_field"></x-atoms.select2>
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="bulan_field" required>Bulan</x-atoms.form-label>
        <x-atoms.select name="bulan" :value="(int) date('m')" id="bulan_field" :lists="[
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
      <div class="col-md-6">
        <x-atoms.form-label for="tanggal_pendampingan_field" required>Tanggal Pendampingan</x-atoms.form-label>
        <x-atoms.input name="tanggal_pendampingan" id="tanggal_pendampingan_field" type="date" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="jenis_pendampingan_field" required>Jenis Pendampingan</x-atoms.form-label>
        <x-atoms.select name="jenis_pendampingan" id="jenis_pendampingan_field" :lists="[
            'KMS' => 'KMS',
            'KIA' => 'KIA',
            'ASI' => 'ASI',
        ]" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="usia_field" required>Usia (dalam minggu)</x-atoms.form-label>
        <x-atoms.input type="number" name="usia" id="usia_field" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="berat_badan_field" required>Berat Badan (Dalam KG)</x-atoms.form-label>
        <x-atoms.input name="berat_badan" type="number" id="berat_bada_field" step="0.01"
          placeholder="Masukkan Berat Badan (Dalam Kg)" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="tinggi_badan_field" required>Tinggi Badan (Dalam CM)</x-atoms.form-label>
        <x-atoms.input type="number" name="tinggi_badan" id="tinggi_badan_field" step="0.1"
          placeholder="Masukkan Tinggi Badan (Dalam Cm)" />
      </div>
      <div class="">
        <x-atoms.form-label for="keterangan_field">Keterangan</x-atoms.form-label>
        <x-atoms.textarea name="keterangan" id="keterangan_field"
          placeholder="Keterangan Pendampingan"></x-atoms.textarea>
      </div>
    </div>
    <x-slot:footer>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan


@can($globalModule['update'])
  <x-mollecules.modal id="edit-pendampingan_modal" size="lg" method="PUT"
    action="{{ route('monitoring.balita.index') . '/{id}' }}" tableId="monitoring-balita-table">
    <x-slot:title>Edit Data Pendampingan</x-slot:title>
    <div class="row gy-3 ">
      <div class="col-md-6">
        <x-atoms.form-label for="balita_field2" required>Nama Balita</x-atoms.form-label>
        <x-atoms.select2 name="balita_id" placeholder="Pilih Balita" source="{{ route('reference.balita') }}"
          id="balita_field2"></x-atoms.select2>
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="periode_field2" required>Periode</x-atoms.form-label>
        <x-atoms.select name="periode_id" id="periode_field2" :lists="c_option($ref_periode, 'tahun')" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="bulan_field2" required>Bulan</x-atoms.form-label>
        <x-atoms.select name="bulan" :value="(int) date('m')" id="bulan_field2" :lists="[
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
      <div class="col-md-6">
        <x-atoms.form-label for="tanggal_pendampingan_field2" required>Tanggal Pendampingan</x-atoms.form-label>
        <x-atoms.input name="tanggal_pendampingan" id="tanggal_pendampingan_field2" type="date" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="jenis_pendampingan_field2" required>Jenis Pendampingan</x-atoms.form-label>
        <x-atoms.select name="jenis_pendampingan" id="jenis_pendampingan_field2" :lists="[
            'KMS' => 'KMS',
            'KIA' => 'KIA',
            'ASI' => 'ASI',
        ]" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="usia_field2" required>Usia (dalam minggu)</x-atoms.form-label>
        <x-atoms.input type="number" name="usia" id="usia_field2" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="berat_badan_field2" required>Berat Badan (Dalam KG)</x-atoms.form-label>
        <x-atoms.input name="berat_badan" step="0.01" type="number" id="berat_bada_field2" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="tinggi_badan_field2" required>Tinggi Badan (Dalam CM)</x-atoms.form-label>
        <x-atoms.input type="number" name="tinggi_badan" step="0.1" id="tinggi_badan_field2" />
      </div>
      <div class="">
        <x-atoms.form-label for="keterangan_field2">Keterangan</x-atoms.form-label>
        <x-atoms.textarea name="keterangan" id="keterangan_field2"></x-atoms.textarea>
      </div>
    </div>
    <x-slot:footer>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan

@can($globalModule['read'])
  <x-mollecules.modal id="detail-pendampingan_modal" size="lg" action="">
    <x-slot:title>Detail Data Balita</x-slot:title>
    <div class="row gy-4 ps-3 -mt-1">
      <div class="">
        <x-atoms.form-label for="balita_field3" required>Nama Balita</x-atoms.form-label>
        <x-atoms.select2 name="balita_id" disabled placeholder="Pilih Balita" readonly
          source="{{ route('reference.balita') }}" id="balita_field3"></x-atoms.select2>
      </div>
      <div class="">
        <x-atoms.form-label for="periode_field3" required>Periode</x-atoms.form-label>
        <x-atoms.select name="periode" id="periode_field3" disabled :lists="c_option($ref_periode, 'tahun')" :value="$current_periode" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="bulan_field3" required>Bulan</x-atoms.form-label>
        <x-atoms.select name="bulan" :value="(int) date('m')" disabled id="bulan_field3" :lists="[
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
      <div class="col-md-6">
        <x-atoms.form-label for="tanggal_pendampingan_field3" required>Tanggal Pendampingan</x-atoms.form-label>
        <x-atoms.input name="tanggal_pendampingan" readonly id="tanggal_pendampingan_field3" type="date" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="jenis_pendampingan_field3" required>Jenis Pendampingan</x-atoms.form-label>
        <x-atoms.select name="jenis_pendampingan" disabled id="jenis_pendampingan_field3" :lists="[
            'KMS' => 'KMS',
            'KIA' => 'KIA',
            'ASI' => 'ASI',
        ]" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="usia_field3" required>Usia (dalam minggu)</x-atoms.form-label>
        <x-atoms.input type="number" name="usia" disabled id="usia_field3" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="berat_badan_field3" required>Berat Badan (Dalam KG)</x-atoms.form-label>
        <x-atoms.input name="berat_badan" type="number" readonly id="berat_bada_field3" />
      </div>
      <div class="col-md-6">
        <x-atoms.form-label for="tinggi_badan_field3" required>Tinggi Badan (Dalam CM)</x-atoms.form-label>
        <x-atoms.input type="number" name="tinggi_badan" readonly id="tinggi_badan_field3" />
      </div>
      <div class="">
        <x-atoms.form-label for="keterangan_field3" required>Keterangan</x-atoms.form-label>
        <x-atoms.textarea name="keterangan" readonly id="keterangan_field3"></x-atoms.textarea>
      </div>
    </div>
    <x-slot:footer>
    </x-slot:footer>
  </x-mollecules.modal>
@endcan


<x-mollecules.modal id="filter-pendampingan_modal" action="" size="lg" :custom="true"
  :resetOnClose="false">
  <x-slot:title>Gunakan Filter</x-slot:title>
  <div class="row gy-4">
    <div class="col-md-6">
      <x-atoms.form-label for="balita_field4">Nama Balita</x-atoms.form-label>
      <x-atoms.select2 name="balita_id" placeholder="Pilih Balita" source="{{ route('reference.balita') }}"
        id="balita_field4"></x-atoms.select2>
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="periode_field4" required>Periode</x-atoms.form-label>
      <x-atoms.select name="periode_id" id="periode_field4" :lists="array_replace(['' => 'Semua Periode'], c_option($ref_periode, 'tahun'))" :value="$current_periode" />
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="kecamatan_field4" disabled required>Kecamatan</x-atoms.form-label>
      <x-atoms.select2 name="kecamatan_id" id="kecamatan_field4"
        source="{{ route('reference.kecamatan') }}" />
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="kelurahan_field4" required>Kelurahan</x-atoms.form-label>
      <x-atoms.select2 name="kelurahan_id" disabled source="{{ route('reference.kelurahan') }}" id="kelurahan_field4" />
    </div>

    <div class="col-md-6">
      <x-atoms.form-label for="rt_field">RT</x-atoms.form-label>
      <x-atoms.input name="rt" id="rt_field4" placeholder="Masukkan RT" />
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="rw_field">RT</x-atoms.form-label>
      <x-atoms.input name="rw" id="rw_field4" placeholder="Masukkan RW" />
    </div>
    <div>
      <x-atoms.form-label for="jenis_pendampingan_field4">Jenis Pendampingan</x-atoms.form-label>
      <x-atoms.select name="jenis_pendampingan" id="jenis_pendampingan_field4" :lists="[
          '' => 'Semua Jenis Pendampingan',
          'KMS' => 'KMS',
          'KIA' => 'KIA',
          'ASI' => 'ASI',
      ]" />
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="tanggal_pendampingan_field4">Tanggal Pendampingan</x-atoms.form-label>
      <x-atoms.input type="date" name="tanggal_pendampingan" id="tanggal_pendampingan_field4" />
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="status_berat_badan_field4">Status berat badan</x-atoms.form-label>
      <x-atoms.select name="status_berat_badan" id="status_berat_badan_field4">
        <option value="Berat badan sangat kurang (severly underweight)">Berat badan sangat kurang (severly stunted)
        </option>
        <option value="Berat badan kurang (underweight)">Berat badan kurang (underweight)</option>
        <option value="Berat badan normal">Berat badan normal</option>
        <option value="Berat badan lebih (overweight)">Berat badan lebih (overweight)</option>
      </x-atoms.select>
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="status_tinggi_badan_field4">Status tinggi badan</x-atoms.form-label>
      <x-atoms.select name="status_tinggi_badan" id="status_tinggi_badan_field4">
        <option value="Tinggi badan sangat pendek (severly stunted)">Tinggi badan sangat pendek (severly stunted)
        </option>
        <option value="Tinggi badan pendek (stunted)">Tinggi badan pendek (stunted)</option>
        <option value="Tinggi badan normal">Tinggi badan normal</option>
        <option value="Tinggi badan lebih (overweight)">Tinggi badan lebih (overweight)</option>
      </x-atoms.select>
    </div>
    <div class="col-md-6">
      <x-atoms.form-label for="bulan_field4" required>Bulan</x-atoms.form-label>
      <x-atoms.select name="bulan" id="bulan_field4" :lists="[
          '' => 'Semua Bulan',
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
  </div>
  <x-slot:footer>
    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
  </x-slot:footer>
</x-mollecules.modal>
