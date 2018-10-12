<?php

namespace VoceCrianca\Repositories\Attribute;

use VoceCrianca\Interfaces\IRepository;

/**
 * Interface AttributeRepositoryInterface
 * @package VoceCrianca\Repositories\Attribute
 */
interface AttributeRepositoryInterface extends IRepository
{

    /**
     * @param int $limit
     * @return mixed
     */
    public function getFieldsAll($limit=15);

}
