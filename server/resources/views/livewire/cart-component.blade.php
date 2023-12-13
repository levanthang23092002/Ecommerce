<div>
@livewireStyles
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang Chủ</a>
                    <span></span> Mua Sắm
                    <span></span> Giỏ Hàng
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                        @if(Session::has('success_message'))
                            <div class="alert alert-success">
                                <strong>{{Session::get('success_message')}}</strong>
                            </div>
                         @endif
                         @if(Session::has('error_message'))
                            <div class="alert alert-danger">
                                <strong>{{Session::get('error_message')}}</strong>
                            </div>
                         @endif
                         @if(Auth::user()->carts->count()>0)
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
                                    @foreach(Auth::user()->carts as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{ asset('assets/imgs/products/products')}}/{{$item->product->image}}" alt="#"></td>
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="{{route('product.details',['slug'=>$item->product->slug])}}">{{$item->product->name}}</a></h5>
                                            <!-- <p class="font-xs">Maboriosam in a tonto nesciung eget<br> distingy magndapibus.
                                            </p> -->
                                        </td> 
                                        <td class="price" data-title="Price"><span>{{number_format(intval(str_replace(',', '',$item->product->regular_price)))}} VND</span></td>
                                        <td class="text-center" data-title="Stock">
                                        <div class="border radius m-auto" style="max-width: 80px;padding: 9px 20px;position: relative;width: 100%; border-radius: 4px;">
                                            <a href="#" class="qty-down" style="bottom:0;font-size: 16px;position: absolute;right: 8px;color: #707070;" wire:click.prevent="decrementQuantity({{$item->id}})">
                                                <i class="fi-rs-angle-small-down"></i>
                                            </a>
                                            <span class="qty-val">{{$item->quantity}}</span>
                                            <a href="#" class="qty-up" style="top:0;font-size: 16px;position: absolute;right: 8px;color: #707070;" wire:click.prevent="incrementQuantity({{$item->id}})">
                                                <i class="fi-rs-angle-small-up"></i>
                                            </a>
                                        </div>
                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <span>{{number_format(intval(str_replace(',', '',$item->quantity * $item->product->regular_price)))}} VND </span>
                                        </td>
                                        <td class="action" data-title="Remove" ><a href="#" class="text-muted" wire:click.prevent="destroy('{{$item->id}}')"><i class="fi-rs-trash"></i></a></td>
                                    </tr>   
                                    @endforeach
                                   
                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <a href="#" class="text-muted" wire:click.prevent="clearAll()">  Xóa tất cả</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @else
                                <p>Chưa có sản phẩm trong giỏ hàng</p>
                            @endif
                        </div>
                        <div class="cart-action text-end">
                         
                            <a class="btn " href="{{route('home.index')}}"><i class="fi-rs-shopping-bag mr-10"></i>Tiếp Tục Mua sắm</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                        @if(Auth::user()->carts->count()>0)
                            <div class="col-lg-6 col-md-12" style="margin-left:25%">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Tổng số giỏ hàng</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Tổng tiền</td>
                                                    <td class="cart_total_amount">{{number_format(intval(str_replace(',', '',Auth::user()->carts->sum(function($cart) {
                                                        return $cart->quantity * $cart->product->regular_price;
                                                    }))))}} VND</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Thuế</td>
                                                    <td class="cart_total_amount">{{number_format(intval(str_replace(',', '',Cart::tax())) )}} VND</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Vận chuyển</td>
                                                    <td class="cart_total_amount">30,000 VND</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Thành tiền</td>

                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">{{
                                                        number_format(intval(str_replace(',', '',Auth::user()->carts->sum(function($cart) {
                                                        return $cart->quantity * $cart->product->regular_price;
                                                    }))) +30000)}} VND</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{route('user.checkout')}}" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Thanh Toán</a>
                                </div>
                            </div>
                        
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @livewireScripts
</div>
