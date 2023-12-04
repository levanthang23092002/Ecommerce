<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Trang chủ</a>
                    <span></span> Mua sắm
                    <span></span> Thông tin đơn hàng
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    @if (session('success'))
                    <div class="col-md-12 mb-3">
                        <div class="alert alert-success mb-3 col-md-12">
                            {{session('success')}}
                        </div>
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="col-md-12 mb-3">
                        <div class="alert alert-danger mb-3 col-md-12">
                            {{session('error')}}
                        </div>
                    </div>
                    @endif
                    <div class="col-md-12">
                        <div class="order_review">
                            <div class="mb-20">
                                @php
                                $badgeClass = [
                                '0' => 'bg-secondary', // Chờ duyệt
                                '1' => 'bg-success', // Đã duyệt
                                '2' => 'bg-info', // Đang giao hàng
                                '3' => 'bg-primary', // Hoàn thành
                                '4' => 'bg-danger', // Đã hủy
                                ];

                                $orderStatuses = [
                                '0' => 'Chờ duyệt',
                                '1' => 'Đã duyệt',
                                '2' => 'Đang giao hàng',
                                '3' => 'Hoàn thành',
                                '4' => 'Đã hủy',
                                ];
                                @endphp
                                <h4>Thông tin đơn hàng
                                    <span class="badge {{$badgeClass[$order->order_status] ?? 'bg-secondary'}}">
                                        {{$orderStatuses[$order->order_status] ?? 'Chờ duyệt'}}
                                    </span>
                                </h4>
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
                                        @foreach($orderItems as $item)
                                        <tr>
                                            <td class="image product-thumbnail"><img
                                                    src="{{asset('assets/imgs/products/products')}}/{{$products[$item->product_id]->image}}"
                                                    alt="#"></td>
                                            <td>
                                                <h5><a
                                                        href="{{route('product.details',['slug'=>$products[$item->product_id]->slug])}}">{{$products[$item->product_id]->name}}</a>
                                                </h5> <span class="product-qty">x {{$item->quantity}}</span>
                                            </td>
                                            <td>{{number_format(intval($item->amount) / intval($item->quantity))}} VND
                                            </td>
                                            <td>{{number_format($item->amount)}} VND</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th>Tổng tiền các sản phẩm</th>
                                            <td class="product-subtotal" colspan="3">
                                                {{number_format($order->sub_total)}} VND</td>
                                        </tr>
                                        <tr>
                                            <th>Thuế</th>
                                            <td class="product-subtotal" colspan="3"> {{number_format($order->tax)}} VND
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Phí giao hàng</th>
                                            <td colspan="3"><em>{{number_format($order->shipping)}} VND</em></td>
                                        </tr>
                                        <tr>
                                            <th>Thành tiền</th>
                                            <td colspan="3" class="product-subtotal"><span
                                                    class="font-xl text-brand fw-900">{{number_format($order->amount)}}
                                                    VND</span></td>
                                        </tr>
                                        @if(isset($order->tracking))
                                        <tr>
                                            <th>Tình trạng vận chuyển</th>
                                            <td colspan="3"><a href="{{$order->tracking}}">{{$order->tracking}}</a></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="mb-25">
                                <h5>Thông tin thanh toán</h5>
                            </div>
                            <div class="form-group">
                                <input type="text" value="Họ tên: {{$order->name}}" disabled>
                            </div>
                            <div class="form-group">
                                <input type="text" value="Địa chỉ: {{$order->address}}" disabled>
                            </div>
                            <div class="form-group">
                                <input type="text" value="SĐT: {{$order->phone}}" disabled>
                            </div>
                            <div class="form-group">
                                <input type="text" value="Email: {{$order->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <input type="text"
                                    value="PT Thanh toán: {{$order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng' : 'VNPay'}}"
                                    disabled>
                            </div>


                            <div class="mb-20">
                                <h5>Ghi chú</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="5" disabled>{{$order->note}}</textarea>
                            </div>
                            @if ($order->order_status == 0)
                            <form method="POST" action="{{ route('user.order_cancel', ['order_id' => $order->id]) }}"
                                id="cancelForm">
                                @csrf
                                <button type="button" class="btn btn-fill-out btn-block mt-30"
                                    onclick="confirmCancel()">Huỷ đơn hàng</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<script>
    function confirmCancel() {
        var result = confirm("Bạn có chắc chắn muốn huỷ đơn hàng không?");
        if (result) {
            // Nếu người dùng đồng ý, submit form
            document.getElementById("cancelForm").submit();
        } else {
            // Nếu người dùng không đồng ý, không thực hiện gì cả
        }
    }
</script>