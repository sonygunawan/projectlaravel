@extends('layouts.app')

@section('Digital Shop - Product', 'Page Title')

@section('content')
<div class="container">
    
    <form v-on:submit.prevent="handleIt">
    <div class="well well-sm">
        <div class="form-group">
            <div class="input-group input-group-md">
                <div class="icon-addon addon-md">
                    <input type="text" placeholder="Search Product..." class="form-control" v-model="query" >
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
        <products list="$products"></products>
    </div>

    <div class="row">
        <div class="col-md-12">
                <!-- foreach ($products as $product) -->
 
                    <div class="col-sm-6 col-md-4" v-for="product in products">
                        <div class="thumbnail" >
                            <img src="" class="img-responsive">
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <h3>@{{ product.title }}</h3>
                                    </div>
                                    <div class="col-md-6 col-xs-6 price">
                                        <h3>
                                            <label>$@{{ product.price }}</label></h3>
                                    </div>
                                </div>
                                <p>@{{ product.description }}</p>
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="/addProduct/@{{ product.id }}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> Buy</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- endforeach -->
            </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.1/vue-resource.min.js"></script>
            
    <script type="text/javascript">

        Vue.component('product',{
            props: ['products'],

            created() {
                this.products = JSON.parse(this.products);
            }

        });

        new Vue({
            el: 'body',
            data: 
                {
                    products: [],
                    loading: false,
                    error: false,
                    query: ''
                },
            ready: function () {
                this.handleIt()
            },
            methods: {
                handleIt: function(e) {
                    //alert('query='+this.query);
                    // Clear the error message.
                    this.error = '';
                    // Empty the products array so we can fill it with the new products.
                    this.products = [];
                    // Set the loading property to true, this will display the "Searching..." button.
                    this.loading = true;
                    // Making a get request to our API and passing the query to it.
                    //alert(this.query);
                    if(this.query != '')
                    {
                        this.$http.get('/api/products?q=' + this.query).then((response) => {
                            
                            // If there was an error set the error message, if not fill the products array.
                            response.body.error ? this.error = response.body.error : this.products = response.body;
                            // The request is finished, change the loading to false again.
                            this.loading = false;
                            // Clear the query.
                            this.query = '';
                            //alert(this.products);

                        });
                        //alert(true);
                    }
                    else
                    {
                        this.$http.get('/api/products2').then((response) => {
                            
                            // If there was an error set the error message, if not fill the products array.
                            this.products = response.body;
                            // The request is finished, change the loading to false again.
                            this.loading = false;
                            //alert(this.products);

                        });
                        //alert(false);
                    }
                    
                    
                    // alert('test');
                    // e.preventDefault();
                }
            }
        });

   
    </script>
</div>
@endsection
