<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 10);
        $startDate = $request->query('startDate'); // Expected format: YYYY-MM-DD
        $endDate = $request->query('endDate');     // Expected format: YYYY-MM-DD

        // Perform the query to filter bookings by date range and sum columns
        $query = Booking::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('date', [$startDate, $endDate]);
            })
            ->join('customers', 'bookings.customer_id', '=', 'customers.id')
            ->select(
                'customers.name as customerName',
                'customers.id as customerId',
                DB::raw('SUM(bookings.total) as totalSum'),
                DB::raw('SUM(bookings.due) as dueSum')

            ) ->groupBy('customers.id', 'customers.name');

        $bookings = $query->paginate($perPage);

        // Return the results as JSON
        return response()->json($bookings);
    }
    /**



    /**
     * Display the specified resource.
     */
    public function show($bookingReport)
    {
        $bookingReport=Customer::findOrFail($bookingReport);
        // Find the related bookings for the given customer
        $bookings = Booking::where('customer_id', $bookingReport->id)
            ->select(
                '*'
                )->get();
                $bookings['customerName']=$bookingReport->name;

        // Return the results as JSON

        return response()->json([
            'customer' => $bookingReport->name,
            'bookings' => $bookings
        ]);


    }



}
