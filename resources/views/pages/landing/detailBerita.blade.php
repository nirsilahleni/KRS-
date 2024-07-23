@extends('layouts.guest')
@section('title', 'Beranda')

@section('content')
<section>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="container mt-3 p-3 article">
        <div class="row">
            <!-- detail news -->
            <article class="col-lg-9 col-xs-12" data-aos="fade" data-aos-duration="1000">
                <div class="text-center">
                    <nav class="d-flex justify-content-center" style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Beranda</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('berita') }}">Berita</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{$detailBerita->title}}</a>
                            </li>
                        </ol>
                    </nav>
                    <span class="orange">
                        <a href="{{ route('berita', ['id' => $detailBerita->id]) }}">{{$detailBerita->kategori_berita? $detailBerita->kategori_berita->name : 'No Category'}}</a>
                    </span>
                    <h3 class="mt-2 fw-bolder">{{$detailBerita->title}}</h3>
                    <div class="blog mb-3">
                        <small>
                            <a href="#">{{$detailBerita->created_at}}</a>
                        </small>
                        <small>
                            <a href="#">{{$detailBerita->created_by}}</a>
                        </small>
                    </div>
                </div>
                <div>
                    <img src="{{ getFileInfo($detailBerita->image)['preview'] }}" class="img-fluid" alt="">
                </div>
                <div class="px-4 mt-3">{!! $detailBerita->description !!}</div>
            </article>
            <!-- widget -->
            <article class="col-lg-3 col-xs-12">
                <div class="widget mt-3">
                    <h6>Kategori Berita</h6>
                    <ul class="nav-kat mb-2 p-0">
                        @foreach($kategoriNews as $kategori)
                        <li class="kategori mb-2 p-2" data-aos="fade-up" data-aos-duration="1000">
                            <a href="{{ route('kategori', ['id' => $kategori->id]) }}">{{$kategori->name}}</a><br>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="widget mt-3">
                    <h6>Berita Terkait</h6>
                    @foreach($widget as $random)
                    <a href="{{ route('detail', ['id' => $random->id]) }}" data-aos="fade-up" data-aos-duration="1000">
                        <img src="{{ getFileInfo($detailBerita->image)['preview'] }}" class="img-fluid" alt="">
                        <h5 class="mb-3 mt-2">{{$random->title}}</h5>
                    </a>
                    @endforeach
                </div>
            </article>
        </div>
    </div>
</section>
@endsection