<div>
    @if (Auth::user()->carts->count() === 0)
        @php
        redirect()->route('shop', ['seller_id' => 'all']);
        @endphp
    @else
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Trang chủ</a>
                    <span></span> Mua sắm
                    <span></span> Thủ tục thanh toán
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                
                <div class="row">
                    <div class="payment_method col-lg-4" wire:ignore>
                        <div class="order_review">
                            <div class="mb-25">
                                <h4>Thông tin giao hàng</h4>
                            </div>
                            <form method="POST" action="{{route('user.payment')}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" value="{{Auth::user()->name}}" required name="fullName" placeholder="Họ tên *">
                                </div>
                                <?php
                                    if(isset(Auth::user()->address)) {
                                        $address = explode(',', Auth::user()->address);
                                        $length = count($address);
                                    }
                                ?>
                                @if(Auth::user()->address)
                                <div class="form-group d-flex flex-column gap-3">
                                    <select class="form-control form-select form-select-sm" name="city" id="city" required
                                        aria-label=".form-select-sm" wire:model="city">
                                        <option value="" selected disabled>Chọn tỉnh thành *
                                        </option>
                                        <option
                                            value="{{
                                                                                                                            $address[$length-1]}}"
                                            selected>{{
                                            $address[$length-1]}}
                                        </option>
                                    </select>
                                    <select class="form-control form-select form-select-sm" name="district" id="district" required
                                        aria-label=".form-select-sm" wire:model="district" wire:change="handleChangeDistrict">
                                        <option value="" disabled>Chọn tỉnh thành *</option>
                                        <option
                                            value="{{
                                                                                                                            $address[$length-2]}}"
                                            selected>{{
                                            $address[$length-2]}}
                                        </option>
                                    </select>
                                    <select class="form-control form-select form-select-sm" name="ward" id="ward" required
                                        aria-label=".form-select-sm" wire:model="ward">
                                        <option value="" disabled>Chọn tỉnh thành *</option>
                                        <option
                                            value="{{
                                                                                                                            $address[$length-3]}}"
                                            selected>{{
                                            $address[$length-3]}}</option>
                                    </select>
                                </div>
                                @else
                                <div class="form-group d-flex flex-column gap-3">
                                    <select class="form-control form-select form-select-sm" name="city" id="city" required
                                        aria-label=".form-select-sm" wire:model="city">
                                        <option value="" selected disabled>Chọn tỉnh
                                            thành *
                                        </option>
                                    </select>
                                    <select class="form-control form-select form-select-sm" name="district" id="district" required
                                        aria-label=".form-select-sm" wire:model="district" wire:change="handleChangeDistrict">
                                        <option value="" selected disabled>Chọn quận
                                            huyện *
                                        </option>
                                    </select>
                                    <select class="form-control form-select form-select-sm" name="ward" id="ward" required
                                        aria-label=".form-select-sm" wire:model="ward" >
                                        <option value="" selected disabled>Chọn phường xã
                                            *</option>
                                    </select>
                                </div>
                                @endif
                                <div class="form-group">
                                    <input type="text" name="address"
                                        value="{{implode(',',array_slice(explode(',', Auth::user()->address), 0, -3))}}" required
                                        placeholder="Số nhà, tên đường *">
                                </div>
                                <div class="form-group">
                                    <input required type="tel" name="phone" value="{{Auth::user()->phone}}" pattern="[0-9]{10,11}"
                                        placeholder="Số điện thoại *">
                                </div>
                                <div class="form-group">
                                    <input required type="email" name="email" value="{{Auth::user()->order_email}}" placeholder="Email *">
                                </div>
                                <div class="mb-20">
                                    <h5>Ghi chú</h5>
                                </div>
                                <div class="form-group mb-30">
                                    <textarea rows="5" name="note" placeholder="Ghi chú đơn hàng"></textarea>
                                </div>
                                <div class="mt-20">
                                    <h5>Chọn phương thức thanh toán</h5>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required type="radio" name="payment_option" id="exampleRadios3"
                                        value="cod">
                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                        data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Thanh toán khi
                                        giao hàng</label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required checked type="radio" name="payment_option" id="exampleRadios5"
                                        value="vnp">
                                    <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#vnp"
                                        aria-controls="vnp">Thanh toán qua VNPay</label>
                                </div>
                                <div class="mt-20">
                                    <h5>Chọn đơn hàng cần thanh toán</h5>
                                </div>
                                @foreach(Auth::user()->carts->groupBy('seller_id') as $sellerId => $carts)
                                @if($loop->first)
                                <div class="custome-radio">
                                    <input class="form-check-input" required checked type="radio" name="seller_id" id="{{$sellerId}}"
                                        value="{{$sellerId}}">
                                    <label class="form-check-label" for="{{$sellerId}}" data-bs-toggle="collapse" data-target="#vnp"
                                        aria-controls="vnp">Đơn hàng của {{$carts[0]->product->user->name}}</label>
                                </div>
                                @else
                                <div class="custome-radio">
                                    <input class="form-check-input" required type="radio" name="seller_id" id="{{$sellerId}}"
                                        value="{{$sellerId}}">
                                    <label class="form-check-label" for="{{$sellerId}}" data-bs-toggle="collapse" data-target="#vnp"
                                        aria-controls="vnp">Đơn hàng của {{$carts[0]->product->user->name}}</label>
                                </div>
                                @endif
                                @endforeach
                                @foreach(Cart::instance('cart')->content() as $item)
                                <input type="hidden" name="products[]"
                                    value="{{$item->product->id . ';' . $item->qty . ';' . $item->subtotal}}" />
                                @endforeach
                                <button type="submit" name="redirect" class="btn btn-fill-out btn-block mt-30">Đặt
                                    hàng</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Đơn hàng của bạn</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Auth::user()->carts->groupBy('seller_id') as $sellerId => $carts)
                                        @if(!$loop->first)
                                        <tr class="bg-light">
                                            <td colspan="6"></td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="6">
                                                <div>
                                                    <a class="d-flex gap-2 mt-2 mb-2 align-items-center ms-lg-4"
                                                        href="{{route('shop', ['seller_id' => $carts[0]->product->user->id])}}">
                                                        <div class="rounded-circle img-thumbnail"
                                                            style="width: 50px; height: 50px; overflow: hidden; background-size: cover; background-position: center; background-image: url('{{$carts[0]->product->user->profile_photo_path ? asset('assets/imgs/products/avatars/' . $carts[0]->product->user->profile_photo_path) : asset('assets/imgs/user.png')}}')">
                                                        </div>
                                                        <h4 class="">{{$carts[0]->product->user->name}}</h4>
                                                    </a>
                                            </td>
                                        </tr>
                                        @foreach ($carts as $item)
                                        <tr>
                                            <td class="image product-thumbnail"><img
                                                    src="{{ asset('assets/imgs/products/products') }}/{{ $item->product->image }}"
                                                    alt="#"></td>
                                            <td>
                                                <h5>
                                                    <a href="{{ route('product.details',['slug'=>$item->product->slug]) }}">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </h5>
                                                <span class="product-qty">x {{ $item->quantity }}</span>
                                            </td>
                                            <td>{{number_format(intval(str_replace(',', '',$item->product->regular_price)))}} VND</td>
                                            <td>{{number_format(intval(str_replace(',', '',$item->product->regular_price * $item->quantity)))}} VND</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th>Tổng tiền các sản phẩm</th>
                                            <td class="product-subtotal" colspan="3">
                                                {{number_format(intval(str_replace(',', '',$carts->sum(function($cart) {
                                                return $cart->quantity * $cart->product->regular_price;
                                                }))))}} VND
                                            </td>
                                        </tr>
                                        
                
                                        <tr>
                                            <th>Phí giao hàng</th>
                                            <td colspan="3">
                                                <em>
                                                    @if(isset($shipFees[$sellerId]) && $shipFees[$sellerId] >= 0)
                                                    {{ number_format($shipFees[$sellerId]) . ' VND' }}
                                                    @else
                                                    Vui lòng nhập thông tin giao hàng để tính phí giao hàng
                                                    @endif
                                                </em>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Thành tiền</th>
                                            <td colspan="3" class="product-subtotal">
                                            @if(isset($shipFees[$sellerId]) && $shipFees[$sellerId] >= 0)
                                            <span
                                                    class="font-xl text-brand fw-900">
                                                    <?php 
                                                        $subtotal = $carts->sum(function($cart) {
                                                            return $cart->quantity * $cart->product->regular_price;
                                                        });
                                                    ?>
                                                    {{number_format($subtotal + $shipFees[$sellerId])}} VND
                                                    </span>
                                                    @else
                                                    Vui lòng nhập thông tin giao hàng để tính thành tiền
                                                    @endif
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                
                        </div>
                
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                    </div>
                
                </div>
                </div>
        </section>
    </main>
    @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var cities = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
        renderCity(result.data);
    });

    

    function renderCity(data) {
        for (const x of data) {
            cities.options[cities.options.length] = new Option(x.Name, x.Name);
        }
        cities.onchange = function () {
            districts.length = 1;
            ward.length = 1;
            if (this.value != "") {
                const result = data.filter(n => n.Name === this.value);

                for (const k of result[0].Districts) {
                    districts.options[districts.options.length] = new Option(k.Name, k.Name);
                }
            }
        };
        districts.onchange = function () {
            wards.length = 1;
            const dataCity = data.filter((n) => n.Name === cities.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Name);
                }
            }
        };
    }
</script>