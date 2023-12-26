<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tipoproducto extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory;
    
    protected $fillable = [
    	'descripcion','activo' ,'empresa_id'
	];


    /*public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }*/
}
