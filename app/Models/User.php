<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use HasFactory , HasApiTokens , Notifiable ;

    protected $fillable = ['fullName' , 'password' , 'email' , 'userType' , 'deviceId', 'gender' , 'regionId' , 'streetId'];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function place(): HasOne
    {
        return $this->hasOne(Places::class , 'accountId');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class , 'regionId');
    }

    public function street(): BelongsTo
    {
        return $this->belongsTo(Region::class , 'streetId');
    }


    public function makeComment() : BelongsToMany
    {
        return $this->belongsToMany(Places::class , 'comments' , 'userId', 'placeId')->withPivot('content' , 'rate' , 'status')->withTimestamps();
    }

    public function isSaved() : BelongsToMany
    {
        return $this->belongsToMany(Places::class , 'saveds' , 'userId', 'placeId')->withTimestamps();
    }

    public function savedService() : BelongsToMany
    {
        return $this->belongsToMany(Places::class , 'saveds' , 'userId', 'serviceId')->withTimestamps();
    }
}
