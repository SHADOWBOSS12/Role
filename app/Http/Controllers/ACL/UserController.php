<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {

        //$this->middleware(['permission:Publish|Edit|Delete']);
        $this->middleware(['role_or_permission:Author|Super-Admin|delete|view']);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $this->authorize('viewAny',User::class);
        $users=User::with(  'roles')->simplePaginate(2);

        //->load('roles');

$roles=Role::all();
$permissions=Permission::all();

        return  view('Users.index',compact('users','roles','permissions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create',User::class);
        $valid_data=$this->validate($request,[

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],

        ]);

$valid_data['password']=Hash::make($request->input('password'));


       $user= User::create($valid_data);



        $roles=$request->input('roles');

        (isset($roles))? $user->assignRole($request->input('roles')):"failed";





        $permissions=$request->input('permissions');

        (isset($permissions)) ?"assign Permission"   :"No permiisons to add";






        $request->session()->flash('success','User Created Succesfully');

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //



        $user=User::find($id);
                    $this->authorize('update',$user);

$roles=Role::all();
$permissions=Permission::all();


        return  view('Users.edit',compact('user','roles','permissions'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        //Gate::authorize('update', $user);


        $this->authorize('update',$user);



        $user->syncRoles($request->input('roles'));

        $user->syncPermissions($request->input('permissions'));





        $request->session()->flash('success','Role Assigned Succesfully');

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $user=User::find($id);

        $this->authorize('delete',$user);


        $user->roles()->detach();

        $user->delete();

          session()->flash('success','Role Assigned Succesfully');

        return redirect()->back();



    }


}
