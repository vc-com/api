<?php

namespace App\Repositories\Banner;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class BannerMongodbRepository
    extends BaseMongodbAbstractRepository
    implements BannerRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
