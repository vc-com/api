<?php

namespace App\Repositories\Page;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

class PageMongodbRepository
    extends BaseMongodbAbstractRepository
    implements PageRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
