<?php

namespace App\Repositories\Customer;

use App\Interfaces\IRepository;

/**
 * Interface CustomerRepositoryInterface
 * @package App\Repositories\Customer
 */
interface CustomerRepositoryInterface extends IRepository
{
    /**
     * @param $data
     * @return mixed
     */
    public function search($data);
}
