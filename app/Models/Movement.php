<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'movimento';
    //Campos que podem ser preenchidos
    protected $fillable = ['tipo', 'descricao', 'valor', 'data', 'categoria_id'];

    protected $casts = [
        'data' => 'date',
    ];
    //Relacionamento entre movimento e categoria
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }
}
