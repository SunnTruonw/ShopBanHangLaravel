<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\Models\SanPham;
use App\Models\KhachHang;
use Illuminate\Support\Facades\DB;
use App\Models\GioHang;
use App\Jobs\SendMail;


class CartService{
    
    public function create($request)
    {
       $qty = (int)$request->input('num-product'); //1, dem bao nhieu san pham
       $product_id = (int)$request->input('product_id');// id= 53


       if($qty <= 0 || $product_id <= 0){
           $request->session()->flash('error', 'Số lượng hoặc Sản phẩm không chính xác');

           return false;
       }

       $carts = Session::get('carts');
       
       if(is_null($carts)){
           Session::put('carts', [
               $product_id => $qty // 53 => 1
           ]);

           return true;
       }

       
       $exists = Arr::exists($carts, $product_id);
       if($exists){
            $carts[$product_id] = $carts[$product_id] + $qty;//$carts[53] 
            Session::put('carts', $carts);
            return true;
       }
       



       $carts[$product_id] =$qty;
       Session::put('carts', $carts);

        return true;    
    }

    public function getProduct()
    {
       $carts = Session::get('carts');
        if(is_null($carts)){
            return [];
        }

        $productId = array_keys($carts);


        return SanPham::select('id', 'name' , 'price' ,'price_sale' , 'thumb')
            ->where('active', 1)
            ->whereIn('id' , $productId)
            ->get();

    }

    public function update($request)
    {
        Session::put('carts',$request->input('num_product'));

        return true;
    }

    public function remove($id)
    {
        $carts = Session::get('carts');

        unset($carts[$id]);

        Session::put('carts',$carts);

        return true;

    }

    public function addCart($request)
    {
        try {
            DB::beginTransaction();

            

            $carts = Session::get('carts');

            
            if (is_null($carts)) return false;

            $khachhang = KhachHang::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'content' => $request->input('content')
            ]);

            $this->infoProductCart($carts, $khachhang->id);

            DB::commit();
            Session::flash('success', 'Đặt Hàng Thành Công');

            // #Queue
            // SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));
            
            Session::forget('carts');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }

        return true;
    }

    protected function infoProductCart($carts, $khach_hang_id)
    {
        $productId = array_keys($carts);
        $products = SanPham::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'khach_hang_id' => $khach_hang_id,
                'product_id' => $product->id,
                'pty'   => $carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price
            ];
        }

        return GioHang::insert($data);
    }

    public function getCustomer()
    {
        return KhachHang::orderByDesc('id')->paginate(15);
    }

    public function getProductForCart($customer)
    {
        return $customer->gio_hangs()->with(['product' => function($query){
            $query->select('id' , 'name' , 'thumb');
        }])->get();
    }

    public function delete($request)
    {
        $cart = KhachHang::where('id' , $request->input('id'))->first();
        if($cart){
            $cart->delete();
            return true;
        }

        return false;
    }
}