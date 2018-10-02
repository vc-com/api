<?php

namespace App\Repositories\Privilege;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class PrivilegeMongodbRepository
 * @package App\Repositories\Privilege
 */
class PrivilegeMongodbRepository
    extends BaseMongodbAbstractRepository
    implements PrivilegeRepositoryInterface
{

    /**
     * PrivilegeMongodbRepository constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
