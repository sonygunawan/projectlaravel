@extends('layouts.app')

@section('title','Digital Shop - List Admin Order')
@section('description','e-Shop Admin Order Page')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Admin Orders Page</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-sm-2">UserName</th>
                    <th class="col-sm-2">OrderId</th>
                    <th class="col-sm-4">Date</th>
                    <th class="col-sm-2"></th>
                    <th>Action</th>
                </tr>
                </thead>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->id}}</td>
                        <td><a href="{{ url('/order') }}/{{$order->id}}"> {{$order->created_at}}</a></td>
                        <td><a href="{{ url('/order') }}/{{$order->id}}"><i class="fa fa-search-plus"></i></a></td>
                        <td><a href="/admin/orders/destroy/{{$order->id}}" 
                                onclick="return confirm('Want to delete?');"><button class="btn btn-danger">Del</button></a> </td>
                    </tr>
                @endforeach
 
            </table>
        </div>
    </div>
</div>
@endsection
