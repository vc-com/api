<?php

namespace VoceCrianca\Repositories\Coupon;

use VoceCrianca\Interfaces\IRepository;

/**
 * Interface CouponRepositoryInterface
 * @package VoceCrianca\Repositories\Coupon
 */
interface CouponRepositoryInterface extends IRepository
{

    /**
     * @param int $limit
     * @return mixed
     */
    public function getFieldsAll($limit=15);

}
