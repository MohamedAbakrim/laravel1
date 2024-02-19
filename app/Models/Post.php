<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Tag;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "slug",
        "content",
        "category_id",
    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
