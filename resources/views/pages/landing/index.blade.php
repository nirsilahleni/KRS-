@extends('layouts.guest')
@section('title', 'Beranda')

@push('css')
    <style>
        .hero-section {
            padding-block: 5em;
            background: linear-gradient(97deg, rgb(13 80 180) 0%, rgba(53, 96, 160, 1) 87%);
        }

        img {
            max-width: 100%;
            height: 100%;
        }
    </style>
@endpush

@section('content')
    <div class="body-wrapper overflow-hidden">
        <section class="hero-section bg-hero position-relative overflow-hidden mb-0">
            <img src="{{ asset('landing/images/svgs/acc-1.svg') }}" alt=""
                class=" position-absolute  d-none d-lg-block z-index-0" style="top: -10%">
            <img src="{{ asset('landing/images/svgs/acc-2.svg') }}" alt=""
                class=" position-absolute d-none d-lg-block  z-index-0" style="bottom: 40px; left: 80%; width: 40%">
            <div class="container">
                <div class="row align-items-center flex-column-reverse flex-sm-row">
                    <div class="col-sm-6">
                        <div class="hero-content my-11 my-xl-0">
                            <div class=" d-grid gap-1 mb-2 ">
                                <h1 class="fw-bolder fs-13 text-white" data-aos="fade-up" data-aos-delay="400"
                                    data-aos-duration="1000">
                                    {{ siteSetting('site_name') }}
                                </h1>
                                <p class="fs-5 text-white fw-normal" data-aos="fade-up" data-aos-delay="600"
                                    data-aos-duration="1000">
                                    Dapatkan akses mudah dan cepat dalam pencegahan risiko stunting membuat keluarga anda
                                    selalu aman dan
                                    nyaman.
                                </p>
                            </div>
                            <div class="d-sm-flex align-items-center gap-3 z-index-1 mt-4" data-aos="fade-up"
                                data-aos-delay="800" data-aos-duration="1000">
                                <a class="btn btn-primary btn-hover-shadow d-block mb-3 mb-sm-0" href="#"><i
                                        class=""><img src="{{ asset('landing/images/svgs/ph_sign-in-bold.svg') }}"
                                            alt="img-fluid" class="mx-2"></i>Mendaftar</a>
                            </div>
                        </div>
                    </div>
                    <!-- looping data slideshow -->
                    <div class="col-sm-6" data-aos="fade-left" data-aos-duration="1000">
                        <div class=""></div>
                        <div class="owl-carousel">
                            @foreach ($photo as $p)
                                <div class="img-thumbnail">
                                    <img src="{{ getFileInfo($p->image)['preview'] }}" class="img-fluid" alt="">
                                    <div class=""></div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="statistik pb-md-8 pb-8 position-relative " oncontextmenu="return false;">
            <img src="{{ asset('landing/images/svgs/acc-1.svg') }}" alt=""
                class=" position-absolute end-0  d-none d-lg-block z-index-0" style="top: 25%">
            <img src="{{ asset('landing/images/svgs/acc-2.svg') }}" alt=""
                class=" position-absolute d-none d-lg-block  z-index-0" style="bottom:0; left:-10%;">
            <div class="container d-flex flex-column justify-content-center align-items-center">
                <h1 class="pt-5 fw-bolder fs-12 text-white " data-aos="fade-up" data-aos-duration="1000">Data Statistik
                    Balita</h1>
                <p class="text-white fs-4 fw-medium text-center" data-aos="fade-up" data-aos-duration="1000">Kami
                    menyuguhkan perolehan data statistik balita di Kabupaten Blitar untuk anda.</p>
            </div>
        </section>
        <!-- statistik -->
        <section class="position-relative my-4 m-md-5">
            <img src="{{ asset('landing/images/svgs/grid.svg') }}" class="position-absolute d-block z-index-0"
                style="left: 40%;" alt="grid icon" data-aos="fade-up" data-aos-duration="1000">
            <div class="container">
                <div class="d-flex flex-column gap-md-5 gap-2">
                    <div class="d-flex flex-md-row flex-column gap-4 justify-content-between">
                        <div class="container m-md-0 w-md w-md-max p-0 col-4" data-aos="fade-right" data-aos-duration="1000"
                            data-aos-delay="600">
                            <div class="container d-flex justify-content-center">
                                <img src="{{ asset('landing/images/svgs/distance.svg') }}" class="img-fluid w-75"
                                    alt="location-icon">
                            </div>
                            <p class="mt-4 fw-medium">Anda dapat melihat perolehan data balita terkini <span
                                    class="fw-bolder">di
                                    seluruh
                                    desa</span> di setiap kecamatan berdasarkan jenis kelamin secara real-time.</p>
                        </div>
                        <div class="card d-flex flex-column  gap-4 align-items-center justify-content-center"
                            data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
                            <div class="card-body">
                                <h5 class="me-auto mb-3">Data Balita Berdasarkan Jenis Kelamin</h5>
                                <div id="balita_jk_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column mt-10 gap-md-5 gap-2  ">
                    <div class="d-flex flex-md-row flex-column-reverse gap-4 justify-content-between">
                        <div class="d-flex flex-column  card  gap-4 align-items-center" data-aos="fade-left"
                            data-aos-duration="1000" data-aos-delay="200">
                            <div class="card-body">
                                <h5 class="me-auto mb-3">Data balita di setiap kecamatan berdasarkan jenis kelamin</h5>
                                <div id="chart_balita_kecamatan"></div>
                            </div>
                        </div>
                        <div class="container m-md-0 w-md w-md-max p-0 col-4" data-aos="fade-left" data-aos-duration="1000"
                            data-aos-delay="600">
                            <div class="container d-flex justify-content-center">
                                <img src="{{ asset('landing/images/svgs/gender.svg') }}" class="img-fluid w-75"
                                    alt="location-icon">
                            </div>
                            <p class="mt-4 fw-medium">Anda juga dapat melihat perolehan data balita terkini <span
                                    class="fw-bolder">berdasarkan jenis kelamin</span> di seluruh kecamatan di Kabupaten
                                Blitar secara
                                real-time.</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="d-none pt-md-14 pt-15" id="alur">
            <div class="container d-flex flex-column">
                <div class="d-flex flex-md-row flex-column justify-content-center gap-3 ">
                    <div class="d-flex flex-column col-md-8" data-aos="fade-right" data-aos-duration="1000">
                        <h1 class="col-md-8 fw-semibold fs-12 text-start" style="color: #232933;">Alur Pendaftaran
                            Pasangan</h1>
                        <p class="fw-normal fs-4" style="color: #A6A6A6;">Setiap pendaftar harus mengikuti langkah-langkah
                            berikut, agar nantinya dapat menerima sertifikat nikah pada akhirnya</p>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center align-self-center" data-aos="fade-left"
                        data-aos-duration="1000">
                        <div class="">
                            <a class="btn btn-outline-primary " href="#"><i class="mx-3"><img
                                        src="{{ asset('landing/images/svgs/icon-download.svg') }}" alt="img-fluid"></i>
                                Download Panduan & Juknis</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-md-row flex-column justify-content-center gap-2" data-aos="fade"
                    data-aos-duration="1000">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/images/ilustrations/step.png') }}" alt="step-ilustration">
                    </div>
                    <div class="col-md-6 d-flex flex-column gap-4 justify-content-center">
                        <div class="d-flex flex-row gap-2">
                            <div class="pt-1">
                                <img src="{{ asset('landing/images/svgs/tree-structure.svg') }}" alt="network-icon"
                                    style="width: 25px;height:25px; max-width: unset;">
                            </div>
                            <div class="d-flex flex-column">
                                <h1 class="fw-semibold fs-6" style="color: #232933;">Membuat Akun</h1>
                                <p class="col-10 fw-normal fs-3 mt-2" style="color: #A6A6A6;">Pembuatan akun menggunakan
                                    NIK
                                    sesuai identitas di KTP/KK dan email tunggal</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row gap-2">
                            <div class="pt-1">
                                <img src="{{ asset('landing/images/svgs/tree-structure.svg') }}" alt="network-icon"
                                    style="width: 25px;height:25px; max-width: unset;">
                            </div>
                            <div class="d-flex flex-column">
                                <h1 class="fw-semibold fs-6" style="color: #232933;">Melengkapi Persyaratan</h1>
                                <p class="fw-normal fs-3 mt-2" style="color: #A6A6A6;">Peserta diwajibkan melengkapi
                                    persyaratan pendaftaran seperti pengisian formulir pendaftaran, upload foto/KTP/KK dan
                                    persyaratan lain sesuai jalur masuk</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row gap-2">
                            <div class="pt-1">
                                <img src="{{ asset('landing/images/svgs/tree-structure.svg') }}" alt="network-icon"
                                    style="width: 25px;height:25px; max-width: unset;">
                            </div>
                            <div class="d-flex flex-column">
                                <h1 class="fw-semibold fs-6" style="color: #232933;">Verfikasi oleh Panitia</h1>
                                <p class="fw-normal fs-3 mt-2" style="color: #A6A6A6;">Panitia akan melakukan verifikasi
                                    berkas
                                    pendaftaran. Pendaftar yang tidak melengkapi berkas sesuai persyaratan dinyatakan tidak
                                    lolos administrasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="d-none mt-12" style="background: #3560A0" id="jadwal">
            <div class="container d-flex flex-column py-5 gap-2">
                <div class="d-flex flex-md-row flex-column justify-content-between align-content-center " data-aos="fade"
                    data-aos-duration="1000">
                    <div class="col-sm-10">
                        <h1 class="fw-semibold fs-12 text-start text-white">Jadwal Penting Andini</h1>
                        <p class="align-self-center fw-medium fs-4 mt-3 text-start text-white">Jangan lewatkan momen
                            penting dalam pendaftaran Andini App Batch 1</p>
                    </div>
                    <div class="align-self-center">
                        <a class="btn btn-primary btn-hover-shadow d-block" href="#"><i class=""><img
                                    src="{{ asset('landing/images/svgs/ph_sign-in-bold.svg') }}" alt="img-fluid"
                                    class="mx-2"></i>
                            Masuk</a>
                    </div>
                </div>
                <div class="d-flex flex-md-row flex-column justify-content-center  pt-4 gap-3">
                    <div class="d-flex flex-column gap-3 theCard-Jadwal justify-content-between col-md-3"
                        data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                        <div>
                            <div class="d-flex flex-row align-items-center gap-2">
                                <div class="iconCard-Jadwal">
                                    <img src="{{ asset('landing/images/svgs/calendar-outline.svg') }}" alt="img-fluid"
                                        class="p-1">
                                </div>
                                <div class="pt-3">
                                    <p class="">Pendaftaran</p>
                                </div>
                            </div>
                            <p class="cardDes">Isi formulir pendaftaran dan sertakan dokumen pendukung Anda untuk memulai
                                perjalanan anda dalam menempuh rumah tangga</p>
                        </div>
                        <div class="jadwalInformation-cls col-10 d-flex justify-content-center">
                            CLOSED
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3 theCard-Jadwal justify-content-between col-md-3"
                        data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <div class="iconCard-Jadwal">
                                <img src="{{ asset('landing/images/svgs/calendar-outline.svg') }}" alt="img-fluid"
                                    class="p-1">
                            </div>
                            <div class="pt-3">
                                <p class="">Seleksi Administrasi</p>
                            </div>
                        </div>
                        <p class="cardDes">Setelah pendaftaran, tim kami akan melakukan seleksi administrasi. Pastikan
                            semua dokumen Anda lengkap dan sesuai dengan persyaratan.</p>
                        <div class="jadwalInformation-open col-10 d-flex justify-content-center">
                            2 Mei 2024 - 10 Mei 2024
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3 theCard-Jadwal justify-content-between col-md-3"
                        data-aos="fade-left" data-aos-duration="1000" data-aos-delay="600">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <div class="iconCard-Jadwal">
                                <img src="{{ asset('landing/images/svgs/calendar-outline.svg') }}" alt="img-fluid"
                                    class="p-1">
                            </div>
                            <div class="pt-3">
                                <p>Proses Asessmen</p>
                            </div>
                        </div>
                        <p class="cardDes">Anda akan mengikuti tes tulis dan wawancara </p>
                        <div class="jadwalInformation-open col-10 d-flex justify-content-center">
                            20 Mei 2024 - 25 Mei 2024
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3 theCard-Jadwal justify-content-between col-md-3"
                        data-aos="fade-left" data-aos-duration="1000" data-aos-delay="800">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <div class="iconCard-Jadwal">
                                <img src="{{ asset('landing/images/svgs/calendar-outline.svg') }}" alt="img-fluid"
                                    class="p-1">
                            </div>
                            <div class="pt-3">
                                <p>Evaluasi Diri</p>
                            </div>
                        </div>
                        <p class="cardDes">Ceritakan pengalaman belajar Anda secara jelas dan objektif. Kami akan
                            mempertimbangkan evaluasi diri Anda dalam proses seleksi.</p>
                        <div class="jadwalInformation-open col-10 d-flex justify-content-center">
                            30 Mei 2024
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="d-none mt-12" id="biaya">
            <div class="container d-flex flex-column py-5 gap-2 ">
                <div class="d-flex flex-md-row flex-column justify-content-between align-content-center theBiaya"
                    data-aos="fade" data-aos-duration="1000">
                    <div class="col-6">
                        <h1 class="align-self-center fw-semibold fs-12 text-start" style="color: #232933;">Biaya
                            Pendaftaran </h1>
                        <p class=" align-self-center fw-medium fs-4 text-start" style="color: #A6A6A6">Jangan ragu
                            untuk menghubungi Call Center untuk pertanyaan lebih lanjut</p>
                    </div>
                    <div class="align-self-center">
                        <a class="btn btn-primary btn-hover-shadow d-block" href="#"><i class=""><img
                                    src="{{ asset('landing/images/svgs/baseline-support-agent.svg') }}" alt="img-fluid"
                                    class="mx-2"></i> Hubungi Call Center</a>
                    </div>
                </div>
                <div class="pt-4" data-aos="fade-up" data-aos-duration="1000">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Program</th>
                                <th scope="col">Biaya Pendaftaran</th>
                                <th scope="col">Biaya Keseluruhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex flex-row gap-3">
                                        <div class="theIcon-program p-3">
                                            <i class="fal fa-rings-wedding fs-7 text-white"></i>
                                        </div>
                                        <div class="theProgram-text d-flex flex-column justify-content-center">
                                            <h1>Paket A</h1>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, nulla.</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">Rp. 500.000,00</td>
                                <td class="align-middle">Rp. 3.235.000,00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="d-none mt-12 mb-12">
            <div class="container d-flex flex-md-row flex-column align-items-center justify-content-between">
                <div class="d-flex justify-content-center" data-aos="fade-right" data-aos-duration="1000">
                    <img src="{{ asset('assets/images/ilustrations/requirement.png') }}" alt="">
                </div>
                <div class="d-flex flex-column gap-2 theSyarat-title col-md-4 mx-5  mx-md-0" data-aos="fade-left"
                    data-aos-duration="1000">
                    <h1 class="fw-semibold fs-12 text-start" style="color: #232933;">Persyaratan Umum</h1>
                    <p class="fw-medium fs-4 text-start" style="color: #A6A6A6;">Selain persyaratan umum tersebut,
                        Pendaftar harus memenuhi syarat khusus</p>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex flex-row gap-3 theSyarat-list">
                            <img src="{{ asset('landing/images/svgs/Check-Circle.svg') }}" alt="img-fluid"
                                style="width: 25px; height: 25px;" class="">
                            <p class="col-8 fw-normal fs-4 text-start m-0" style="color: #232933;">Warga Negara Indonesia
                                (WNI)</p>
                        </div>

                        <div class="d-flex flex-row gap-3 theSyarat-list">
                            <img src="{{ asset('landing/images/svgs/Check-Circle.svg') }}" alt="img-fluid"
                                style="width: 25px; height: 25px;" class="">
                            <p class="fw-normal fs-4 text-start m-0" style="color: #232933;">Memiliki Anak berusia 2+
                                tahun dan 5-
                                tahun</p>
                        </div>
                        <div class="d-flex flex-row gap-3 theSyarat-list">
                            <img src="{{ asset('landing/images/svgs/Check-Circle.svg') }}" alt="img-fluid"
                                style="width: 25px; height: 25px;" class="">
                            <p class="fw-normal fs-4 text-start m-0" style="color: #232933;">Sehat Akal dan fikiran</p>
                        </div>
                        <div class="d-flex flex-row gap-3 theSyarat-list">
                            <img src="{{ asset('landing/images/svgs/Check-Circle.svg') }}" alt="img-fluid"
                                style="width: 25px; height: 25px;" class="">
                            <p class="fw-normal fs-4 text-start m-0" style="color: #232933;">Mengisi Formulir Pendaftaran
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="my-12" id="faq">
            <div class="container d-flex flex-column theFAQ " data-aos="fade" data-aos-duration="1000">
                <h1 class="fw-semibold fs-12 text-center mb-8">FaQ {{ siteSetting('site_name') }}</h1>
                <div class="col-md-8 align-self-center pt-3 mx-2 mx-md-0">
                    @if ($faqs->count() > 0)
                        <div class="accordion accordion-flush" id="accordionExample">
                            @foreach ($faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button collapsed accFAQ" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="false" aria-controls="collapse{{ $index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse accFAQdes"
                                        aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center">
                            Belum ada pertanyaan yang tersedia
                        </p>
                    @endif
                </div>
            </div>
        </section>

        <section class="mt-12">
            <h1 class="text-center my-5 fw-bolder">Tentang Kami</h1>
            <div class="container mw-md mw-lg">
                <div class="card bg-dark text-white" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                    <img src="{{ asset('landing/images/svgs/krs-about.svg') }}" class="card-img" alt="about">
                    <div class="card-img-overlay md-p-50">
                        <div class=" text-center">
                            <h2
                                class="card-title lg:text-4xl md:text-xl md:text-md text-xl leading-[160%] text-white fw-bolder">
                                Dinas
                                Komunikasi, Informatika, Statistik dan Persandian</h2>
                            <p class="card-text sm-fs-1 md-fs">Diskominfo Blitar merupakan badan pelaksana urusan
                                pemerintahan bidang
                                komunikasi dan informatika,
                                urusan pemerintahan bidang persandian, dan urusan pemerintahan bidang statistik yang
                                bernaung di wilayah
                                Kabupaten Blitar. Kenal kami lebih dekat untuk mengetahui informasi lainnya.</p>
                            <a href="#footer" class="btn btn-light bl">Kontak Kami</a>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <footer class="footer-part pt-8 pb-5" id="footer">
        <div class="container">

        </div>
    </footer>
    <div class="offcanvas offcanvas-start modernize-lp-offcanvas" tabindex="-1" id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header p-4">
            <img src="{{ asset('landing/images/logos/logo-erpl.svg') }}" alt="img-fluid" width="150">
        </div>
        <div class="offcanvas-body p-4">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" target="_blank">Alur Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" target="_blank">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" target="_blank">Biaya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/unduh" target="_blank">Unduh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" target="_blank">FAQ</a>
                </li>
                <li class="nav-item">
                    <div class="">
                        <ul class="navbar-nav">
                            <li class="nav-item ">
                                <a class="btn fs-3 w-100 rounded py-2" href="/login">Login</a>
                            </li>
                            <li class="nav-item ms-2">
                                <a class="btn btn-primary fs-3 w-100 rounded btn-hover-shadow py-2"
                                    href="#">Mendaftar</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        //chart jumlah balita

        // var options = {
        //   series: [{
        //     name: "Jumlah Balita",
        //     data: balita
        //   }],
        //   chart: {
        //     height: 250,
        //     width: 350,
        //     type: 'line',
        //     zoom: {
        //       enabled: false
        //     }
        //   },
        //   dataLabels: {
        //     enabled: false
        //   },
        //   stroke: {
        //     curve: 'straight'
        //   },
        //   title: {
        //     text: 'Jumlah Balita Setiap Desa',
        //     align: 'left'
        //   },
        //   grid: {
        //     row: {
        //       colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        //       opacity: 0.5
        //     },
        //   },
        //   xaxis: {
        //     categories: kelurahan,
        //   }
        // };



        $(function() {
            function getChartPayload(uri) {
                return $.ajax({
                    async: true,
                    url: uri,
                    type: "GET",
                })
            }

            // chart balita berdasarkan jk
            getChartPayload("/chart?name=balita&group=jenis_kelamin").done(function(data) {
                const charta = new ApexCharts(document.querySelector("#balita_jk_chart"), {
                    chart: {
                        type: 'donut',
                        width: 500,
                    },
                    plotOptions: {
                        pie: {
                            expandOnClick: true,
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        showAlways: true,
                                        label: 'Total Balita',
                                        // fontSize: 'px',
                                        color: '#000',
                                        formatter: function(w) {
                                            return w.globals.seriesTotals.reduce((a, b) => {
                                                return a + b
                                            }, 0)
                                        }
                                    }
                                }
                            }
                        }
                    },

                    series: data.data.series,
                    labels: data.data.categories,
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                width: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]

                });
                charta.render();
            })

            // chart balita berdasarkan kecamatan
            getChartPayload("/chart?name=balita&group=kecamatan").done(function(data) {
                // console.log(data);
                const series = data.data.series;
                const formattedSeries = Object.keys(series).map((key) => {
                    return {
                        name: key,
                        data: series[key]
                    }
                })
                const charta = new ApexCharts(document.querySelector("#chart_balita_kecamatan"), {
                    series: formattedSeries,
                    chart: {
                        type: 'bar',
                        width: 600,
                        height: 350,
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: data.data.categories,
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah Balita'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + " Balita"
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                width: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                });
                charta.render();
            })
        })


        // })
    </script>
@endpush
