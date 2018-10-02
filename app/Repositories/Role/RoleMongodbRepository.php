<?php

namespace App\Repositories\Role;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class RoleMongodbRepository
 * @package App\Repositories\Role
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
