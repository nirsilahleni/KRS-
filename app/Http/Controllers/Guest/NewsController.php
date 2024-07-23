<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\News;
use App\Models\Cms\KategoriBerita;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    // $path = Storage::disk('public')->put('slideshow', $value);
    //     $this->attributes['image'] = $path;
    
    public $newsLatest, $kategoriNews, $widget;

    public function __construct()
    {
        $this->widget = News::inRandomOrder()->take(4)->get();
        $this->kategoriNews = KategoriBerita::orderBy('name')->paginate(6);
    }
    
    public function news() {
        $news = News::with('kategori_berita')->latest()->paginate(6);
        return view('pages.landing.berita', compact('news'), ['widget'=>$this->widget, 'kategoriNews'=>$this->kategoriNews]);
    } 

    public function kategori($id){
        $kategoriId = KategoriBerita::findOrFail($id);
        $news = News::where('news_kategori_id', $kategoriId->id)->latest()->paginate(6);
        return view('pages.landing.berita', compact('news'), ['kategoriNews'=>$this->kategoriNews, 'widget'=>$this->widget]);
    }

    public function detail($id){
        $detailBerita = News::with('kategori_berita')->findOrFail($id);
        return view('pages.landing.detailBerita', compact('detailBerita'), ['widget'=>$this->widget, 'kategoriNews'=>$this->kategoriNews]);
    }

    // public function search(){
    //     // dd(request()->all());
    //     $inputSearch = request()->input('cari');
    //     $news = News::where('title', 'like', '%' .$inputSearch. '%')
    //                         ->orWhere('description', 'like', '%' .$inputSearch. '%')
    //                         ->paginate(6);
    //                         dd($news);
    //     return view('pages.landing.berita', compact('news'), ['widget'=>$this->widget, 'kategoriNews'=>$this->kategoriNews]);
    // }
}
