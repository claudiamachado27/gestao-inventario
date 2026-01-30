<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Os atributos que podem ser preenchidos
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Os atributos que devem ser ocultados para serialização
     *
     * @var list<string>
     */
    //Atributos que devem ser ocultados para serialização
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
     * Obter os atributos que devem ser convertidos.
     *
     * @return array<string, string>
     */
    //Obter os atributos que devem ser convertidos
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
