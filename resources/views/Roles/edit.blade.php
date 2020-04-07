@extends('layouts.app')



@section('content')


    <div class="container">



        @error('name')
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-danger">Fail  To Assign</span>
            {{$message." Try Assigning Role Again"}}
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

            <button type="button" class="btn btn-outline-danger mb-1">

                <a href="{{route('roles.index')}}">
                    <i class="fas fa-step-backward"></i> Back
                </a>
            </button>

        </div>


        <h1>Assign Permissions For {{$role->name}}</h1>


        <form action="{{route('roles.update',$role->id)}}" method="post">
            @method("PATCH")
            @csrf
            <div class="col-md-12">


                @error('name')

                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Success</span>
                    {{$message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                @enderror



            </div>
            <div class="modal-footer">

                <div class="col-md-6">
                    <h3>Assign Permissions For {{$role->name}}</h3>

                </div>



                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label" ><strong>Select Permission</strong></label>
                    </div>


                    @foreach($permissions as $permission)
                        <div class="col col-md-9">
                            <div class="form-check">
                                <div class="checkbox">
                                    <label for="checkbox1" class="form-check-label ">
                                        <input type="checkbox" id="checkbox1" name="permissions[]" value="{{$permission->id}}" class="form-check-input"
                                               @if($role->permissions->pluck('id')->contains($permission->id)) checked @endif

                                        >{{$permission->name}}
                                    </label>
                                </div>

                            </div>
                        </div>

                    @endforeach
                </div>



            </div>





            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="{{route('roles.index')}}">  Cancel</a></button>
                <button class="btn btn-warning"> <i class="fas fa-chess-queen"></i>  Assign</button>
            </div>
        </form>


    </div>

@endsection
