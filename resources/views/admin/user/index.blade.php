@extends('layouts.app')

@section('title','Digital Shop - List Admin Users')
@section('description','e-Shop Admin Users Page')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Admin Users Page</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
                </thead>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}<!-- {{ $user->created_at->format('F d, Y h:ia') }} --></td>
                        <td><a href="{{ url('/admin/users') }}/{{$user->id}}"><button class="btn btn-danger">Edit</button></a></td>
                        <td><a href="/admin/user/destroy/{{$user->id}}" 
                                onclick="return confirm('Want to delete?');"><button class="btn btn-danger">Del</button></a> </td>
                    </tr>
                 @endforeach
 
            </table>
        </div>
    </div>
</div>
@endsection
