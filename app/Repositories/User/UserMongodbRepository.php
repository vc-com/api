<?php

namespace VoceCrianca\Repositories\User;

use VoceCrianca\Persistences\Mongodb\BaseMongodbAbstractRepository;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class UserMongodbRepository
 * @package VoceCrianca\Repositories\User
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
    /**
     * Get Data User Login
     *
     * @param $data
     * @return mixed
     */
    public function getDataUserLogin(array $data)
    {
        
        $res = $this->model->where($data)->first();

        $query = $this->model->with(['roles']);
        $query->select([
            '_id',
            'email',
            'name',
            'roles',
        ]);

        return $query->find($res->id);

    }

}
