<?php

namespace App\Repositories\CustomerAddress;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class CustomerAddressMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CustomerAddressRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
