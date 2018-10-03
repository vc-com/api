<?php

namespace App\Repositories\Product;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class ProductMongodbRepository
 * @package App\Repositories\Product
 */
class ProductMongodbRepository
    extends BaseMongodbAbstractRepository
    implements ProductRepositoryInterface
{

    /**
     * @var array
     */
    protected $fields = [
        'name',
        'active',
        'type',
    ];

    /**
     * CouponMongodbRepository constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function getFieldsAll($limit=15)
    {
        $result = $this->model->select($this->fields);
        return $result->paginate($limit);
    }

}
