<?php

namespace App\Repositories\CouponHistory;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class CouponHistoryMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CouponHistoryRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
