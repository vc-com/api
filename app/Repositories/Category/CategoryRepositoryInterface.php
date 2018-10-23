<?php

namespace VoceCrianca\Repositories\Category;

use VoceCrianca\Interfaces\IRepository;

/**
 * Interface CategoryRepositoryInterface
 * @package VoceCrianca\Repositories\Category
 */
interface CategoryRepositoryInterface extends IRepository
{

    /**
     * @return mixed
     */
	public function toArray();

    /**
     * @param $parentId
     * @param $id
     * @return mixed
     */
    public function isExistsParent($parentId, $id);

    /**
     * @param $parentId
     * @param $name
     * @param $id
     * @return mixed
     */
    public function isExistsNameParent($parentId, $name, $id);

}
