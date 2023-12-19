<div>
    <main class="main">
    <div class="container" style="background-color: #f0f0f0; text-align: center; padding: 20px; margin-bottom: 20px">
    <h2 style="margin: 0; font-size: 24px; font-weight: bold; color: black;">Thêm sản phẩm</h2>
</div>
            <section class="mt-50 mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                        Thêm sản phẩm mới
                                        </div>
                                        <div class="col-md-6">
                                        <a href="{{route('seller.products')}}" class="btn btn-success float-end">Tất cả sản phẩm</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                    @endif
                                <form wire:submit.prevent="addProduct">
                                <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Tên sản phẩm</label>
                                        <input type="text" name="name" class="form-control" style="background-color:white" placeholder="Nhập tên sản phẩm" wire:model="name" wire:keyup="generateSlug"/>
                                        @error('name')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" style="background-color:white" placeholder="Nhập slug" wire:model="slug"/>
                                        @error('slug')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror                                        
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="description" class="form-label">Mô tả sản phẩm</label>
                                        <textarea class="form-control" style="background-color:white; height: 150px;" name="description" placeholder="Nhập tóm tắt" wire:model="description"></textarea>
                                        @error('description')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3 " wire:ignore>
                                        <label for="category_id " class="form-label">Danh mục</label>
                                        <select class="form-control " style="background-color:white" name="category_id" wire:model="category_id" id="categorySelect" >
                                            <option value="">Chọn danh mục</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <label for="publisher_id" class="form-label" >Nhà phát hành</label>
                                        <select class="form-control" style="background-color:white" name="publisher_id" wire:model="publisher_id" id="publisherSelect">
                                        <option value="">Chọn nhà phát hành</option>>
                                        @foreach($publishers as $publisher)
                                        <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                                        @endforeach
                                        </select>
                                        @error('publisher_id')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                       
                                    <div class="row">   
                                    <div class="mb-3 mt-3  col-md-3">
                                        <label for="regular_price" class="form-label">Giá bán</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="decreaseRegularprice">-</button>
                                            </span>
                                            <input type="text" name="regular_price" class="form-control" style="background-color:white" placeholder="Nhập giá bán" wire:model="regular_price"/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="increaseRegularprice">+</button>
                                            </span>
                                        </div>
                                        @error('regular_price')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>  
                                    <div class="mb-3 mt-3  col-md-3">
                                        <label for="sale_price" class="form-label">Giá gốc</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="decreaseSaleprice">-</button>
                                            </span>
                                            <input type="text" name="sale_price" class="form-control" style="background-color:white" placeholder="Nhập gốc" wire:model="sale_price"/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="increaseSaleprice">+</button>
                                            </span>
                                        </div>
                                        @error('sale_price')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>    

  
                                    <div class="mb-3 mt-3  col-md-3">
                                        <label for="quantity" class="form-label">Số lượng sản phẩm</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="decreaseQuantity">-</button>
                                            </span>
                                            <input type="text" name="quantity" class="form-control" style="background-color:white" placeholder="Nhập số lượng" wire:model="quantity"/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="increaseQuantity">+</button>
                                            </span>
                                        </div>
                                        @error('quantity')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>



                                                                                                                                          
                                    <div class="mb-3 mt-3 col-md-3">
                                        <label for="stock_status" class="form-label"> Tình trạng hàng hoá</label>
                                            <select class="form-control" style="background-color:white" name="stock_status" wire:model="stock_status">
                                                <option value="Còn hàng">Còn hàng</option>
                                                <option value="Hết Hàng">Hết Hàng</option>
                                            </select>
                                        @error('stock_status')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label">Ảnh</label>
                                        <input type="file" name="image" class="form-control" style="background-color:white" wire:model="image"/>
                                        @if($image) 
                                        <img src="{{$image->temporaryUrl()}}" width="120" />
                                        @endif
                                        @error('image')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    </div>
                                                                                                                                       
                                        <button type="submit" class="btn btn-primary float-end">Thêm</button>
                                </form>
                                </div>
                                @livewireScripts
                                @livewireStyles
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </main>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#categorySelect').select2({
                placeholder: 'Chọn danh mục',
                
                
            });

            $('#publisherSelect').select2({
                placeholder: 'Chọn nhà phát hành',
                
            });

            $('#authorSelect').select2({
                placeholder: 'Chọn tác giả',
                
            });

            $('#categorySelect').on('change', function (e) {
                @this.set('category_id', e.target.value);
            });

            $('#publisherSelect').on('change', function (e) {
                @this.set('publisher_id', e.target.value);
            });

            $('#authorSelect').on('change', function (e) {
                @this.set('author_id', e.target.value);
            });
        });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy', 
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function(e){
            @this.set('release_date', e.format());
        });
    });
</script>

@endpush
