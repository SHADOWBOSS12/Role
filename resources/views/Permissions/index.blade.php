@extends('layouts.master')

@section('content')

    <div class="row m-t-30">



        <div class="col-md-12">
            <!-- DATA TABLE-->
            @error('name')
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Fail  To create</span>
                {{$message."try Creating Permission Again"}}
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

                <button type="button" class="btn btn-outline-danger mb-1" data-toggle="modal" data-target="#largeModal">
                    <i class="fas fa-chess-queen"></i> Create Permissions
                </button>

            </div>

            <div class="table-responsive m-b-40 clearfix">
                <table class="table table-borderless table-data3">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>created_At</th>
                        <th>Updated_at</th>
                        <th>Actions</th>

                    </tr>
                    </thead>
                    <tbody>


                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{$permission->id}}</td>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->created_at}}</td>
                        <td class="process">{{$permission->updated_at}}</td>

                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                    <i class="zmdi zmdi-mail-send"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">

                                    <a href="{{route('permissions.edit',$permission->id)}}">
                                    <i class="zmdi zmdi-edit"></i>

                                    </a>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">

                                    <a href="{{route('permissions.destroy',$permission->id)}}">
                                    <i class="zmdi zmdi-delete"></i>

                                    </a>
                                </button>

                            </div>
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="float-md-right mb-2 ">
                {{ $permissions->links() }}
            </div>

            <!-- END DATA TABLE-->
        </div>
    </div>






    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Create Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('permissions.store')}}" method="post">
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
                                        <i class="fa fa-chess-queen"></i>
                                    </div>
                                    <input type="text" id="input1-group1" name="name" placeholder="Enter Permission name" class="form-control @error('email') is-invalid @enderror ">
                                </div>
                            </div>
                        </div>








                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-warning"> <i class="fas fa-chess-queen"></i>  Create</button>
                    </div>
                </form>



        </div>
    </div>
    <!-- end modal large -->





@endsection
