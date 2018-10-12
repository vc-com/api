<?php

namespace VoceCrianca\Repositories\Banner;

use VoceCrianca\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class BannerMongodbRepository
 * @package VoceCrianca\Repositories\Banner
 */
class BannerMongodbRepository
    extends BaseMongodbAbstractRepository
    implements BannerRepositoryInterface
{

    /**
     * CouponMongodbRepository constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
