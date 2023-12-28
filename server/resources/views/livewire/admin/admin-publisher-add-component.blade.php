<div>
    <main class="main">
    <div class="container" style="background-color: #f0f0f0; text-align: center; padding: 20px; margin-bottom: 20px">
    <h2 style="margin: 0; font-size: 24px; font-weight: bold; color: black;">Thêm thương hiệu</h2>
</div>
            <section class="mt-50 mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                        Thêm thương hiệu
                                        </div>
                                        <div class="col-md-6">
                                        <a href="{{route('admin.publishers')}}" class="btn btn-success float-end">Tất cả thương hiệu</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                    @endif
                                <form wire:submit.prevent="storePublisher">
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Tên thương hiệu</label>
                                        <input type="text" name="name" class="form-control" style="background-color:white" placeholder="Nhập tên" wire:model="name" wire:keyup="generateSlug"/>
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
                                        <button type="submit" class="btn btn-primary float-end">Thêm</button>
                                </form>
                                </div>
                                @livewireScripts
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </main>
