<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tipouser extends Model
{
     use HasFactory;
    use HasApiTokens, HasFactory;
    
    protected $fillable = [
        'descripcion','activo' 
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
