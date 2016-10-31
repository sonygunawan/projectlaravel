<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product',['products' => $products]);
 
    }
    public function search(Request $request)
    {
        // we will be back to this soon!
        //$inputsearch = $request->input('inputsearch');
        //$inputsearch = 'testttt';
        //$products1 = Product::where('title', $inputsearch)->get();
        //return view('product')->with('products', $products1);
        //return $inputsearch'
        return view('product', with('inputsearch', 'required|between:3,255'));
        //return redirect('/cart');
        // if ($request->isMethod('post')){    
        //     return response()->json(['response' => 'This is post method']); 
        // }

        // return response()->json(['response' => 'This is get method']);
    }
}
