<?php
 
namespace App\Http\Controllers;
 
use App\OrderItem;
use Illuminate\Http\Request;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cart;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\CartItem;
 
class OrderAdminController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index(){
        $orders = Order::all();
 
        return view('admin.orders.list',['orders'=>$orders]);
    }
 
    public function viewOrder($orderId){
        $order = Order::find($orderId)->first();
        return view('admin.ordersadmin..view',['order'=>$order]);
    }
}
 