<?php

namespace App\Repositories\User;

use App\Interfaces\IRepository;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories\User
 */
interface UserRepositoryInterface extends IRepository
{
    /**
     * @param $data
     * @return mixed
     */
    public function search($data);
}
