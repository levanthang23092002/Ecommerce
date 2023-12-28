<div>
    <main class="main">
    <div class="container" style="background-color: #f0f0f0; text-align: center; padding: 20px; margin-bottom: 20px">
    <h2 style="margin: 0; font-size: 24px; font-weight: bold; color: black;">Quản lý nhà phát hành</h2>
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
                                            <input wire:model="search" type="text" placeholder="Tìm kiếm bằng tên..." style="border: 1px solid #ccc; border-radius: 4px;">
                                            <button wire:click="clearSearch" class="btn btn-secondary btn-sm">Xoá</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <a href="{{ route('admin.publisher.add') }}" class="btn btn-success btn-sx">Thêm thương hiệu</a>
                                    </div>
                                </div>
                            </div>
                                <div class="card-body">
                                        <table class="table table-striped" style="border: 2px solid #ccc;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên thương hiệu</th>
                                                    <th>Slug</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($publishers as $publisher)
                                                    <tr>
                                                        <td>{{$publisher->id}}</td>
                                                        <td>{{$publisher->name}}</td>
                                                        <td>{{$publisher->slug}}</td>
                                                        <td>
                                                        <a href="{{route('admin.publisher.edit', ['publisher_id'=>$publisher->id])}}" class="text-info">Chỉnh sửa</a>
                                                        <a href="{{route('admin.publisher.delete', ['publisher_id'=>$publisher->id])}}" class="text-danger" style="margin-left:20px;">Xoá</a>   
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                        {{$publishers->links('pagination::bootstrap-4')}}
                                </div>
                                @livewireScripts
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </main>
</div>



