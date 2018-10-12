<?php

namespace VoceCrianca\Repositories\Brand;

use VoceCrianca\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class BrandMongodbRepository
 * @package VoceCrianca\Repositories\Brand
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
