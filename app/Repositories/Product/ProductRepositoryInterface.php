<?php

namespace App\Repositories\Product;

use App\Interfaces\IRepository;

/**
 * Interface ProductRepositoryInterface
 * @package App\Repositories\Product
 */
interface ProductRepositoryInterface extends IRepository
{

    /**
     * @param int $limit
     * @return mixed
     */
    public function getFieldsAll($limit=15);

}
