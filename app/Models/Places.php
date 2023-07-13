<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Places extends Model
{
    use HasFactory;
    protected $guarded= [];
    protected $casts = [
        'links' => 'array'
        ];
   
    public function account(): BelongsTo
    {
        return $this->belongsTo(User::class , 'accountId');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class , 'placeId');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categoris::class , 'categoryId');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(Categoris::class , 'subCategoryId');
    }

    public function Gallery()
    {
        return $this->hasManyThrough(Gallery::class , Service::class , 'placeId' , 'serviceId' , 'id' , 'id' );
    }


    public function comment() : BelongsToMany
    {
        return $this->belongsToMany(User::class , 'comments' , 'placeId' , 'userId')->withPivot('content' , 'rate' , 'status');
    }

    public function isSaved() : BelongsToMany
    {
        return $this->belongsToMany(User::class , 'saveds' , 'placeId' , 'userId');
    }
}
