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
                         <table class="table shopping-summery text-center clean order_review">
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
                            @foreach(Auth::user()->carts->groupBy('seller_id') as $sellerId => $carts)
                            @if(!$loop->first)
                                <tr class="bg-light"><td colspan="6"></td></tr>
                            @endif
                                <tr>
                                    <td colspan="6">
                                        <a class="d-flex gap-2 mt-2 mb-2 align-items-center ms-lg-4"
                                            href="{{route('shop', ['seller_id' => $sellerId])}}">
                                            <div class="rounded-circle img-thumbnail"
                                                style="width: 50px; height: 50px; overflow: hidden; background-size: cover; background-position: center; background-image: url('{{$carts[0]->product->user->profile_photo_path ?? asset('assets/imgs/user.png')}}')">
                                            </div>
                                            <h4 class="">{{$carts[0]->product->user->name}}</h4>
                                        </a>
                                    </td>
                                </tr>
                            
                                @foreach($carts as $item)
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
                                @endforeach
                            </tbody>
                        </table>
                                <div class="d-flex align-items-end"><a href="#" class="text-danger ms-auto" wire:click.prevent="clearAll()">Xóa tất cả sản phẩm</a></div>
                            @else
                                <div class="alert alert-warning">Chưa có sản phẩm trong giỏ hàng</div>
                            @endif
                        </div>
                        @if(Auth::user()->carts->count()>0)
                        <div class="d-flex gap-2 align-items-center">
                            <div class="cart-action text-end">
                                <a href="{{route('user.checkout')}}" class="btn "> <i class="fi-rs-box-alt mr-10"></i>Mua hàng</a>
                            </div>
                            
                            <p class="ms-auto">
                                Tổng tiền các sản phẩm: 
                                <strong><span class="font-xl fw-900 text-brand">{{
                                                            number_format(intval(str_replace(',', '',Auth::user()->carts->sum(function($cart) {
                                                            return $cart->quantity * $cart->product->regular_price;
                                                        }))))}} VND</span></strong>
                            </p>
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
