<?php

namespace App\Repositories\CustomerAddress;

use App\Interfaces\IRepository;

interface CustomerAddressRepositoryInterface extends IRepository
{
    public function search($data);
}
