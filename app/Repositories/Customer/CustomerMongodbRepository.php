<?php

namespace App\Repositories\Customer;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class CustomerMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CustomerRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function search($data)
    {
        return $this->model->whereFullText($data)
            ->orderBy('score', [ '$meta' => 'textScore' ] )
            ->get();
    }

}
