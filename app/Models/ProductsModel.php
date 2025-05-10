<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
   protected $table = 'produtos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'quantidade',
        'status'
    ];
}
