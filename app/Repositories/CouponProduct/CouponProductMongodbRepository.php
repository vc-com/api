<?php

namespace App\Repositories\CouponProduct;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class CouponProductMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CouponProductRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
