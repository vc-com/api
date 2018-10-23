<?php

namespace VoceCrianca\Repositories\Product;

use VoceCrianca\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class ProductMongodbRepository
 * @package VoceCrianca\Repositories\Product
 */
class ProductMongodbRepository
    extends BaseMongodbAbstractRepository
    implements ProductRepositoryInterface
{

    /**
     * @var array
     */
    protected $fields = [
        '*',
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
        $result = $this->model->select($this->fields)->where('parent_id', 0);
        return $result->paginate($limit);
    }

}
