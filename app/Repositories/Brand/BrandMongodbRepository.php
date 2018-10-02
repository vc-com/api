<?php

namespace App\Repositories\Brand;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class BrandMongodbRepository
 * @package App\Repositories\Brand
 */
class BrandMongodbRepository
    extends BaseMongodbAbstractRepository
    implements BrandRepositoryInterface
{

    /**
     * BrandMongodbRepository constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
