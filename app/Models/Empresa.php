<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Empresa extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory;
    
    protected $fillable = [
    	'descripcion', 'direccion', 'admin' ,'activo' 
	];


    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function categorias(): HasMany
    {
        return $this->hasMany(Categoria::class);
    }

    public function tipousers(): HasMany
    {
        return $this->hasMany(Tipouser::class);
    }

     public function tipouserpermisos(): HasMany
    {
        return $this->hasMany(TipouserPermiso::class);
    }


}
