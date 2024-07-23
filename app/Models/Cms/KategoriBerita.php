<?php

namespace App\Models\Cms;

use App\Models\Cms\News;
use App\Traits\RestrictOnDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriBerita extends Model
{
    use HasFactory, SoftDeletes, RestrictOnDelete;

    protected $table = 'kategori_news';
    protected $guarded = ['id'];
    public $ignoreOnDelete = [''];

    public function news()
    {
        return $this->hasMany(News::class, 'news_kategori_id');
    }
}
