<?php

namespace App\Models;

use App\Enum\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * atributos de asignacion masiva para el usuario
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role'
    ];
    /**
     * Obtener el nombre legible del rol
     */
    public function getRoleNameAttribute(): string
    {
        return UserRoleEnum::options()[$this->role] ?? $this->role;
    }
}
