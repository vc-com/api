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

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function checkToken(array $request)
    {

        $users = $this->model->select('tokenResetPassword')->where(
            'tokenResetPassword.time', '<=', time()
        )->get();

        if($users) {
            foreach ($users as $key => $user) {
                $user->tokenResetPassword()->delete();
            }
        }

        $res = $this->model->select('tokenResetPassword')->where(
            'tokenResetPassword.token', $request['token']
        )->get();

        foreach ($res as $key => $value) {      
            return $value->id;      
        }
      
        return false;

    }

}
