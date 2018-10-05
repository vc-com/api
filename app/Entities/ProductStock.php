<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class ProductStock extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'managed', // gerenciado
        'stock_status', // situacao_em_estoque
        'quantity', // Quantidade
        'reserved', // Reservado
        'situation_without_stock' // situacao_sem_estoque

    ];

    protected $hidden = [

    ];
    
}
