<?php

namespace VoceCrianca\Repositories\Coupon;

use VoceCrianca\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class CouponMongodbRepository
 * @package VoceCrianca\Repositories\Coupon
 */
class CouponMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CouponRepositoryInterface
{

    /**
     * @var array
     */
    protected $fields = [
		'active',
		'name',
		'code',
		'description',
		'type',
		'discount',
		'uses_total',
		'uses_customer',
		'value',
		'minimum_value',
		'quantities',
		'apply_to_total',
		'cumulative',
		'quantity_by_customer',
		'used_total',
		'date_start',
		'date_end'
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
