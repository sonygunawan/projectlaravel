@extends('layouts.app')

@section('Digital Shop - New Product', 'Page Title')

@section('content')
 <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="/admin/product/new"><button class="btn btn-success">New Product</button></a>
            </div>
        </div>
        <div class="row">   
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <td>Name</td>
                    <td>Price</td>
                    <!-- <td>File</td> -->
                    <td>Action</td>
                    <td></td>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->title}}</td>
                            <td>{{$product->price}}$</td>
                            
                            <td><a href="/admin/product/destroy/{{$product->id}}" 
                                onclick="return confirm('Want to delete?');"><button class="btn btn-danger">Del</button></a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
