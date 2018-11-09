<?php

namespace VoceCrianca\Services\Admin\Setting\Permission;

use VoceCrianca\Models\Role;
use VoceCrianca\Models\Privilege;
use VoceCrianca\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class RoleService
 * @package VoceCrianca\Services\Admin
 */
class RoleService   
{
    /**
     * @var RoleRepositoryInterface
     */
    private $repository;

    /**
     * RoleService constructor.
     * @param RoleRepositoryInterface $repository
     */
    public function __construct(RoleRepositoryInterface $repository)
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

        if (isset($id)) {  
        
            return Validator::make($request->all(), [
                'name' => 'required|string|max:30|unique:roles,name,'. $id .',_id',
                'description' => 'required|string|max:30',
            ]); 

        }

        return Validator::make($request->all(), [            
            'name' => 'required|string|max:30|unique:roles,name',
            'description' => 'required|string|max:30',
        ]);        

    }

    public function isRoleDefault($id)
    {

        $total = Role::where('default', true)
                    ->where('_id', $id)
                    ->count();

        if ( $total > 0 )
            return true;
        return false;

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
        if(!$request->has('default')) {
            $data['default'] = false;
        }

        if (!$role = $this->repository->create( $data )) {
            return false;
        }

        foreach ($request->privileges as $key => $v) {
            $privilege = Privilege::where('name', $v['name'])->first();
            $role->privileges()->attach($privilege);
        }  

        return $role;

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

        if($this->isRoleDefault($id)) {
            return false;
        }

        $data = $request->all();
        if(!$request->has('default')) {
            $data['default'] = false;
        }

        if(!$this->repository->update($id, $data) ) {     
            return false;
        }

        if($request->has('admin') && $request->admin !== 'edit-role') {
            return false;           
        }

        $role = Role::find($id);

        foreach ($role->privileges()->get() as $key => $v) {
            $privilege = Privilege::where('name', $v['name'])->first();
            $role->privileges()->detach($privilege);
        } 

        foreach ($request->privileges as $key => $v) {
            $privilege = Privilege::where('name', $v['name'])->first();
            $role->privileges()->attach($privilege);
        }

        return true;
        
    }

    public function delete($id='')
    {
        if (!isset($id)) {
            return false;
        }

        if($this->isRoleDefault($id)) {
            return false;
        }

        if(!$this->repository->delete($id)) {
            return false;
        }

        return true;

    }

}
