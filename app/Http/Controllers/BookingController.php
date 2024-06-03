<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Number of items per page, default is 10
    $perPage = $request->query('perPage', 10);

    // Fetch paginated bookings
    $bookings = Booking::with(['customer', 'hall'])->paginate($perPage);

    // Return paginated collection of BookingResource
    return BookingResource::collection($bookings);

        // $booking= Booking::with(['customer','hall'])->get();
        // return response()->json(["data"=>$bookings]);

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
    public function store(StoreBookingRequest $request)
    {

        $validatedDate=$request->validated();
          // Calculate grand_total and due
        $validatedDate['grand_total'] = $validatedDate['price'] + $validatedDate['stuffs_rent'] - $validatedDate['discount'];
        $validatedDate['due'] = $validatedDate['grand_total'] - $validatedDate['total'];

    // Create a new booking using the validated data
        $booking = Booking::create($validatedDate);


        return new BookingResource($booking);

        // return response()->json(["data"=>$booking]);
    }




    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        // dd($Booking);

        $booking->load('customer', 'hall'); // Eager load the relationships

        return new BookingResource($booking);

        // $booking = Booking::with(['customer', 'hall'])->findOrFail($booking->id);
        // return new BookingResource($booking);

        // return new BookingResource($booking);
        // return response()->json(["data"=>$booking]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        // return "ok";





        $validated=$request->validated();

        $booking->update($validated);
        // dd($booking);
        $booking->load('customer', 'hall'); // Eager load the relationships

        return new BookingResource($booking);

        // return new BookingResource($booking);
        // return response()->json(["data"=>$booking]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $id=$booking->id;
        $booking->delete();
        return "deleted"." ".$id;
        return 'deleted';
    }
}
