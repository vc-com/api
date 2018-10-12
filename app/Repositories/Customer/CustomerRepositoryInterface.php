<?php

namespace VoceCrianca\Repositories\Customer;

use VoceCrianca\Interfaces\IRepository;

/**
 * Interface CustomerRepositoryInterface
 * @package VoceCrianca\Repositories\Customer
 */
interface CustomerRepositoryInterface extends IRepository
{
    /**
     * @param $data
     * @return mixed
     */
    public function search($data);
}
