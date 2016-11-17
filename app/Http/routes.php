<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('product');
});
Route::get('eloquent', function() {

        return View::make('eloquent')

            // all the bears (will also return the fish, trees, and picnics that belong to them)
            ->with('bears', App\Bear::all());

    });
Route::auth();

//Route::get('/home', 'HomeController@index');
Route::get('/home', 'ProductController@index');
Route::get('/product', 'ProductController@index');
Route::get('/product/{productSlug}', 'ProductController@ViewDetail');

Route::get('/addProduct/{productId}', 'CartController@addItem');
Route::get('/removeItem/{productId}', 'CartController@removeItem');
Route::get('/cart', 'CartController@showCart');

Route::post('/checkout', 'OrderController@checkout');
 
Route::get('order/{orderId}', 'OrderController@viewOrder');
Route::get('order', 'OrderController@index');
Route::get('download/{orderId}/{filename}', 'OrderController@download');

Route::get('api/products2', function(){
 	//return App\Product::all();
    // if ($request->get('q') != '')
    // {
    //     $results = App\Product::where('title','like', '%'. $request->get('q'). '%')
    //              ->orWhere('description', 'like', '%' .$request->get('q'). '%')->paginate(10);
    //     // $posts = Product::where('title','like', '%'. $request->get('q'). '%')
    //     //         ->orWhere('description', 'like', '%' .$request->get('q'). '%')->get();
    // }
    // else
    // {
     	$results =  App\Product::latest()->paginate(10);
    //}

    $response = [
        'pagination' => [
            'total' => $results->total(),
            'per_page' => $results->perPage(),
            'current_page' => $results->currentPage(),
            'last_page' => $results->lastPage(),
            'from' => $results->firstItem(),
            'to' => $results->lastItem()
        ],
        'data' => $results
    ];
    
    return $response;
});

Route::get('api/products3', function(){
 	$results = App\Product::all();
 	$response = [
        'data' => $results
    ];
    
    return $response;
});
Route::get('api/products', 'ProductController@search');

Route::get('admin/orders', 'OrderAdminController@index');
Route::get('/admin/product/new', 'ProductAdminController@newProduct');
Route::get('/admin/products', 'ProductAdminController@index');
Route::get('/admin/product/destroy/{id}', 'ProductAdminController@destroy');
Route::post('/admin/product/save', 'ProductAdminController@add');

Route::get('admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::controller('/user', 'Auth\AuthController');