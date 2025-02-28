<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Tipocontacto extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory;
    
    protected $fillable = [
        'descripcion','activo','empresa_id'
    ];



    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

}
