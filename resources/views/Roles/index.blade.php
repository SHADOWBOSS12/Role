@extends('layouts.master')

@section('content')

    <div class="row m-t-30">



        <div class="col-md-12">
            <!-- DATA TABLE-->


            @error('name')
            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Fail  To create</span>
                {{$message."try Creating Role Again"}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>@enderror

            @if(session('success'))

                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>

                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                @endif




            <div class="float-md-right mb-2 ">

                <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#largeModal">
                       <i class="fas fa-chess-king"></i> Create Roles
                </button>

            </div>

            <div class="table-responsive m-b-40 clearfix">
                <table class="table table-borderless table-data3">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{implode(' , ',$role->permissions()->get()->pluck('name')->toArray())}}</td>
                        <td class="process">{{$role->created_at}}</td>
                        <td>{{$role->updated_at}}</td>
                        <td>
                            <div class="table-data-feature">

                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">

                                    <a href="{{route('roles.edit',$role->id)}}">
                                        <i class="zmdi zmdi-edit"></i>

                                    </a>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>

                            </div>
                        </td>

                    </tr>

                        @endforeach
                              </tbody>
                </table>
            </div>

            <div class="float-md-right mb-2 ">
        {{ $roles->links() }}
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>






    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Create Roles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('roles.store')}}" method="post">
                    @csrf
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


                        <div class="row form-group">
                            <div class="col col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-chess-king"></i>
                                    </div>
                                    <input type="text" id="input1-group1" name="name" placeholder="Enter Role Name" class="form-control @error('email') is-invalid @enderror ">
                                </div>
                            </div>
                        </div>








                   </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success"> <i class="fas fa-chess-king"></i>  Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal large -->






   <!--maek the modal to show using javascript later->






@endsection
