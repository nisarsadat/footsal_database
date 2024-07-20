<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Booking;
use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('perPage');

        // Fetch paginated bookings
        $bookings = Payment::with(['booking'])->orderBy('id', 'desc')->paginate($perPage);

        // Return paginated collection of BookingResource
        return PaymentResource::collection($bookings);


        // $payment= Payment::all();
        // return response()->json(["data"=>$payment]);
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
    public function store(StorePaymentRequest $request)
    {
         // return "abc";
         $validatedDate=$request->validated();
         $payment=Payment::create($validatedDate);
        //  return response()->json(["data"=>$payment]);
        //  dd($payment);






         $booking = Booking::findOrFail($validatedDate['booking_id']);
        //  $payment = $booking->update([
        //     'payed' =>$payment->payed, // Use the payed value from validatedData
        // ]);
        $booking->update([
            'payed' => $booking->payed + $payment->payed,
            'due' =>$booking->total - ($booking->payed + $payment->payed),
        ]);

        // Return the newly created payment resource
        return new PaymentResource($payment);
    }







    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->load('booking'); // Eager load the relationships

        return new PaymentResource($payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {


        $validated=$request->validated();
        $payment->update($validated);
        return response()->json(["data"=>$payment]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $id=$payment->id;
        $payment->delete();
        return "deleted"." ".$id;
        return 'deleted';

    }
}
