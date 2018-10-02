<?php

namespace App\Repositories\Banner;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class BannerMongodbRepository
 * @package App\Repositories\Banner
 */
class BannerMongodbRepository
    extends BaseMongodbAbstractRepository
    implements BannerRepositoryInterface
{

    /**
     * BannerMongodbRepository constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
