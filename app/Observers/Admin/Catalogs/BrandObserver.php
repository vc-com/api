<?php

namespace VoceCrianca\Observers\Admin\Catalogs;

use Illuminate\Http\Request;
use VoceCrianca\Models\Brand;
use VoceCrianca\Repositories\Brand\BrandRepositoryInterface;

class BrandObserver
{


    public function created(Brand $brand)
    {
        //Criar codigo que faz Upload de imagems

    }

    public function deleting(Brand $brand)
    {

    }

    public function updating(Brand $brand)
    {

    }

    public function updated(Brand $brand)
    {

    }

}
