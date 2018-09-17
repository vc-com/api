<?php

namespace App\Services\Admin;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Webpatser\Uuid\Uuid;

/**
 * Class UserService
 * @package App\Services\Admin
 */
class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function validatorCreate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|confirmed|min:6|max:255'
        ]);

    }

    /**
     * Get a validator for a User.
     *
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function validatorUpdate(array $data, $id)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'unique:users,email,'.$id.',_id',
            'password' => 'sometimes|required|confirmed|min:6|max:255'
        ]);

    }

    /**
     * Create User
     *
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    public function create(Request $request)
    {

        $data = $request->all();

        if ($request->has('roles')) {
            unset($data['roles']);
        }

        if ($request->has('privileges')) {
            unset($data['privileges']);
        }

        if ($request->has('password')) {
            $data['password'] = Hash::make($request['password']);
        }

        $data['active'] = false;
        if ($request->has('active')) {
            $data['active'] = true;
        } 
      

        if (!$created = $this->repository->create($data)) {
            return false;
        }

        return $created;

    }


    /**
     * Update User
     *
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();
        if ($request->has('password')) {
            $data['password'] = Hash::make($request['password']);
        }

        return $this->repository->update($id, $data);

    }

}