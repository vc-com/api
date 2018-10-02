<?php

namespace App\Repositories\Page;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class PageMongodbRepository
 * @package App\Repositories\Page
 */
class PageMongodbRepository
    extends BaseMongodbAbstractRepository
    implements PageRepositoryInterface
{

    /**
     * PageMongodbRepository constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
