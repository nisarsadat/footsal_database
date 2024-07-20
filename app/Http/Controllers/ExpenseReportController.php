<?php

namespace App\Http\Controllers;

use App\Models\ExpenseReport;
use App\Http\Requests\StoreExpenseReportRequest;
use App\Http\Requests\UpdateExpenseReportRequest;
use App\Http\Resources\ExpenseReportResource;
use App\Models\Expense;
use App\Models\ExpenseCatagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseReportController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
// ==========================that is one way of fetching of data withoout Request $request thes prameters on index or other actions=================================================
        // dd(request(["startDate","endDate"]));
// ==========================that is one way of fetching of data withoout Request $request thes prameters on index or other actions=================================================

        $perPage = $request->input('perPage', 10);
        $startDate = $request->input('startDate'); // Expected format: YYYY-MM-DD
        $endDate = $request->input('endDate');     // Expected format: YYYY-MM-DD

        // Perform the query to get expenses grouped by category names with date range filter
        $query = Expense::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('expenses.date', [$startDate, $endDate]);
            })
            ->join('expense_catagories', 'expenses.expense_catagory_id', '=', 'expense_catagories.id')
            ->select(
                'expense_catagories.name as expense_catagory_name',
                'expense_catagories.id as expense_catagory_id',
                DB::raw('SUM(expenses.amount) as total_amount'),
                DB::raw('COUNT(*) as numberOfRecives')
            )
            ->groupBy('expense_catagories.name', 'expense_catagories.id');

        $expenses = $query->paginate($perPage);
        // dd($expenses);

        return ExpenseReportResource::collection($expenses);
    }




    /**
     * Display the specified resource.
     */
    public function show(ExpenseCatagory $expenseReport)
    {
        // Find the related records in the expenses table for the given expense category
        $expenses = Expense::where('expense_catagory_id', $expenseReport->id)
                            ->join('expense_catagories', 'expenses.expense_catagory_id', '=', 'expense_catagories.id')
                            ->select(
                                'expense_catagories.name as expense_catagory_name',
                                'expenses.id as expense_catagory_id' ,
                                'expenses.amount as total_amount',
                                'expenses.date as date',
                                'expenses.note'
                            )->get();

        // Return a collection of expenses as a resource
        return ExpenseReportResource::collection($expenses);
    }













    //     public function getExpenseByCategory(Request $request)
    // {
    //     // Handle request logic here if needed
    //     // dd($request);
    //     $request->validate([
    //         'catagory_name' => 'required|string', // Assuming catagory_name is the input field name
    //     ]);

    //     $categoryName = $request->input('catagory_name');

    //     $expenses = Expense::join('expense_catagories', 'expenses.expense_catagory_id', '=', 'expense_catagories.id')
    //                        ->where('expense_catagories.name', $categoryName)
    //                        ->get();

    //     return response()->json($expenses);   }



        public function getExpenseByCategory($data)
        {
             // Validate route parameter $data
        $validatedData = validator(['data' => $data], [
            'data' => 'required|string', // Adjust validation rules as needed
        ])->validate();

        // Use $data directly after validation
        $categoryName = $validatedData['data'];

        // Perform join query to fetch expenses related to the category name
        $expenses = Expense::join('expense_catagories', 'expenses.expense_catagory_id', '=', 'expense_catagories.id')
                           ->where('expense_catagories.name', $categoryName)
                           ->get();
                        //    dd($expenses);


        return ExpenseReportResource::collection($expenses);
                        // return response()->json($expenses);

        }

}








