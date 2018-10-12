<?php

namespace VoceCrianca\Repositories\Category;

use VoceCrianca\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class CategoryMongodbRepository
 * @package VoceCrianca\Repositories\Category
 */
class CategoryMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CategoryRepositoryInterface
{

    /**
     * CategoryMongodbRepository constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        return $this->model->get()->toArray();
    }

    /**
     * @param $parentId
     * @param $id
     * @return mixed
     */
    public function isExistsParent($parentId, $id)
    {

        $data = [
            '_id' => $id,
            'parent_id' => $parentId,
        ];

        return parent::whereExists($data);
        
    }

    /**
     * @param $parentId
     * @param $name
     * @param $id
     * @return mixed
     */
    public function isExistsNameParent($parentId, $name, $id)
    {

        $total = $this->model->where('_id', '!=', $id)
                    ->where('parent_id', $parentId)
                    ->where('name', $name)
                    ->count();

        if ($total > 0)
            return true;
        return false;
        
    }    

}
