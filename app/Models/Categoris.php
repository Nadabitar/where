<?php

namespace App\Models;

use Cloudinary\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoris extends Model
{
    use HasFactory;

    protected $fillable = ['name','svg'];

    public function subCategory():BelongsTo
    {
        return $this->belongsTo(Category::class , 'parentId');
    }

    public function category():HasMany
    {
        return $this->hasMany(Category::class , 'parentId');
    }

    public function getAllChildByParent($id)
    {
        return Categoris::where('parentId' , $id)->get();
    }

    public function tags(): HasMany
    {
        return $this->hasMany(tags::class , 'categoryId');
    }

}

