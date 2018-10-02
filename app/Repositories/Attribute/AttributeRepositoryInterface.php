<?php

namespace App\Repositories\Attribute;

use App\Interfaces\IRepository;

/**
 * Interface AttributeRepositoryInterface
 * @package App\Repositories\Attribute
 */
interface AttributeRepositoryInterface extends IRepository
{

    /**
     * @param int $limit
     * @return mixed
     */
    public function getFieldsAll($limit=15);

}
