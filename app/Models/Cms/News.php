<?php

namespace App\Models\Cms;

use App\Models\User;
use App\Traits\HasAuthorStamp;
use App\Models\Cms\KategoriBerita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, HasAuthorStamp;

    const LIMIT = 100;

    public $with = ['author', 'mutator'];

    protected $table = 'news';

    protected $fillable = [
        'title',
        'image',
        'news_kategori_id',
        'description',
        'created_by',
        'updated_by',
    ];

    public function setImageAttribute($value): void
    {
        if(gettype($value) == 'string'){
            return;
        }
        $oldValue = $this->getOriginal('image');
        if ($oldValue && Storage::exists($oldValue)) {
            Storage::delete($oldValue);
        }
        $path = Storage::disk('public')->put('news', $value);
        $this->attributes['image'] = $path;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function mutator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function kategori_berita()
    {
        return $this->belongsTo(KategoriBerita::class, 'news_kategori_id', 'id');
    }
}
