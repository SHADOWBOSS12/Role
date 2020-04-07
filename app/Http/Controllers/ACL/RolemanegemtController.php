<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolemanegemtController extends Controller
{

    public  function  __construct()
    {
 $this->middleware(['permission:Publish|Delete|View']);


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny',Role::class);

        $roles=Role::latest()->simplePaginate(2);



        return  view('Roles.index',compact('roles'));
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


        $this->authorize('create',Role::class);

        $data=$this->validate($request,[

           'name'=>'required'



        ]);


        Role::create($data);
        $request->session()->flash('success','Role Created Succesfully');
return  redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //        $this->authorize('view',$role);

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

        $role=Role::findById($id);
        $this->authorize('update',$role);

        $permissions=Permission::all();

        return  view('Roles.edit',compact('role','permissions'));


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
        //
        $role=Role::findById($id);


       $this->authorize('update',$role);





//        $this->validate($request,[
//            'permissions'=>'required'
//
//
//            ]);


        $role->syncPermissions($request->input('permissions'));



        $request->session()->flash('success','Permissions Assigned  To Role Succesfully');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $role=Role::find($id);
        $this->authorize('delete',$role);
        $role->delete();



    }
}
