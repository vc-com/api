<?php

namespace App\Repositories\User;

use App\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class UserMongodbRepository
 * @package App\Repositories\User
 */
class UserMongodbRepository
    extends BaseMongodbAbstractRepository
    implements UserRepositoryInterface
{

    /**
     * UserMongodbRepository constructor.
     * @param Model $model
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function search($data)
    {
        return $this->model->whereFullText($data)
            ->orderBy('score', [ '$meta' => 'textScore' ] )
            ->get();
    }

}
