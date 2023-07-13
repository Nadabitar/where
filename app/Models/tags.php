<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tags extends Model
{
    use HasFactory;


    public function region(): BelongsTo
    {
        return $this->belongsTo(Categoris::class , 'CategoryId');
    }
}
