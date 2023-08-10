<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    
    use HasFactory;
    
    protected $fillable = ['name'];


    public function getAllStreetByRegion($id)
    {
        return Region::where('parentId' , $id)->get()->pluck('id' , 'name');
    }

    public function getAllStreetsByRegion($id)
    {
        return Region::where('parentId' , $id)->get();
    }

    public function street(): HasMany
    {
        return $this->hasMany(Region::class , 'parentId');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class , 'parentId');
    }


    public function user(): HasMany
    {
        return $this->hasMany(User::class , ['regionId' , 'streetId'] );
    }

    


}
