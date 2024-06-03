<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymnasiumRequest;
use App\Http\Requests\UpdateGymnasiumRequest;
use App\Http\Resources\GymnasiumResource;
use App\Models\Gymnasium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GymnasiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 10);

        // Fetch paginated bookings
        $bookings = Gymnasium::with([])->paginate($perPage);

        // Return paginated collection of BookingResource
        return GymnasiumResource::collection($bookings);

        // return GymnasiumResource::collection(Gymnasium::all());
        // return CustomerR::collection(Gymnasium::all());



        // return "ok";
        // $gymnasiums = Gymnasium::all();
        // return view('gymnasiums.index', compact('gymnasiums'));




        // $gymnasium= Gymnasium::all();
        // return response()->json(["data"=>$gymnasium]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(StoreGymnasiumRequest $request)
    {
        // Validate the incoming request using the StoreGymnasiumRequest rules
        $request->validate([
            'name' => 'required|string|max:255',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'note' => 'required|string',
        ]);

        // Store the uploaded image in the 'public/images' directory
        $imagePath = $request->file('path')->store('images', 'public');

        // Create a new Gymnasium record in the database
        Gymnasium::create([
            'name' => $request->name,
            'path' => $imagePath,
            'note' => $request->note, // Make sure 'note' is used instead of 'description'
        ]);

        // Return a JSON response indicating success
        return response()->json(['success' => 'Image uploaded successfully'], 200);
    }

    /**
   */



    //     //     return back()->with('success', 'Gymnasium created successfully.');
    //     //

    //     // return back()->with('error', 'Failed to upload photo.');
    //



    // $validatedDate=$request->validated();
    // $gymnasium=Gymnasium::create($validatedDate);
    // return response()->json(["data"=>$gymnasium]);






    /**
     * Display the specified resource.
     */
    public function show(Gymnasium $gymnasium)
    {
        // dd($gymnasium);


        return new GymnasiumResource($gymnasium);
        // return response()->json(['data' => $gymnasium]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gymnasium $gymnasium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

// ---------------------------------------------------------------------
    //  public function update(Request $request, $id)
    //  {
    //      $request->validate([
    //          'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate file if present
    //      ]);

    //      $gymnasium = Gymnasium::find($id);

    //      if ($request->hasFile('file')) {
    //          $path = public_path().'/uploads/images/';

    //          // Check if the old file exists and delete it
    //          if (!empty($gymnasium->file) && file_exists($path . $gymnasium->file)) {
    //              unlink($path . $gymnasium->file);
    //          }

    //          // Upload new file
    //          $file = $request->file('file');
    //          $filename = $file->getClientOriginalName();

    //          try {
    //              $file->move($path, $filename);
    //              // Update file name in the database
    //              $gymnasium->update(['file' => $filename]);
    //              return response()->json(['success' => 'File updated successfully'], 200);
    //          } catch (\Exception $e) {
    //              return response()->json(['error' => 'File upload failed.'], 500);
    //          }
    //      }

    //      return response()->json(['error' => 'No file provided.'], 400);
    //  }
// ---------------------------------------------------------------------


// ========================================================================================
     public function updateGymnasium(UpdateGymnasiumRequest $request, Gymnasium $gymnasium)
{

    // return "ok";

    $request->validate([
        'name' => 'required|string|max:255',
        'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional image upload
        'note' => 'required|string',
    ]);

     // Store the uploaded image in the 'public/images' directory
    //  return "ok";
     $imagePath = $request->file('path')->store('images', 'public');
     // Create a new Gymnasium record in the database
     $gymnasium->update([
         'name' => $request->name,
         'path' => $imagePath,
         'note' => $request->note, // Make sure 'note' is used instead of 'description'
     ]);

     // Return a JSON response indicating success
     return response()->json(['success' => 'Image uploaded successfully'], 200);
     // $validated = $request->validated();

     // // Handle the image upload if provided
     // if ($request->hasFile('path')) {
         //     // Store the uploaded image in the 'public/images' directory
         //     $imagePath = $request->file('path')->store('images', 'public');
    //     // Update the path in the database
    //     $gymnasium->path = $imagePath;
    // }

    // // Update the other fields
    // $gymnasium->name = $request->name;
    // $gymnasium->note = $request->note;
    // $gymnasium->save();
    return response()->json(['success' => 'Gymnasium updated successfully', 'data' => $gymnasium], 200);

    // Return a JSON response indicating success
}
// ===========================================================================================
// public function update(UpdateGymnasiumRequest $request, Gymnasium $gymnasium)
// {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional image upload
//         'note' => 'required|string',
//     ]);

//     // Check if a file is provided in the request
//     if ($request->hasFile('path')) {
//         // Store the uploaded image in the 'public/images' directory
//         $imagePath = $request->file('path')->store('images', 'public');
//         // Update the Gymnasium record with the new image path
//         $gymnasium->path = $imagePath;
//     }

//     // Update other Gymnasium data
//     $gymnasium->name = $request->name;
//     $gymnasium->note = $request->note;

//     // Save the updated Gymnasium record
//     $gymnasium->save();

//     // Return a JSON response indicating success
//     return response()->json(['success' => 'Gymnasium updated successfully'], 200);
// }

//=================================================================================================

    //     // $validated=$request->validated();
    //     // $gymnasium->update($validated);
    //     // return response()->json(["data"=>$gymnasium]);

    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gym=Gymnasium::findOrFail($id);
        $gym->delete();
        return('successfuly deleted');
        // Delete the associated image if it exists
        // if ($gymnasium->path) {
        //     Storage::disk('public')->delete($gymnasium->path);
        // }

        // Delete the Gymnasium record
        // $gymnasium->delete();

        // // Return a JSON response indicating success
        // return response()->json(['success' => 'Gymnasium deleted successfully'], 200);
    }
}
