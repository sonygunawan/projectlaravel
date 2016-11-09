<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductAdminController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.products',['products' => $products]);
    }
 
    public function destroy($id){
        Product::destroy($id);
        return redirect('/admin/products');
    }
 
    public function newProduct(){
        return view('admin.new');
    }
 
    public function add() {
 
        $file = Request::file('file');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
 
        $entry = new \App\File();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$extension;
 
        $entry->save();
 
        $product  = new Product();
        $product->file_id=$entry->id;
        $product->title =Request::input('title');
        $product->description =Request::input('description');
        $product->price =Request::input('price');
        $product->image =Request::input('image');
 
        $product->save();
 
        return redirect('/admin/products');
 
    }
}
