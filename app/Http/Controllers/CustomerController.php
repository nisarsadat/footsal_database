<?php

namespace App\Http\Controllers;

// use App\Http\Resources\customerR;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{



    // public function __construct()
    // {
    //     $this->middleware('permission:view customers')->only(['index', 'show']);
    //     $this->middleware('permission:create customers')->only(['store']);
    //     $this->middleware('permission:edit customers')->only(['update']);
    //     $this->middleware('permission:delete customers')->only(['destroy']);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


            // Number of items per page, default is 10
    $perPage = $request->query('perPage', 10);

    // Fetch paginated bookings
    $customer = Customer::with(['bookings'])->orderBy('id', 'desc')->paginate($perPage);

    // Return paginated collection of BookingResource
    return CustomerResource::collection($customer);

        // return CustomerResource::collection(Customer::all());

        // $customer= Customer::all();
        // return response()->json(["data"=>$customer]);
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
    public function store(StoreCustomerRequest $request)
    {
        // return "abc";
        $validatedDate=$request->validated();
        $customer=Customer::create($validatedDate);
        return response()->json(["data"=>$customer]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {

        return new CustomerResource($customer);
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
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $validated=$request->validated();
        $customer->update($validated);
        return response()->json(["data"=>$customer]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $id=$customer->id;
        $customer->delete();
        return "deleted"." ".$id;
        return 'deleted';


    }
}
