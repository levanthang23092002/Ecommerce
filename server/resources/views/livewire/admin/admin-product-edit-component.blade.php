
<div>
    <main class="main">
    <div class="container" style="background-color: #f0f0f0; text-align: center; padding: 20px; margin-bottom: 20px">
    <h2 style="margin: 0; font-size: 24px; font-weight: bold; color: black;">Cập nhật sản phẩm</h2>
</div>
            <section class="mt-50 mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                        Cập nhật sản phẩm 
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
                                    <form wire:submit.prevent="updateProduct" >
                                    <div class="mb-3 mt-3" >
                                        <label for="name" class="form-label">Tên sản phẩm</label>
                                        <input type="text" name="name" class="form-control"  style="background-color:white" placeholder="Nhập tên sản phẩm" wire:model="name" wire:keyup="generateSlug" />
                                        @error('name')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control"  style="background-color:white" placeholder="Nhập slug" wire:model="slug"/>
                                        @error('slug')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror                                        
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea class="form-control"  style="background-color:white; height: 150px;"  name="description" placeholder="Nhập mô tả" wire:model="description"></textarea>
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

                                    </div>   
                                    <div class="row">   
                                    <div class="mb-3 mt-3  col-md-3">
                                        <label for="regular_price" class="form-label">Giá bán</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="decreaseRegularprice">-</button>
                                            </span>
                                            <input type="text" name="regular_price" class="form-control"  style="background-color:white" placeholder="Nhập giá bán" wire:model="regular_price"/>
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
                                            <input type="text" name="sale_price" class="form-control"  style="background-color:white" placeholder="Nhập gốc" wire:model="sale_price"/>
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
                                            <input type="text" name="quantity" class="form-control"  style="background-color:white" placeholder="Nhập số lượng" wire:model="quantity"/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="increaseQuantity">+</button>
                                            </span>
                                        </div>
                                        @error('quantity')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                                                                                                                          
                                    <div class="mb-3 mt-3  col-md-3">
                                        <label for="weight" class="form-label">Trọng lượng (gram)</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="decreaseWeight">-</button>
                                            </span>
                                            <input type="text" name="weight" class="form-control"  style="background-color:white" placeholder="Nhập khối lượng (g)" wire:model="weight"/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="increaseWeight">+</button>
                                            </span>
                                        </div>
                                        @error('weight')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>  
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="newimage" class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control"  style="background-color:white" wire:model="newimage"/>
                                        @if($newimage) 
                                            <img src="{{$newimage->temporaryUrl()}}" width="120" />
                                        @else
                                            <img src="{{asset('assets/imgs/products/products')}}/{{$image}}" width="120" />
                                        @endif

                                        @error('newimage')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                                                                                                                                                     
                                        <button type="submit" class="btn btn-primary float-end">Cập nhật</button>
                                </form>
                                </div>
                                @livewireScripts
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
            format: 'dd-mm-yyyy', // Use the desired date format
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function(e){
            @this.set('release_date', e.format());
        });
    });
</script>

@endpush
