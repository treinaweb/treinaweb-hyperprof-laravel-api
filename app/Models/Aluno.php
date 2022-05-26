<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aluno extends Model
{
    use HasFactory;

    /**
     * Define os campos permitidos na definição de dados em massa
     */
    protected $fillable = ['nome', 'email', 'data_aula'];

    /**
     * Define os campos que não devem ser serializados
     */
    protected $hidden = ['user_id'];

    /**
     * Define o relacionamento entre Aluno e User
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
