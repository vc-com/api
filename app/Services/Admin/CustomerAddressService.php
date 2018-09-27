<?php

namespace App\Services\Admin;

use App\Entities\Customer;
use App\Entities\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class CustomerAddressService
 * @package App\Services\Admin
 */
class CustomerAddressService
{

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var CustomerAddress
     */
    private $customerAddress;

    /**
     * CustomerAddressService constructor.
     * @param Customer $customer
     * @param CustomerAddress $customerAddress
     */
    public function __construct(Customer $customer, CustomerAddress $customerAddress)
    {
        $this->customer = $customer;
        $this->customerAddress = $customerAddress;
    }

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     */
    public function validator(array $data, $id='')
    {
        return Validator::make($data, [
            'address' => 'required|string',
            'postcode' => 'required|string'
        ]);
    }

    /**
     * Create and Attach
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function create(Request $request, $id)
    {

        $address = $this->customerAddress->create($request->all());
        $customer = $this->customer->find($id);
        $customer->address()->attach($address);

        return $address;

    }

}