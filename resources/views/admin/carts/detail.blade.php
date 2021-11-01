@extends('admin.main')


@section('content')
<div class="customer mt-3">

    <ul>
        <li>Tên Khách Hàng :<strong>{{ $customer ->name}}</strong></li>
        <li>Số Điện Thoại :<strong>{{ $customer ->phone}}</strong></li>
        <li>Địa chỉ :<strong>{{ $customer ->address}}</strong></li>
        <li>Email :<strong>{{ $customer ->email}}</strong></li>
        <li>Ghi chú :<strong>{{ $customer ->content}}</strong></li>
    </ul>
</div>

<div class="cart mt-3">
                        @php
                            $total = 0;
                        @endphp
                        <table class="table" >
                            <tbody>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>&nbsp;</th>
                                </tr>
                        @foreach ($carts as $key => $cart)
                            @php
                                
                                $priceEnd = $cart->price * $cart->pty;
                                $total += $priceEnd;
                            @endphp
                            <tr>
                                <td>
                                    <div">
                                        <img src="{{$cart->product ->thumb}}" alt="{{ $cart->product->name}}" width="100px">
                                    </div>
                                </td>
                                <td>{{ $cart->product ->name }}</td>
                                <td>$ {{ number_format($cart->price, 0 , '', '.')}}</td>
                                <td>{{ $cart ->pty }}</td>
                               
                                <td>$ {{ number_format($priceEnd , 0 , '' ,'.')}}</td>
                                
                            </tr>

                        @endforeach    
                        </tbody>
                        <td colspan="4" class="text-right">Tổng Tiền :</td>
                        <td>${{ number_format($total , 0 , '' ,'.') }}</td>

                    </table>
</div>
@endsection