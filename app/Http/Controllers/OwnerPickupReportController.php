<?php
namespace App\Http\Controllers;

use App\Http\Resources\OwnerPickupReportResource;
use App\Models\Expense;
use App\Models\Owner;
use App\Models\OwnerPickup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OwnerPickupReportController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $startDate = $request->input('startDate'); // Expected format: YYYY-MM-DD
        $endDate = $request->input('endDate');     // Expected format: YYYY-MM-DD

        // Perform the query to get owner pickups grouped by owner names with date range filter
        $query = OwnerPickup::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('owner_pickups.date', [$startDate, $endDate]);
            })
            ->join('owners', 'owner_pickups.owner_id', '=', 'owners.id')
            ->select(
                        'owners.name as owner_name',
                        'owners.id as owner_id',
                        DB::raw('SUM(owner_pickups.amount) as total_amount'),
                        DB::raw('COUNT(*) as numberOfRecives')

                    )->groupBy('owners.name','owners.id');

        $expenses = $query->paginate($perPage);

        return OwnerPickupReportResource::collection($expenses);

    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $ownerPickupReport)
    {       
                    // Find the related records in owner_pickups table
            $ownerPickups = OwnerPickup::where('owner_id', $ownerPickupReport->id)
            ->join('owners', 'owner_pickups.owner_id', '=', 'owners.id')
            ->select(
                'owners.name as owner_name',
                'owners.id as owner_id',
                'owner_pickups.*'
            )->get();

        // Wrap the result in a resource collection
        return OwnerPickupReportResource::collection($ownerPickups);

    }








    public function getOwnerPickupReportAll(Request $request){
        {

            $perPage = $request->input('perPage', 10);
            $startDate = $request->input('startDate'); // Expected format: YYYY-MM-DD
            $endDate = $request->input('endDate');     // Expected format: YYYY-MM-DD

            // Perform the query to get owner pickups grouped by owner names with date range filter
            $query = OwnerPickup::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    return $query->whereBetween('owner_pickups.date', [$startDate, $endDate]);
                })
                ->join('owners', 'owner_pickups.owner_id', '=', 'owners.id')
                ->select(
                    'owners.name as owner_name',
                    'owners.id as owner_id',
                    DB::raw('SUM(owner_pickups.amount) as total_amount'),
                    DB::raw('COUNT(*) as numberOfRecives')
                )
                ->groupBy('owners.name','owners.id');

            $expenses = $query->paginate($perPage);

            return OwnerPickupReportResource::collection($expenses);
        }



    // $perPage = $request->query('perPage', 10);
    //     // Perform the query to get expenses grouped by category names
    // $expenses = OwnerPickup::join('owners', 'owner_pickups.owner_id', '=', 'owners.id')
    // ->select(
    //     'owners.name as owner_name',
    //     DB::raw('SUM(owner_pickups.amount) as total_amount'),
    //     DB::raw('count(*) as numberOfRecives')
    // )
    // ->groupBy('owners.name')
    // ->paginate($perPage);
    // return OwnerPickupReportResource::collection($expenses);

    }
}
