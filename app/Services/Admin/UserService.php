<?php

namespace VoceCrianca\Services\Admin;

use VoceCrianca\Models\Role;
use VoceCrianca\Models\User;
use VoceCrianca\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserService
 * @package VoceCrianca\Services\Admin
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

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     */
    public function validator(array $data, $id='')
    {
        if ( isset($id) ) {

            return Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email,'.$id.',_id',
                'password' => 'sometimes|required|confirmed|min:6|max:255'
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|confirmed|min:6|max:255'
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

        $data = $this->processRequest($request);

        if (!$user = $this->repository->create($data)) {
            return false;
        }

        foreach ($request->roles as $key => $v) {
            $role = Role::where('name', $v['name'])->first();
            $user->roles()->attach($role);
        }  

        return $user;

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

        $data = $this->processRequest($request);

        if( $this->repository->update($id, $data) ) {

            $user = User::find($id);

            foreach ($user->roles()->get() as $key => $v) {
                $role = Role::where('name', $v['name'])->first();
                $user->roles()->detach($role);
            } 

            foreach ($request->roles as $key => $v) {
                $role = Role::where('name', $v['name'])->first();
                $user->roles()->attach($role);
            }    

            return true;
        }

        return false;        
        
    }
  
    /**
     * @param Request $request
     * @return array
     */
    private function processRequest(Request $request)
    {

        $data = $request->all();       

        if (!$request->has('active')) {
            $data['active'] = false;
        }

        if ($request->has('roles')) {
            unset($data['roles']);
        }

        if ($request->has('privileges')) {
            unset($data['privileges']);
        }

        return $data;
    }

}
