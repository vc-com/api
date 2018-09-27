<?php

namespace App\Repositories\Coupon;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class CouponMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CouponRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
