<?php

namespace VoceCrianca\Repositories\User;

use VoceCrianca\Interfaces\IRepository;

/**
 * Interface UserRepositoryInterface
 * @package VoceCrianca\Repositories\User
 */
interface UserRepositoryInterface extends IRepository
{
    /**
     * @param $data
     * @return mixed
     */
    public function search($data);

    /**
     * @param $data
     * @return mixed
     */
    public function getDataUserLogin(array $data);
}
