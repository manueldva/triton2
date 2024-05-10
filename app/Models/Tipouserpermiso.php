<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Tipouserpermiso extends Model
{
     use HasApiTokens, HasFactory;
    
    protected $fillable = [
        'tipouser_id','module_id','empresa_id'
    ];


    public function tipousers(): HasMany
    {
        return $this->hasMany(Tipouser::class);
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function empresas(): HasMany
    {
        return $this->hasMany(Empresa::class);
    }
}
