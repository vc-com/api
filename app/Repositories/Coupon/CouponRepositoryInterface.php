<?php

namespace App\Repositories\Coupon;

use App\Interfaces\IRepository;

interface CouponRepositoryInterface extends IRepository
{

	public function listAll($limit = 15);

}
