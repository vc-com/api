<?php

namespace App\Repositories\CategoryParent;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class CategoryParentMongodbRepository
    extends BaseMongodbAbstractRepository
    implements CategoryParentRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function getById($category, $id)
    {
        return $this->whereFirst([
            'parent_id' =>$category, '_id' => $id
        ]);

    }

}
