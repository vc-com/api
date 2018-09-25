<?php

namespace App\Repositories\CustomerPhone;

use App\Interfaces\IRepository;

interface CustomerPhoneRepositoryInterface extends IRepository
{
    public function search($data);
}