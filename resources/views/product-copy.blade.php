@extends('layouts.app')

@section('Digital Shop - Product', 'Page Title')

@section('content')
<div class="container">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.1/vue-resource.min.js">
        
    </script>
    <form v-on:submit.prevent="handleIt">
    <div class="well well-sm">
        <div class="form-group">
            <div class="input-group input-group-md">
                <div class="icon-addon addon-md">
                    <input type="text" id="inputsearch" placeholder="Search Product..." class="form-control" v-model="query" >
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" >Search!</button>
                    <!--type="button" click="search()"  -->
                </span>
            </div>
        </div>
    </div>
    </form>
    <div class="container">
        <products list=" {{ $products }}"></products>
    </div>

    <div class="row">
        <div class="col-md-12">
                @foreach ($products as $product)
 
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail" >
                            <img src="{{$product->image}}" class="img-responsive">
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <h3>{{$product->title}}</h3>
                                    </div>
                                    <div class="col-md-6 col-xs-6 price">
                                        <h3>
                                            <label>${{$product->price}}</label></h3>
                                    </div>
                                </div>
                                <p>{{$product->description}}</p>
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="/addProduct/{{$product->id}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> Buy</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
    <script type="text/javascript">
        Vue.component('product',{
            props: ['list'],

            created() {
                this.list = JSON.parse(this.list);
            }
        });
        new Vue({
            el: 'body',
            methods: {
                handleIt: function(e) {
                    alert('test');
                    e.preventDefault();
                }
            }
        });
    </script>
</div>
@endsection
