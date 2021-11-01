<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use App\Models\KhachHang;

class CartController extends Controller
{
    protected $carts;

    public function __construct(CartService $carts)
    {
        $this->carts = $carts;
    }

    public function index()
    {
        return view('admin.carts.customer',[
            'title' => 'Danh Sách Đơn Hàng',
            'customers' => $this->carts->getCustomer()
        ]);
    }

    public function show(KhachHang $customer)
    {
        $carts = $this->carts->getProductForCart($customer);
        return view('admin.carts.detail' ,[
            'title' => 'Chi Tiết Đơn Hàng :' .$customer->name,
            'customer' => $customer,
            'carts' => $carts
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this ->carts->delete($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa Thành Công Sản Phẩm'
            ]);
        }
        
        return response()->json(['error' =>true]);
    }
}
