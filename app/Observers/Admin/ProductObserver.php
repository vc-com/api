<?php

namespace App\Observers\Admin;
use App\Entities\Product;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductObserver
{  

    public function creating(Product $product)
    {
        //Criar codigo que faz Upload de imagems

    }

    public function deleting(Product $product)
    {

        //Criar codigo que Remove Upload

        Product::where('parent_id', $product->id)->delete(); 
             
    }

    public function updating(Product $product)
    {

    }

}