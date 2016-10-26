@extends('layouts.app')

@section('Digital Shop - List Order', 'Page Title')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Your past orders</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-sm-2">Id</th>
                    <th class="col-sm-4">Date</th>
                    <th class="col-sm-2"></th>
                </tr>
                </thead>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td><a href="{{ url('/order') }}/{{$order->id}}"> {{$order->created_at}}</a></td>
                        <td><a href="{{ url('/order') }}/{{$order->id}}"><i class="fa fa-search-plus"></i></a></td>
                    </tr>
                @endforeach
 
            </table>
        </div>
    </div>
</div>
@endsection
