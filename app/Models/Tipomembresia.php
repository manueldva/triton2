<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tipomembresia extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory;
    
    protected $fillable = [
        'descripcion','amount','activo','empresa_id'
    ];


    /*public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function tipouserpermiso(): BelongsTo
    {
        return $this->belongsTo(Tipouserpermiso::class);
    }*/
}
