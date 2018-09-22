<?php

namespace App\Repositories\Category;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class CategoryMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CategoryRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
