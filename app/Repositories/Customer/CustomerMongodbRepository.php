<?php

namespace App\Repositories\Customer;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class CustomerMongodbRepository
 * @package App\Repositories\Customer
 */
class CustomerMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CustomerRepositoryInterface
{

    /**
     * CustomerMongodbRepository constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function search($data)
    {
        return $this->model->whereFullText($data)
            ->orderBy('score', [ '$meta' => 'textScore' ] )
            ->get();
    }

}
