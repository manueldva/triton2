<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory;
    

    protected $fillable = [
    	'descripcion','activo' ,'empresa_id'
	];


    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function subcategorias(): HasMany
    {
        return $this->hasMany(Subcategoria::class);
    }

}
