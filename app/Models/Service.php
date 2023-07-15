<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;
    protected $gurded=[];

    protected $table = 'services';



    public function place(): BelongsTo
    {
        return $this->belongsTo(Places::class , 'placeId');
    }

    
    public function gallery():HasMany
    {
        return $this->hasMany(Gallery::class , 'serviceId');
    }

    public function isSaved() : BelongsToMany
    {
        return $this->belongsToMany(User::class , 'saveds' , 'serviceId' , 'userId');
    }
}
