<?php

namespace App\Http\Controllers\Api;

use App\Laravue\Models\Customer;
use App\Laravue\Models\CustomerRemote;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CustomerController extends BaseController
{
    const ITEM_PER_PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $customerQuery = Customer::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $role = Arr::get($searchParams, 'role', '');
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($keyword)) {
            $customerQuery->where('name', 'LIKE', '%' . $keyword . '%');
            $customerQuery->where('companyemail', 'LIKE', '%' . $keyword . '%');
        }

        return CustomerResource::collection($customerQuery->paginate($limit));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        unset($data['index']);
        unset($data['key']);
        unset($data['rContactPerson']);
        unset($data['rDayOfWeek']);
        unset($data['rLicenseType']);
        unset($data['rState']);
        unset($data['rStatus']);
        unset($data['rTerm']);
        $customer = new Customer($data);
        $customer->save();
        $data['clientname'] = $data['name'];
        unset($data['name']);
        $customer = new CustomerRemote($data);
        $customer->save();
        return response()->json($customer->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laravue\\Models\\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laravue\\Models\\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laravue\\Models\\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        if($customer === null)
        {
            return response()->json(['error' => 'Customer   $data = $request->all(); not found'], 404);
        }
        $data = $request->all();
        unset($data['id']);
        unset($data['index']);
        unset($data['key']);
        unset($data['rContactPerson']);
        unset($data['rDayOfWeek']);
        unset($data['rLicenseType']);
        unset($data['rState']);
        unset($data['rStatus']);
        unset($data['rTerm']);
        $customer->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laravue\\Models\\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function storeFile(Request $request)
    {
        $customer = Customer::find($request->id);
        if($customer === null)
        {
            return response()->json(['error' => 'Customer   $data = $request->all(); not found'], 404);
        }
    }
}
