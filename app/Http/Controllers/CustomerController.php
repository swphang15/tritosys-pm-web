<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = Customer::paginate(50);
        return response($datas, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.add_customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = $request->all();
        $customer = Customer::create($customer);

        $req_user = Auth::user();

        $notification = new NotificationController();
        $notification->sendNotification(collect([
            'title' => 'Customer Added',
            'description' => 'Customer "' . $request->name . '" successfully added',
            'user_id' => $req_user->id,
            'event_id' => $customer->id,
            'module' => 'Customer'
        ]));

        return response()->json(['status' => "success"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        return response($customer, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit_customer', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->fill($request->only([
            'company_name',
            'registration_no',
            'contact',
            'email',
            'status',
        ]));
        $customer = $customer->save();
        return response()->json(['status' => "success"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['status' => "success"], 200);
    }

    public function listing(Customer $customer)
    {
        $datas = Customer::all();
        return view('customer.listing', compact('datas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_listing()
    {
        //
        $datas = Customer::select('id', 'company_name as name')->get();
        return response($datas, 200);
    }
}
