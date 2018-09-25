<?php

namespace App\Repositories\Customer;

use App\Interfaces\IRepository;

interface CustomerRepositoryInterface extends IRepository
{
    public function search($data);
}
