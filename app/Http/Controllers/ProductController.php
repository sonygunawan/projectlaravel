<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
    	$posts = Product::all();

		return view('product',['products' => $posts]);
        // $products = Product::all();
        // return view('product',['products' => $products]);
 
    }
    public function search(Request $request)
    {
        //$inputsearch = $request->get('inputsearch');
        //$products1 = Product::where('title', $inputsearch)->get();
        //return view('products')->with('products', $products1);

        //return $inputsearch'
        //return view('product', with('inputsearch', 'required|between:3,255'));
        //return redirect('/cart');
        // if ($request->isMethod('post')){    
        //     return response()->json(['response' => 'This is post method']); 
        // }

        // return response()->json(['response' => 'This is get method']);
        //return view('product', ['products' => Product::all()]);
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Making sure the user entered a keyword.
        if($request->has('q')) {

            // Using the Laravel Scout syntax to search the products table.
            //$posts = Product::search($request->get('q'))->get();
            //$strProd = $request->get('q');
            $posts = Product::where('title','like', '%'. $request->get('q'). '%')
            	->orWhere('description', 'like', '%' .$request->get('q'). '%')->get();

            // If there are results return them, if none, return the error message.
            return $posts->count() ? $posts : $error;

        }
        else
        {
			$posts = Product::all()->get();

            // If there are results return them, if none, return the error message.
            return $posts->count() ? $posts : $error;
        }


        // Return the error message if no keywords existed
        return $error;
    }
}
