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
                                        Thêm sản phẩm mới
                                        </div>
                                        <div class="col-md-6">
                                        <a href="{{route('admin.products')}}" class="btn btn-success float-end">Tất cả sản phẩm</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                    @endif
                                <form wire:submit.prevent="addProduct">
                                <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Tên sách</label>
                                        <input type="text" name="name" class="form-control" style="background-color:white" placeholder="Nhập tên sách" wire:model="name" wire:keyup="generateSlug"/>
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
                                        <label for="description" class="form-label">Tóm tắt</label>
                                        <textarea class="form-control" style="background-color:white; height: 150px;" name="description" placeholder="Nhập tóm tắt" wire:model="description"></textarea>
                                        @error('description')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3 " wire:ignore>
                                        <label for="category_id " class="form-label">Danh mục</label>
                                        <select class="form-control " name="category_id" wire:model="category_id" id="categorySelect" >
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

                                        <label for="author_id" class="form-label" >Tác giả</label>
                                        <select class="form-control" style="background-color:white" name="author_id" wire:model="author_id" id="authorSelect">
                                        <option value="">Chọn tác giả</option>>
                                        @foreach($authors as $author)
                                        <option value="{{$author->id}}">{{$author->name}}</option>
                                        @endforeach
                                        </select>
                                        @error('author_id')
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
                                        <label for="weight" class="form-label">Trọng lượng (gram)</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="decreaseWeight">-</button>
                                            </span>
                                            <input type="text" name="weight" class="form-control" style="background-color:white" placeholder="Nhập trọng lượng" wire:model="weight"/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="increaseWeight">+</button>
                                            </span>
                                        </div>
                                        @error('weight')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>  
                                    <div class="mb-3 mt-3  col-md-3">
                                        <label for="pages" class="form-label">Số trang</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="decreasePage">-</button>
                                            </span>
                                            <input type="text" name="pages" class="form-control" style="background-color:white" placeholder="Nhập số trang" wire:model="pages"/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary" type="button" wire:click="increasePage">+</button>
                                            </span>
                                        </div>
                                        @error('pages')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="row">   
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
                                    <div class="mb-3 mt-3  col-md-3">
                                        <label for="ISBN" class="form-label">ISBN</label>
                                        <input type="text" name="ISBN" class="form-control" style="background-color:white" placeholder="Nhập ISBN" wire:model="ISBN"/>
                                        @error('ISBN')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror                                        
                                    </div>
                                    <div class="mb-3 mt-3 col-md-3">
                                        <label for="cover_type" class="form-label" wire:model="cover_type">Loại Bìa</label>
                                            <select class="form-control" style="background-color:white" name="cover_type" wire:model="cover_type">
                                                <option value="Bìa mềm">Bìa mềm</option>
                                                <option value="Bìa cứng">Bìa cứng</option>
                                                <option value="Bìa rời">Bìa rời</option>
                                                <option value="Bìa gập">Bìa gập</option>
                                            </select>
                                        @error('cover_type')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3 col-md-3">
                                        <label for="size" class="form-label" >Kích thước (00x00cm)</label>
                                        <input type="text" name="size" class="form-control" style="background-color:white" placeholder="Nhập kích thước 00x00cm" wire:model="size" />
                                        @error('size')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>



                                    </div>  
                                    <div class="row">   
                                    <div class="mb-3 mt-3 col-md-3">
                                        <label for="language" class="form-label" wire:model="language">Ngôn ngữ</label>
                                            <select class="form-control" style="background-color:white" name="language" wire:model="language">
                                                <option value="Tiếng Việt">Tiếng Việt</option>
                                                <option value="Tiếng Nhật">Tiếng Nhật</option>
                                                <option value="Tiếng Trung">Tiếng Trung</option>
                                                <option value="Tiếng Hàn">Tiếng Hàn</option>
                                                <option value="Tiếng Anh">Tiếng Anh</option>
                                            </select>
                                        @error('language')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div> 
                                    <div class="mb-3 mt-3  col-md-3">
                                        <label for="demographic" class="form-label" >Đối tượng</label>
                                            <select class="form-control" style="background-color:white" name="demographic" wire:model="demographic">
                                                <option value="3+">3+</option>
                                                <option value="13+">13+</option>
                                                <option value="17+">17+</option>
                                                <option value="18+">18+</option>
                                            </select>
                                        @error('demographic')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>  
                                    <div class="mb-3 mt-3 col-md-3">
                                        <label for="release_date" class="form-label">Ngày phát hành</label>
                                        <input type="date" name="release_date" wire:model="release_date" style="width: 300px; height: 39px">
                                        
                                        @error('release_date')
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
