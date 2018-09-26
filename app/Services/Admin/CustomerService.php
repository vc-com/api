<?php

namespace App\Services\Admin;

use App\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class CustomerService
 * @package App\Services\Admin
 */
class CustomerService
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    /**
     * CustomerService constructor.
     * @param CustomerRepositoryInterface $repository
     */
    public function __construct(CustomerRepositoryInterface $repository)
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
                'email' => 'required|string|email|unique:customers,email,'.$id.',_id',
                'password' => 'sometimes|required|confirmed|min:6|max:255'
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:customers|max:255',
            'password' => 'required|string|confirmed|min:6|max:255'
        ]);

    }

    /**
     * Create Customer
     *
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    public function create(Request $request)
    {

        $data = $this->filterRequest($request);

        if (!$created = $this->repository->create($data)) {
            return false;
        }

        return $created;

    }


    /**
     * Update Customer
     *
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function update(Request $request, $id)
    {
        
        $data = $this->filterRequest($request);

        return $this->repository->update($id, $data);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function filterRequest(Request $request)
    {

        $data = $request->all();

        if (!$request->has('active')) {
            $data['active'] = false;
        }

        return $data;

    }

}