<?php

namespace VoceCrianca\Observers\Admin;
use Illuminate\Http\Request;
use VoceCrianca\Models\Product;
use VoceCrianca\Models\ProductHistory;
use VoceCrianca\Repositories\Product\ProductRepositoryInterface;

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

    public function updated(Product $product)
    {
       
   
    }

}