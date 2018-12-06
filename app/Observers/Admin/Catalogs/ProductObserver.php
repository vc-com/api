<?php

namespace VoceCrianca\Observers\Admin\Catalogs;

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
        Product::where('parent_id', $product->id)->delete();
    }

    public function updating(Product $product)
    {

    }

    public function updated(Product $product)
    {

    }

}
