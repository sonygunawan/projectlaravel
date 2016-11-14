@extends('layouts.app')

@section('title','Digital Shop - Home')
@section('description','e-Shop Home Page')

@section('content')
<style type="text/css">
    .topspace{
    margin:0 auto;max-width:605px;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ url('js/sliderengine/amazingslider-1.css') }}">
<div class="container">
        <div class="row space">
        <div class="col-md-12">
    <!-- Insert to your webpage where you want to display the slider -->
    <div id="amazingslider-1" style="display:block;position:relative;margin:16px auto 56px;">
        <ul class="amazingslider-slides" style="display:none;">
                <li><img src="images/monochrome2.jpg" alt="monochrome2"  title="monochrome2" />
                </li>
                <li><img src="images/ombrecase.jpg" alt="ombrecase"  title="ombrecase" />
                </li>
                <li><img src="images/ombrejellycase.jpg" alt="ombrejellycase"  title="ombrejellycase" />
                </li>
            </ul>
            <ul class="amazingslider-thumbnails" style="display:none;">
                <li><img src="images/monochrome2-tn.jpg" alt="monochrome2" title="monochrome2" /></li>
                <li><img src="images/ombrecase-tn.jpg" alt="ombrecase" title="ombrecase" /></li>
                <li><img src="images/ombrejellycase-tn.jpg" alt="ombrejellycase" title="ombrejellycase" /></li>
            </ul>
    </div>
    <!-- End of body section HTML codes -->
    </div>
    </div>
    </div>
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
                    <button class="btn btn-default" type="button" @click="handleIt(page)" v-if="!loading">Search!</button>
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
            <nav>
                <ul class="pagination">
                    <li v-if="currentPage > 1">
                        <a href="#" aria-label="Previous"
                           @click="setPage(currentPage - 1)">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li v-for="page in totalPages"
                        v-bind:class="[ page == isActived ? 'active' : '']">
                        <a href="#"
                           @click="setPage(page)">@{{ page +1 }}</a>
                    </li>
                    <li v-if="currentPage < totalPages">
                        <a href="#" aria-label="Next"
                           @click="setPage(currentPage + 1)">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
                <!-- foreach ($products as $product) -->
 
                    <div class="col-sm-6 col-md-4" v-for="product in products | filterBy query in 'title' 'description' | paginate">
                        <div class="thumbnail" >
                            <img src="" class="img-responsive">
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <a href="/product/@{{ product.slug }}">
                                        <h3>@{{ product.title }}</h3>
                                        </a>
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
    <ul>
    <!-- <li v-for="pageNumber in totalPages">
      <a href="#" @click="setPage(pageNumber)" >@{{ pageNumber+1 }}</a>
    </li>
</ul> -->
     <div class="row">
        <nav>
                <ul class="pagination">
                    <li v-if="currentPage > 1">
                        <a href="#" aria-label="Previous"
                           @click="setPage(currentPage - 1)">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li v-for="page in totalPages"
                        v-bind:class="[ page == isActived ? 'active' : '']">
                        <a href="#"
                           @click="setPage(page)">@{{ page +1 }}</a>
                    </li>
                    <li v-if="currentPage < totalPages">
                        <a href="#" aria-label="Next"
                           @click="setPage(currentPage + 1)">
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
                alert('created');
            }

        });

        new Vue({
            el: 'body',
            data: 
                {
                    pagination: {
                        total: 0,
                        per_page: 10,
                        from: 1,
                        to: 0,
                        current_page: 1
                    },
                    offset: 4,// left and right padding from the pagination <span>,just change it to see effects
                    products: [],
                    loading: false,
                    error: false,
                    query: '',
                    currentPage: 0,
                    itemsPerPage: 10,
                    resultCount: 0
                },
            ready: function () {
                
                //this.handleIt(this.pagination.current_page);
                this.initiateProduct();
                //alert('ready');
            },
            computed: {
                isActived: function () {
                    return this.currentPage;
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

                },
                totalPages: function() {
                  console.log(Math.ceil(this.resultCount / this.itemsPerPage) + " totalPages");
                  return Math.ceil(this.resultCount / this.itemsPerPage);

                }
            },
            methods: {
                initiateProduct: function() {
                    this.$http.get('/api/products3').then((response) => {
                            this.products = response.data.data;
                            //this.pagination = response.data.pagination;
                        });
                },
                handleIt: function(page) {

                    //alert('page='+JSON.stringify(data));
                    //alert('query='+this.query);
                    //alert('page='+this.page);
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
                        this.$http.get('/api/products2?page='+page).then((response) => {
                            
                            // If there was an error set the error message, if not fill the products array.
                            //response.body.error ? this.error = response.body.error : this.products = response.body;
                            this.products = response.data.data.data;
                            this.pagination = response.data.pagination;
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
                        //alert(JSON.stringify(data));
                        this.$http.get('/api/products2?page='+page, data).then(function (response) {
                            this.products = response.data.data.data;
                            this.pagination = response.data.pagination;
                            //look into the routes file and format your response
                            //this.$set('products', response.data.data.data);
                            //this.$set('pagination', response.data.pagination);
                            this.loading = false;
                        }, function (error) {
                            // handle error
                        });
                        //alert(JSON.stringify(this.pagination));
                        //alert(false);
                        //alert(this.products);
                    }
                    
                    
                     //alert('test');
                    // e.preventDefault();
                },
                changePage: function (page) {
                    this.pagination.current_page = page;
                    this.handleIt(page);
                },
                setPage: function(pageNumber) {
                  this.currentPage = pageNumber;
                  console.log(pageNumber);

                }
            },
            filters: {
              paginate: function(list) {
                    this.resultCount = list.length;
                    if (this.currentPage >= this.totalPages) {
                      this.currentPage = Math.max(0, this.totalPages - 1);
                    }
                    var index = this.currentPage * this.itemsPerPage;

                    return list.slice(index, index + this.itemsPerPage);
                }
            } 
        });

   
    </script>
    <script src="{{ url('js/sliderengine/jquery.js') }}"></script>
    <script src="http://uguru-realestate-us-jun202013.businesscatalyst.com/3d-slider/sliderengine/amazingslider.js"></script>
    <!-- <script src="{{ url('js/sliderengine/amazingslider.js') }}"></script> -->
    <script src="{{ url('js/sliderengine/initslider-1.js') }}"></script>
</div>
@endsection
