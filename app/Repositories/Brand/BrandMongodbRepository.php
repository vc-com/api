<?php

namespace App\Repositories\Brand;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class BrandMongodbRepository
    extends BaseMongodbAbstractRepository
    implements BrandRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
