<div>
<style>
    .wishlisted{
        background-color: #F15412 !important;
        border: 1px solid transparent !important; 
    }
    .wishlisted i{
        color: #fff !important;
    }
</style>
    @livewireStyles
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang Chủ</a>
                    <span></span> Sản Phẩm Được yêu thích
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row product-grid-4">
                    @if(Auth::user()->wishes->count() > 0)
                    @foreach($wishes as $item )
                            <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('product.details',['slug'=>$item->product->slug])}}">
                                                <img class="default-img"
                                                    src="{{ asset('assets/imgs/products/products')}}/{{$item->product->image}}"
                                                    alt="{{$item->product->name}}">
                                                <img class="hover-img"
                                                    src="{{ asset('assets/imgs/products/products')}}/{{$item->product->image}}"
                                                    alt="{{$item->product->name}}">
                                            </a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                           
                                        </div>
                                        <h2><a
                                                href="{{route('product.details',['slug'=>$item->product->slug])}}">{{$item->product->name}}</a>
                                        </h2>
                                       
                                        <div class="product-price">
                                            <span>{{number_format($item->product->regular_price)}} VND </span>
                                            <!-- <span class="old-price">$245.8</span> -->
                                        </div>
                                        <div class="product-action-1 show">
                                        <a aria-label="Bỏ yêu thích" class="action-btn hover-up" style="background-color: #07b55b; color: #fff;" href="#" wire:click.prevent="removeFromWishlist({{$item->product->id}})"><i class="fi-rs-heart"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            {{$wishes->links()}}
                    @else
                        <div class="alert alert-warning" role="alert">
                            Bạn không có sản phẩm yêu thích!
                        </div>
                    @endif
                            
                </div>
            </div>
        </section>
    </main>
     @livewireScripts
</div>
