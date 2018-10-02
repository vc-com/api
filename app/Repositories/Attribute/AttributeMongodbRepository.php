<?php

namespace App\Repositories\Attribute;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class AttributeMongodbRepository
 * @package App\Repositories\Attribute
 */
class AttributeMongodbRepository
    extends BaseMongodbAbstractRepository
    implements AttributeRepositoryInterface
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
