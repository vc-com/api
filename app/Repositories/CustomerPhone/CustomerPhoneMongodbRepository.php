<?php

namespace App\Repositories\CustomerPhone;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class CustomerPhoneMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CustomerPhoneRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
    
}
