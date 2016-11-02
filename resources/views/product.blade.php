@extends('layouts.app')

@section('Digital Shop - Product', 'Page Title')

@section('content')
<div class="container">
    <!-- 
    <form v-on:submit.prevent="handleIt(page)"> -->
    <div class="well well-sm">
        <div class="form-group">
            <div class="input-group input-group-md">
                <div class="icon-addon addon-md">
                    <input type="text" placeholder="Search Product..." class="form-control" v-model="query" >
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" @click="handleIt()" v-if="!loading">Search!</button>
                    <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Searching...</button>
                    <!--type="button" click="search()"  -->
                </span>
            </div>
        </div>
    </div>
    <!-- </form> -->
    <div class="container">
        <products list="$products"></products>
    </div>

    <div class="row">
        <div class="col-md-12" >
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
    <div class="row">
        <nav>
                <ul class="pagination">
                    <li v-if="pagination.current_page > 1">
                        <a href="#" aria-label="Previous"
                           @click="changePage(pagination.current_page - 1)">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li v-for="page in pagesNumber"
                        v-bind:class="[ page == isActived ? 'active' : '']">
                        <a href="#"
                           @click="changePage(page)">@{{ page }}</a>
                    </li>
                    <li v-if="pagination.current_page < pagination.last_page">
                        <a href="#" aria-label="Next"
                           @click="changePage(pagination.current_page + 1)">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js"></script>
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
                    pagination: {
                        
                    },
                    offset: 4,// left and right padding from the pagination <span>,just change it to see effects
                    products: [],
                    loading: false,
                    error: false,
                    query: ''
                },
            ready: function () {
                //this.handleIt(this.pagination.current_page)
                this.handleIt(this.pagination.current_page);
            },
            computed: {
                isActived: function () {
                    return this.pagination.current_page;
                },
                pagesNumber: function () {
                    if (!this.pagination.to) {
                        return [];
                    }
                    var from = this.pagination.current_page - this.offset;
                    if (from < 1) {
                        from = 1;
                    }
                    var to = from + (this.offset * 2);
                    if (to >= this.pagination.last_page) {
                        to = this.pagination.last_page;
                    }
                    var pagesArray = [];
                    while (from <= to) {
                        pagesArray.push(from);
                        from++;
                    }
//alert(pagesArray);
                    return pagesArray;

                }
            },
            methods: {
                handleIt: function(page) {

                    //alert('page='+JSON.stringify(data));
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
                            //this.query = '';
                            //alert(this.products);

                        });
                        //alert(true);
                    }
                    else
                    {

                        var data = {page: page};
                        alert(data);
                        this.$http.get('/api/products2', data).then(function (response) {
                            //this.products = response.data.data.data;
                            //this.pagination = response.data.pagination;
                            //look into the routes file and format your response
                            this.$set('products', response.data.data.data);
                            this.$set('pagination', response.data.pagination);
                            this.loading = false;
                        }, function (error) {
                            // handle error
                        });
                        //alert(JSON.stringify(this.pagination));
                        //alert(false);
                        //alert(this.products);
                    }
                    
                    
                    // alert('test');
                    // e.preventDefault();
                },
                changePage: function (page) {
                    this.pagination.current_page = page;
                    this.handleIt(page);
                }   
            },
            
        });

   
    </script>
</div>
@endsection
