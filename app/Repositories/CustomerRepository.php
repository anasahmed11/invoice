<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class CustomerRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $customers = Customer::orderByDesc("id")->
            when($request->get('customer_name'), function ($customers) use ($request) {
                return $customers->where('name', 'like', '%' . $request->query->get('customer_name') . '%');
            })
            ->when($request->get('customer_phone'), function ($customers) use ($request) {
                return $customers->where('phone', 'like', '%' . $request->query->get('customer_phone') . '%');
            })
        ;
        return $customers;
    }

}
