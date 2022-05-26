<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Define os campos permitidos na definição de dados em massa
     */
    protected $fillable = [
        'nome',
        'descricao',
        'valor_aula',
        'idade',
        'foto',
        'email',
        'password',
    ];

    /**
     * Define os acessores enviados no json
     */
    protected $appends = ['foto_perfil'];

    /**
     * Define os campos que não devem ser serializados
     */
    protected $hidden = [
        'password',
        'remember_token',
        'foto',
        'email_verified_at'
    ];

    /**
     * Realiza as conversões
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define a relação entre User e Aluno
     *
     * @return HasMany
     */
    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class);
    }

    /**
     * Cria um campo virtual para a foto do perfil
     * 
     * @return Attribute
     */
    protected function fotoPerfil(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->foto) {
                    return config('filesystems.disks.s3.bucket_s3_url') . $this->foto;
                }

                return null;
            }
        );
    }
}
