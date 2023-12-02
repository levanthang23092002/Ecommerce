<div>
    <main class="main">
    <div class="container" style="background-color: #f0f0f0; text-align: center; padding: 20px; margin-bottom: 20px">
    <h2 style="margin: 0; font-size: 24px; font-weight: bold; color: black;">Quản lý sản phẩm</h2>
</div>
            <section class="mt-50 mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header" style=" border: 2px solid #ccc; border-radius: 4px;"> 
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input wire:model="search" type="text" class="form-control" style="background-color:white" placeholder="Tìm kiếm bằng tên..." style="border: 1px solid #ccc; border-radius: 4px;">
                                            <div class="input-group-text" style="height: 48px;">
                                                <select wire:model="filterStockStatus" class="form-control" style="width: 120px;border: none;">
                                                    <option value="">Trạng thái ▼</option>
                                                    <option value="Còn hàng">Còn hàng</option>
                                                    <option value="Hết hàng">Hết hàng</option>
                                                </select>
                                            </div>
                                            <button wire:click="clearSearch" class="btn btn-secondary btn-sm">Xoá</button>

                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <a href="{{ route('admin.product.add') }}" class="btn btn-success btn-sx">Thêm sản phẩm</a>
                                    </div>
                                </div>
                            </div>
                                <div class="card-body">
                                        <table class="table table-striped" style="border: 2px solid #ccc;">
                                            <thead>
                                                <tr class="text-center">
                                                <th>#</th>
                                                <th>Ảnh</th>
                                                <th>Tên sách</th>
                                                <th>Tình trạng hàng</th>
                                                <th>Giá</th>
                                                <th>Danh mục</th>
                                                <th>Ngày thêm</th>
                                                <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $product)
                                                    <tr class="text-center">
                                                    <td>{{$product->id}}</td>
                                                    <td><img src="{{ asset('assets/imgs/products/products')}}/{{$product->image}}" alt="{{$product->name}}" width="60" /></td>
                                                    <td>{{$product->name}}</td>
                                                    <td>{{$product->stock_status}}</td>
                                                    <td>{{ number_format($product->regular_price, 0, ',', ',') }} VND</td>
                                                    <td>{{$product->category->name}}</td>
                                                    <td>{{$product->created_at->timezone('Asia/Ho_Chi_Minh')}}</td>
                                                    <td>
                                                        <a href="{{route('admin.product.edit', ['product_id'=>$product->id])}}" class="text-info">Chỉnh sửa</a>
                                                        <a href="{{route('admin.product.delete', ['product_id'=>$product->id])}}" class="text-danger" style="margin-left:20px;">Xoá</a>   
                                                    </td>
                                                    </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                        {{$products->links('pagination::bootstrap-4')}}
                                </div>
                                @livewireScripts
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </main>
</div>



