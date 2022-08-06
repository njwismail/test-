@extends('layouts.app')
@section('content')

<a href="/staff/create" class="btn btn-sm btn-primary">Create New Staff</a>
<form action="/staff/list" method="post">
    @csrf <!-----for security, untuk elakkan hacking injection, KENA LETAK TIAP KALI UNTUK FORM---->

<table class="table table-bordered table-striped table-hover">
 <thead>
    <tr>
        <!--th>No</th--------------------->
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
        <th>City</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
@foreach ( $staffs as $staff )
    <tr>
        <!-----untuk no. tapidia berulang <td>{{--$loop->iteration--}}</td>---->

        <td>{{$staff->first_name}}</td> <!--title adalah column dlm table--->
        <td>{{$staff->last_name}}</td>
        <td>{{$staff->store->address->address}}</td>
        <td>{{$staff->store->address->city->city}}</td>
        <td>
            <a class="btn btn-sm btn-success" href="/staff/edit/{{$staff->staff_id}}">Edit</a>
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" href="/staff/delete/{{$staff->staff_id}}">Delete</a>
        </td>

    </tr>

@endforeach
</tbody>
</table>
{{---$staffs->links()--}}
@endsection
