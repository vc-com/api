<?php

namespace App\Repositories\Category;

use App\Interfaces\IRepository;

/**
 * Interface CategoryRepositoryInterface
 * @package App\Repositories\Category
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
