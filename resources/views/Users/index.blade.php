@extends('layouts.master')

@section('content')

    <div class="row m-t-30">



        <div class="col-md-12">
            <!-- DATA TABLE-->
            @error('name')
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Fail  To create</span>
                {{$message}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>@enderror

            @error('email')
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Fail  To create</span>
                {{$message}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>@enderror


            @error('password')
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Fail  To create</span>
                {{$message}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>@enderror


            @if(session('success'))

                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>

                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


            @endif




            <div class="float-md-right mb-2 ">

                <button  type="button" class="btn btn-outline-danger mb-1" data-toggle="modal" data-target="#largeModal">
                    <i class="fas fa-user-plus disabled"></i> Create User
                </button>

            </div>

            <div class="table-responsive m-b-40 clearfix">
                <table class="table table-borderless table-data3">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>created_At</th>
                        <th>Updated_at</th>
                        <th>Actions</th>

                    </tr>
                    </thead>
                    <tbody>


                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{implode(' , ',$user->roles()->get()->pluck('name')->toArray())}}</td>

                            <td>{{$user->created_at}}</td>
                            <td class="process">{{$user->updated_at}}</td>

                            <td>
                                <div class="table-data-feature">

                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">

                                        <a href="{{route('users.edit',$user->id)}}">
                                        <i class="zmdi zmdi-edit"></i>

                                        </a>
                                    </button>

                                    <form  action="{{route('users.destroy',$user->id)}}" method="post">
                                        @method("DELETE")

                                          @csrf

                                        <button  type="submit" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </form>


                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>



            <div class="float-md-right mb-2 ">
                {{ $users->links() }}
            </div>




        </div>
    </div>




    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Create Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                    <div class="modal-body">


                        @error('name')

                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <span class="badge badge-pill badge-danger">Success</span>
                            {{$message}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        @enderror

                        <div class="card">
                            <div class="card-header"><i class="fas fa-user-plus " style="color: limegreen"></i>  User Form</div>
                            <div class="card-body card-block">
                                <form action="{{route('users.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" id="username" name="name" placeholder=" Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
                                            <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                                        </div>
                                    </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label"><strong class="text-capitalize text-black-50 text--accent-2">Select Roles</strong></label>
                                    </div>

                                    @foreach($roles as $role)
                                    <div class="col col-md-9">
                                        <div class="form-check-inline form-check">
                                            <label for="inline-checkbox1" class="form-check-label ">
                                                <input type="checkbox" id="inline-checkbox1"  name="roles[]" value="{{$role->id}}" class="form-check-input">{{$role->name}}
                                            </label>

                                        </div>
                                    </div>
                                        @endforeach
                                </div>




                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label"><strong class="text-capitalize text-black-50 text--accent-2">Select Permissions</strong></label>
                                    </div>

                                    @foreach($permissions as $permission)
                                        <div class="col col-md-9">
                                            <div class="form-check-inline form-check">
                                                <label for="inline-checkbox1" class="form-check-label ">
                                                    <input type="checkbox" id="inline-checkbox1"  name="permissions[]" value="{{$permission->id}}" class="form-check-input">{{$permission->name}}
                                                </label>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>





                                <div class="card-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                </div>


                                </form>
                                    </div>
                                </div>




                            </div>
                        </div>








                    </div>


            </div>




@endsection
