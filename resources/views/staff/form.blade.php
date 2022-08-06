@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $err )
            {{$err}}<br>
        @endforeach
    </div>
@endif

<style>
    .invalid{
        border:1px solid red;
    }
    .row{
         margin-top: 4px;
    }
</style>

<form method="post" action="/staff/store" enctype="multipart/form-data"> <!--enctype="multipart/form-data" penting untk upload file klu tak takbole upload file -->
    <input type="hidden" name="staff_id" value="{{$staff->staff_id}}"><!--Kalau edit dgn create guna yg sama kena ada ni-->
    @csrf
    <div class="row">
        <div class="col-md-2">User ID</div>
        <div class="col-md-10">
            <input value="{{$staff->username}}" type="text" name="username" class="form-control @error('username') invalid @enderror">
            @error ('username') <span class="text-danger"> {{$message}} </span> @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">First name</div>
        <div class="col-md-10">
         <input value="{{$staff->first_name}}" type="text" name="first_name" class="form-control @error ('first_name') invalid @enderror">
         @error ('first_name') <span class="text-danger"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">Last name</div>
        <div class="col-md-10">
         <input value="{{$staff->last_name}}" type="text" name="last_name" class="form-control @error ('last_name') invalid @enderror">
         @error ('last_name') <span class="text-danger"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">Email</div>
        <div class="col-md-10">
         <input value="{{$staff->email}}" type="text" name="email" class="form-control @error ('email') invalid @enderror">
         @error ('email') <span class="text-danger"> {{$message}} </span> @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">Password</div>
        <div class="col-md-10">
         <input value="{{$staff->password}}"  type="password" name="password" class="form-control @error ('password') invalid @enderror">
         @error ('password') <span class="text-danger"> {{$message}} </span> @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">Store</div>
        <div class="col-md-10">

         <select class="form-control" name="store_id">
            <option value="">--Sila Pilih--</option>
            @foreach ($stores as $store)
                <option value="{{$store->store_id}}" @if ($staff->store_id==$store->store_id) selected @endif >
                     Store {{$store->store_id}}
                </option>
            @endforeach
         </select>

         @error('store_id')
             <span class="text-danger">{{$message}}</span>
         @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"> Status </div>
        <div class="col-md-10">
            <input type="radio" name="active" @if ($staff->active==1) checked @endif value="1">Active<br>
            <input type="radio" name="active" @if ($staff->active==0) checked @endif value="0">Not Active<br>
        </div>
    </div>


    <div class="row">
        <div class="col-md-2"> Picture  </div>
        <div class="col-md-10">
            <input type="file" name="picture" class="form-control">
            @if($staff->photo)
                <img src='/staff/image?location={{$staff->photo}}' >
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"> Roles  </div>
        <div class="col-md-10" id="cb">
            @php
                $current_roles= \DB::table('model_has_roles')->where('model_id', $staff->staff_id)->pluck('role_id')->toArray();
            @endphp
            @foreach (\Spatie\Permission\Models\Role::all()->pluck('name','id') as $id=> $name)
                <input type="checkbox" name="role[]" value="{{$id}}" @if (in_array($id,$current_roles)) checked
                 @endif>{{$name}} <br>
            @endforeach
        </div>
    </div>


    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
         <input type="submit" class="btn btn-primary" value="Save">
        </div>
    </div>
</form>

<script>
    $('form').submit(function(){
    //console.log('bil checked..',$('#cb input:checked').length)
    if ($('#cb input:checked').length == 0) {
        alert('Please select at least one role');
        return false;
    }
    });
</script>
@endsection
