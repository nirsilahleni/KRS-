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
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12"> 
                <div class="row">
                    <h3 class="my-3 fw-bolder">
                        Berita Terkini 
                        <a class="icon" href="#"><i class="fa fa-rss"></i></a>
                    </h3>
                    @foreach($news as $newss)
                    <div class="col-md-6 mt-3" data-aos="fade" data-aos-duration="1000">
                        <div class="position-relative hidden-overflow">
                            <a href="{{ route('detail', ['id' => $newss->id]) }}">
                                <img src="{{ asset('storage/' . $newss->image) }}" class="img-fluid" alt="">
                                <div class=""><span></span></div>
                            </a>
                        </div>
                        <div class="blog mt-3 ">
                            <h4>{{$newss->title}}</h4>
                            <p>{{$newss->limited_description}}</p>
                            <small>
                                <a href="#" title>{{$newss->created_at}}</a>
                            </small>
                            <small>
                                <a href="#" title>{{$newss->created_by}}</a>
                            </small>
                            <small>
                                <a href="#" title>{{$newss->kategori_berita ? $newss->kategori_berita->name : 'No Category'}}</a>
                            </small> 
                        </div>
                    </div> 
                    @endforeach
                    <div class="mt-4">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                {{-- <!-- <div class="widget mt-3">
                    <form action="{{ route('search') }}" method="get">
                        <input type="text" name="cari" placeholder="Temukan berita...">
                        <button type="submit">Cari</button>
                    </form>
                </div> --> --}}
                <div class="widget mt-3">
                    <h6>Kategori Berita</h6>
                    <ul class="nav-kat mb-2 p-0">
                        @foreach($kategoriNews as $kategori)
                        <li class="kategori mb-2 p-2" data-aos="fade-up" data-aos-duration="1000">
                            <a href="{{ route('kategori', ['id' => $kategori->id]) }}">{{$kategori->name}}</a><br>
                        </li>
                        @endforeach
                    </ul>
                    <div class="mt-4">
                        {{ $kategoriNews->links() }}
                    </div>
                </div>
                <div class="widget mt-3">
                    <h6>Berita Terkait</h6>
                    @foreach($widget as $random)
                    <a href="{{ route('detail', ['id' => $random->id]) }}" data-aos="fade-up" data-aos-duration="1000">
                        <img src="{{ asset('storage/' . $newss->image) }}" class="img-fluid" alt="">
                        <h5 class="mb-3 mt-2">{{$random->title}}</h5>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection