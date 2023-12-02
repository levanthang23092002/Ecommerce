<div>
    @if (Cart::instance('cart')->count() == 0)
    @php
    redirect()->route('shop');
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
                    <div class="col-md-12">
                        @if ($errors->any())
                        <div class=" alert alert-danger mt-3 mb-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
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
                                        @foreach (Cart::instance('cart')->content() as $item)
                                        <tr>
                                            <td class="image product-thumbnail"><img
                                                    src="{{ asset('assets/imgs/products/products') }}/{{ $item->model->image }}"
                                                    alt="#"></td>
                                            <td>
                                                <h5>
                                                    <a
                                                        href="{{ route('product.details',['slug'=>$item->model->slug]) }}">
                                                        {{ $item->model->name }}
                                                    </a>
                                                </h5>
                                                <span class="product-qty">x {{ $item->qty }}</span>
                                            </td>
                                            <td>{{number_format(intval(str_replace(',', '',$item->price)))}} VND</td>
                                            <td>{{number_format(intval(str_replace(',', '',$item->subtotal)))}} VND</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th>Tổng tiền các sản phẩm</th>
                                            <td class="product-subtotal" colspan="3">
                                                {{number_format(intval(str_replace(',', '',Cart::subtotal())))}} VND
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Thuế</th>
                                            <td class="product-subtotal" colspan="3">
                                                {{number_format(intval(str_replace(',', '',Cart::tax())))}} VND</td>
                                        </tr>

                                        <tr>
                                            <th>Phí giao hàng</th>
                                            <td colspan="3"><em>30,000 VND</em></td>
                                        </tr>
                                        <tr>
                                            <th>Thành tiền</th>
                                            <td colspan="3" class="product-subtotal"><span
                                                    class="font-xl text-brand fw-900">{{number_format(intval(str_replace(',',
                                                    '',Cart::total())) +30000)}} VND</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Thông tin giao hàng</h5>
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
                                    <div class="form-group d-flex gap-3">
                                        <select class="form-control form-select form-select-sm"
                                            name="city" id="city" required aria-label=".form-select-sm">
                                            <option value="" selected disabled>Chọn tỉnh thành *
                                            </option>
                                            <option value="{{
                                                $address[$length-1]}}" selected>{{
                                                $address[$length-1]}}
                                            </option>
                                        </select>

                                        <select class="form-control form-select form-select-sm"
                                            name="district" id="district" required
                                            aria-label=".form-select-sm">
                                            <option value="" disabled>Chọn tỉnh thành *</option>

                                            <option value="{{
                                                $address[$length-2]}}" selected>{{
                                                    $address[$length-2]}}
                                            </option>
                                        </select>

                                        <select class="form-control form-select form-select-sm"
                                            name="ward" id="ward" required aria-label=".form-select-sm">
                                            <option value="" disabled>Chọn tỉnh thành *</option>

                                            <option value="{{
                                                $address[$length-3]}}" selected>{{
                                                    $address[$length-3]}}</option>
                                        </select>
                                    </div>
                                    @else
                                    <div class="form-group d-flex gap-3">
                                        <select class="form-control form-select form-select-sm"
                                            name="city" id="city" required aria-label=".form-select-sm">
                                            <option value="" selected disabled>Chọn tỉnh
                                                thành *
                                            </option>
                                        </select>

                                        <select class="form-control form-select form-select-sm"
                                            name="district" id="district" required
                                            aria-label=".form-select-sm">
                                            <option value="" selected disabled>Chọn quận
                                                huyện *
                                            </option>
                                        </select>

                                        <select class="form-control form-select form-select-sm"
                                            name="ward" id="ward" required aria-label=".form-select-sm">
                                            <option value="" selected disabled>Chọn phường xã
                                                *</option>
                                        </select>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <input type="text" name="address" value="{{implode(',',array_slice(explode(',', Auth::user()->address), 0, -3))}}" required placeholder="Số nhà, tên đường *">
                                    </div>
                                    <div class="form-group">
                                        <input required type="tel" name="phone" value="{{Auth::user()->phone}}" pattern="[0-9]{10,11}"
                                            placeholder="Số điện thoại *">
                                    </div>
                                    <div class="form-group">
                                        <input required type="email" name="email" value="{{Auth::user()->order_email}}"
                                            placeholder="Email *">
                                    </div>

                                    <div class="mb-20">
                                        <h5>Ghi chú</h5>
                                    </div>
                                    <div class="form-group mb-30">
                                        <textarea rows="5" name="note" placeholder="Ghi chú đơn hàng"></textarea>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required type="radio" name="payment_option"
                                            id="exampleRadios3" value="cod">
                                        <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                            data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Thanh toán khi
                                            giao hàng</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required checked type="radio"
                                            name="payment_option" id="exampleRadios5" value="vnp">
                                        <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                                            data-target="#vnp" aria-controls="vnp">Thanh toán qua VNPay</label>
                                    </div>
                                    @foreach(Cart::instance('cart')->content() as $item)
                                    <input type="hidden" name="products[]"
                                        value="{{$item->model->id . ';' . $item->qty . ';' . $item->subtotal}}" />
                                    @endforeach
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
                                    <input type="hidden" name="total"
                                        value="{{intval(str_replace(',', '', Cart::total())) +30000 }}" />
                                    <input type="hidden" name="sub_total" value="{{Cart::subtotal()}}" />
                                    <input type="hidden" name="tax" value="{{Cart::tax()}}" />
                                    <input type="hidden" name="shipping" value="30000" />
                                    <button type="submit" name="redirect" class="btn btn-fill-out btn-block mt-30">Đặt
                                        hàng</button>
                                </form>
                            </div>
                        </div>
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
            district.length = 1;
            ward.length = 1;
            if (this.value != "") {
                const result = data.filter(n => n.Name === this.value);

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Name);
                }
            }
        };
        district.onchange = function () {
            ward.length = 1;
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