<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movement;

class Category extends Model
{
    protected $table = 'categoria';
    //Campos que podem ser preenchidos
    protected $fillable = ['nome', 'icon', 'color'];

    //Relacionamento entre categoria e movimento
    public function movements()
    {
        return $this->hasMany(Movement::class, 'categoria_id');
    }
}
