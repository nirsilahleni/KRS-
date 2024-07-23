@extends('layouts.app')
@section('title', 'Keluarga Management')
@push('css')
  <style>
    .table thead th {
      text-align: center;
      font-size: 12px;
      background: lightgreen;
      color: black;
      border: 1px solid black;
    }

    .table tbody td {
      font-size: 12px;
      border: 1px solid #000000;
      color: black;
    }

    /* .table thead th [rowspan] {
              vertical-align: end;
            } */
  </style>
@endpush
@section('content')
  {{-- @include('pages.admin.krs.pendataan-krs.partials.modals') --}}
  <div class="mb-2 mt-3">
    <form class="d-flex gap-4 align-items-center" action="{{route('krs.pendataan.rekapitulasi-pendataan-anak')}}" custom-action>
      <div class="col-sm-6 d-flex gap-3">
        <x-atoms.select :lists="[
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
        ]" :value="$bulan" name="bulan" placeholder="Filter Bulan" />
        <x-atoms.select name="periode" :lists="c_option($ref_periode, 'tahun')" :value="$periode" placeholder="Filter Periode" />
      </div>
      <button class="btn btn-success" style="flex-shrink: 0" data-bs-target="#filter-pendataan-krs_modal"
        data-bs-toggle="modal">
        <i class="fal fa-filter fs-4 me-1"></i>
        <span class="ms-2">Filter</span>
      </button>
    </form>
  </div>
  <div class="card-body table-responsive py-4">
      <table class="table-responsive table">
        <thead style="background-color: lightgray;">
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Desa</th>
            <th rowspan="2">Jumlah Wanita Hamil</th>
            <th rowspan="2">Jumlah PUS</th>
            <th rowspan="2">Jumlah KRS</th>
            <th rowspan="2">Jumlah Keluarga Punya Baduta</th>
            <th rowspan="2">Jumlah Keluarga Punya Balita</th>
            <th colspan="4" class="text-center">Baduta</th>
            <th colspan="4" class="text-center">Baduta</th>
          </tr>
          <tr>
            <th>Baduta Sangat Pendek</th>
            <th>Baduta Pendek</th>
            <th>Baduta Normal</th>
            <th>Baduta Tinggi</th>
            <th>Balita Sangat Pendek</th>
            <th>Balita Pendek</th>
            <th>Balita Normal</th>
            <th>Balita Tinggi</th>
          </tr>
        </thead>
        <tbody>
          @php
            $total_wanita_hamil = 0;
            $total_pus = 0;
            $total_krs = 0;
            $total_keluarga_punya_baduta = 0;
            $total_keluarga_punya_balita = 0;
            $total_baduta_sangat_pendek = 0;
            $total_baduta_pendek = 0;
            $total_baduta_normal = 0;
            $total_baduta_tinggi = 0;
            $total_balita_sangat_pendek = 0;
            $total_balita_pendek = 0;
            $total_balita_normal = 0;
            $total_balita_tinggi = 0;
          @endphp
          @foreach ($data_rekap as $row)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $row->nama_kelurahan }}</td>
              <td>{{ $row->jumlah_wanita_hamil }}</td>
              <td>{{ $row->jumlah_pus }}</td>
              <td>{{ $row->jumlah_krs }}</td>
              <td>{{ $row->jumlah_keluarga_punya_baduta }}</td>
              <td>{{ $row->jumlah_keluarga_punya_balita }}</td>
              <td>{{ $row->jumlah_baduta_sangat_pendek ?? 0 }}</td>
              <td>{{ $row->jumlah_baduta_pendek ?? 0 }}</td>
              <td>{{ $row->jumlah_baduta_normal ?? 0 }}</td>
              <td>{{ $row->jumlah_baduta_tinggi ?? 0 }}</td>
              <td>{{ $row->jumlah_balita_sangat_pendek ?? 0 }}</td>
              <td>{{ $row->jumlah_balita_pendek ?? 0 }}</td>
              <td>{{ $row->jumlah_balita_normal ?? 0 }}</td>
              <td>{{ $row->jumlah_balita_tinggi ?? 0 }}</td>
            </tr>
            @php
              $total_wanita_hamil += $row->jumlah_wanita_hamil;
              $total_pus += $row->jumlah_pus;
              $total_krs += $row->jumlah_krs;
              $total_keluarga_punya_baduta += $row->jumlah_keluarga_punya_baduta;
              $total_keluarga_punya_balita += $row->jumlah_keluarga_punya_balita;
              $total_baduta_sangat_pendek += $row->jumlah_baduta_sangat_pendek ?? 0;
              $total_baduta_pendek += $row->jumlah_baduta_pendek ?? 0;
              $total_baduta_normal += $row->jumlah_baduta_normal ?? 0;
              $total_baduta_tinggi += $row->jumlah_baduta_tinggi ?? 0;
              $total_balita_sangat_pendek += $row->jumlah_balita_sangat_pendek ?? 0;
              $total_balita_pendek += $row->jumlah_balita_pendek ?? 0;
              $total_balita_normal += $row->jumlah_balita_normal ?? 0;
              $total_balita_tinggi += $row->jumlah_balita_tinggi ?? 0;
            @endphp
          @endforeach
          <tr>
            <td></td>
            <td><strong>Total</strong></td>
            <td>{{ $total_wanita_hamil }}</td>
            <td>{{ $total_pus }}</td>
            <td>{{ $total_krs }}</td>
            <td>{{ $total_keluarga_punya_baduta }}</td>
            <td>{{ $total_keluarga_punya_balita }}</td>
            <td>{{ $total_baduta_sangat_pendek }}</td>
            <td>{{ $total_baduta_pendek }}</td>
            <td>{{ $total_baduta_normal }}</td>
            <td>{{ $total_baduta_tinggi }}</td>
            <td>{{ $total_balita_sangat_pendek }}</td>
            <td>{{ $total_balita_pendek }}</td>
            <td>{{ $total_balita_normal }}</td>
            <td>{{ $total_balita_tinggi }}</td>
          </tr>
        </tbody>
        </tbody>
      </table>
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {

    })
  </script>
@endpush
