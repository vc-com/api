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
     * @param array $request
     * @param string $id
     * @return mixed
     */
    public function validator(Request $request, $id='')
    {


        if ( isset($id) && is_string($id) ) {  

            return Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'string|email|unique:users,email,'.$id.',_id',
                'password' => 'sometimes|confirmed',
                'active' => 'boolean'
            ]); 

        }

        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'sometimes|required|string|min:6|confirmed',
            'active' => 'required|boolean'
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

        if (!$user = $this->repository->create($request->all())) {
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

        if( $this->repository->update($id, $request->all()) ) {     

            if($request->has('admin')) {

                $user = User::find($id);

                if($request->admin == 'edit-user') {

                    foreach ($user->roles()->get() as $key => $v) {
                        $role = Role::where('name', $v['name'])->first();
                        $user->roles()->detach($role);
                    } 

                    foreach ($request->roles as $key => $v) {
                        $role = Role::where('name', $v['name'])->first();
                        $user->roles()->attach($role);
                    }    

                }

            }     

            return true;
        }

        return false;        
        
    }


}
