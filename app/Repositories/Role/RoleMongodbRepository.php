<?php

namespace VoceCrianca\Repositories\Role;

use VoceCrianca\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class RoleMongodbRepository
 * @package VoceCrianca\Repositories\Role
 */
class RoleMongodbRepository
    extends BaseMongodbAbstractRepository
    implements RoleRepositoryInterface
{

    /**
     * RoleMongodbRepository constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
