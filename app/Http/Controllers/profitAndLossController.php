<?php

namespace App\Http\Controllers;

use App\Http\Resources\profitAndLossControllerResource;
use App\Http\Resources\ProfitAndLossResource;
use App\Models\Booking;
use App\Models\Expense;
use App\Models\OwnerPickup;
use App\Models\Payment;
use Illuminate\Http\Request;

class profitAndLossController extends Controller
{

    public function index()
    {
       // Sum the amount column from owner_pickups
       $totalOwnerPickups = OwnerPickup::sum('amount');

       // Sum the amount column from expenses
       $totalExpenses = Expense::sum('amount');

       // Sum the total column from booking
       $totalBooking = Booking::sum('total');

       // Sum the payed column from payments
       $totalPayments = Payment::sum('payed');

       // Calculate the profit or loss
       $profitOrLoss = $totalBooking -  $totalPayments;

       // Prepare the result array
       $result = [
           'total_owner_pickups' => $totalOwnerPickups,
           'total_expenses' => $totalExpenses,
           'total_booking' => $totalBooking,
           'total_payments' => $totalPayments,
           'profit_or_loss' => $profitOrLoss,
       ];

       // Return the result as a JSON response
       return new ProfitAndLossResource($result);




    }

    /**

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
