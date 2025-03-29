<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory;
    
    protected $fillable = [
        'empresa_id','tipocontacto_id','nombre','domicilio','email','contacto','photo','activo'
    ];

    public function tipocontactos(): HasMany
    {
        return $this->hasMany(Tipocontacto::class);
    }
}
