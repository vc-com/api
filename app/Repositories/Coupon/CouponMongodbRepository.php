<?php

namespace App\Repositories\Coupon;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class CouponMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CouponRepositoryInterface
{

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


    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function listAll($limit = 15)
    {
    	$result = $this->model->select($this->fields);
		return $result->paginate($limit);
    }

}
