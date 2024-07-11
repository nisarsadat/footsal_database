<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function assignRole(Request $request, User $user)
    {
        $user->assignRole($request->role);
        return response()->json(['message' => 'Role assigned successfully']);
    }



    public function index(Request $request)

    {


        $perPage = $request->query('perPage', 10);

        // Fetch paginated bookings`
        $user = User::with([])->orderBy('id', 'desc')->paginate($perPage);

        // Return paginated collection of BookingResource
        // return ($user);
        return UserResource::collection($user);}









        public function store(UserRequest $request){





        $fields=$request->validate([
            "name"=>'required|string',
            "email"=>'required',
            "password"=>'required|confirmed'


        ]);
        // "email"=>'required',function(){},


        $user=User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])


        ]);

        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[

            'user'=>$user,
            'token'=>$token
        ];

        // $user->syncRoles(["manager"]); # it is very important to authorization ,after coming on satarday uncomment it

        return response($response,201);


        }



        public function update(UserRequest $request, User $user){


            // dd($request);



            $fields=$request->validate([
                "name"=>'required|string',
                "email"=>'required',
                "password"  =>'confirmed'    ]);




                $data=["name"=>$request->name,
                "email"=>$request->email          ];


                // return empty($request->password);

                if (!empty($request->password)){
                    $data+=[
                        'password'=>bcrypt($request->password??null)];


                    }


            $user->update($data);
            $user->syncRoles(["boos","employee"]);

            return "updated suceessfullly";






        }



        public function destroy(User $user)
        {
            $id=$user->id;
            $user->delete();
            return "deleted"." ".$id;
            return 'deleted';


        }






//   // Get the role's permissions
//   $permissions = $role->permissions->pluck('name'); // Get permission names

//   // Prepare the response
//   $response = [
//       'role_id' => $role->id,
//       'role_name' => $role->name,
//       'permissions' => $permissions
//   ];

//   return response()->json($response);


public function show(User $user){



     // Eager load roles and permissions
     $user->load('roles.permissions');

     // Get user's name
     $userName = $user->name;
     $userEmail = $user->email;

     // Initialize an array to hold all role data
     $rolesData = [];

     // Loop through each role associated with the user
     foreach ($user->roles as $role) {
         // Get role ID, name, and permissions
         $roleId = $role->id;
         $roleName = $role->name;
         $permissions = $role->permissions->pluck('name');

         // Prepare role data for the current role
         $roleData = [
             'role_id' => $roleId,
             'role_name' => $roleName,
             'permissions' => $permissions
         ];

         // Add role data to rolesData array
         $rolesData[] = $roleData;
     }

     // Prepare the response
     $response = [
         'name' => $userName,
         "email"=>$userEmail,
         'roles' => $rolesData,
     ];

     // Return the response as JSON
     return response()->json($response);




            // $roles = $user->roles()->pluck('name'); // Pluck role names

            // return $roles;





            // $permissions = $user->getAllPermissions()->pluck('name'); // Get permission names
            // return $permissions;
            // return ($user->getRoleNames());

             // Get all permissions directly assigned to the user



// -====================================================================


        //     $permissions = $user->getAllPermissions()->pluck('name'); // Get permission names

        // // Prepare the response
        // $response = [
        //     'user_id' => $user->id,
        //     'permissions' => $permissions
        // ];

        // return response()->json($response);



        }
    }





