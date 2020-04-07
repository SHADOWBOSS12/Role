@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row"><
        <form action="{{route('permissions.update',$permission->id)}}"  method="post">
            @csrf
            @method('PATCH')



     <div class="col-lg-12">
<div class="form-group">

<label>Name</label>
    <input  class="form-control-lg" type="text"  name="permission" value="{{$permission->name}}" >

</div>
   <div class="form-group">
       <button type="submit" class="btn btn-success">Update</button>


   </div>

     </div>



        </form>



</div>
    </div>



    @endsection
