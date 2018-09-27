<?php

namespace App\Repositories\CouponCategory;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class CouponCategoryMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CouponCategoryRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
