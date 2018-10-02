<?php

namespace App\Repositories\Coupon;

use App\Interfaces\IRepository;

/**
 * Interface CouponRepositoryInterface
 * @package App\Repositories\Coupon
 */
interface CouponRepositoryInterface extends IRepository
{

    /**
     * @param int $limit
     * @return mixed
     */
    public function getFieldsAll($limit=15);

}
