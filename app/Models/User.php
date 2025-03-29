<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'empresa_id',
        'activo',
        'photo',
        'tipouser_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function tipousers(): HasMany
    {
        return $this->hasMany(Tipouser::class);
    }

    public function getPermiso($parametro)
    {
        // Aquí puedes hacer tu consulta SQL utilizando el parámetro
        $result = DB::table('users')
            ->join('tipouserpermisos', 'users.tipouser_id', '=', 'tipouserpermisos.tipouser_id')
            ->join('modules', 'tipouserpermisos.module_id', '=', 'modules.id')
            ->where('modules.descripcion', $parametro)
            ->where('users.id', $this->id)  // asumiendo que 'user_id' es la columna de la tabla que se relaciona con este usuario
            ->select('modules.id')  // selecciona las columnas que necesites
            ->first();


        // Si $result no es null, entonces se encontró un registro
        // En ese caso, devuelve 1. De lo contrario, verifica si el usuario es un usuario root
        return $result ? 1 : ($this->root ? 1 : 0);
    }

}
