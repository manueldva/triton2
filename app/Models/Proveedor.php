<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory;
    

    
    protected $table = "proveedores";// <-- El nombre personalizado


    
    protected $fillable = [
    	'nombre','activo' ,'empresa_id','contacto', 'direccion'
	];


    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

}
