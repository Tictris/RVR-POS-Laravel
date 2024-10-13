<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $customer = Customer::orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'message'   =>  'Customers list',
            'customers' =>  $customer,

        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCustomerRequest $request)

    {
        $customer = Customer::create($request->validated());

        return response()->json([
            'message'   =>  'Customer added!',
            'customer'  =>  $customer

        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, $id)

    {
        $customer = Customer::find($id);

        $customer->update($request->validated());
        
        return response()->json([
            'message'   => 'Customer updated!',
            'data'      => $customer->fresh()
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
