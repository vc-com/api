<?php

namespace App\Repositories\Category;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class CategoryMongodbRepository
 * @package App\Repositories\Category
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

}
