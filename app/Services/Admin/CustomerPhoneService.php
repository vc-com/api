<?php

namespace App\Services\Admin;

use App\Entities\Customer;
use App\Entities\CustomerPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class CustomerPhoneService
 * @package App\Services\Admin
 */
class CustomerPhoneService
{

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var CustomerPhone
     */
    private $customerPhone;

    /**
     * CustomerPhoneService constructor.
     * @param Customer $customer
     * @param CustomerPhone $customerPhone
     */
    public function __construct(Customer $customer, CustomerPhone $customerPhone)
    {
        $this->customer = $customer;
        $this->customerPhone = $customerPhone;
    }

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     */
    public function validator(array $data, $id='')
    {
        return Validator::make($data, [
            'number' => 'required|string',
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

        $customer = $this->customer->find($id);

        $exists = $customer->phones()
                ->where('number', $request->input('number') )
                ->exists();

        if ($exists === true) {
            return $customer->phones()
                ->where('number', $request->input('number') )
                ->first();
        }

        $address = $this->customerPhone->create($request->all());
        $customer->address()->attach($address);

        return $address;

    }

}