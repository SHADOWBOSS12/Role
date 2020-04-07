<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionmanegemtController extends Controller
{

    public  function  __construct()
    {
        //$this->middleware(['permission:Publish|Edit|Delete']);

        $this->middleware(['role_or_permission:Author|Super-Admin|Delete|Edit']);

//let the constructor verify the role
        //let the functiins veify the permissions a role have to perform an
        // action using policies

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny',Permission::class);

        $permissions=Permission::latest()-> simplePaginate(2);



        return view('Permissions.index',compact('permissions'));
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
        $this->authorize('create',Permission::class);

        $data=$this->validate($request,[

            'name'=>'required'



        ]);


        Permission::create($data);
        $request->session()->flash('success','Permission Created Succesfully');
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
        $permission=Permission::findById($id);
        $this->authorize('update',$permission);



        return  view('Permissions.edit',compact('permission'));



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
        $permission=Permission::findById($id);


        $this->authorize('update',$permission);


        $permission->name=$request->input('permission');

        $permission->update();

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
        $permission=Permission::findById($id);
        $this->authorize('delete',$permission);

        $permission->delete();


    }
}
