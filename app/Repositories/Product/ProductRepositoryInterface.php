<?php

namespace VoceCrianca\Repositories\Product;

use VoceCrianca\Interfaces\IRepository;

/**
 * Interface ProductRepositoryInterface
 * @package VoceCrianca\Repositories\Product
 */
interface ProductRepositoryInterface extends IRepository
{

    /**
     * @param int $limit
     * @return mixed
     */
    public function getFieldsAll($limit=15);

}
