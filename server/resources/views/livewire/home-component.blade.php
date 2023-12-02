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
<section class="banner-2 section-padding pb-0">
            <div class="container">
                <div class="banner-img banner-big wow fadeIn animated f-none">
                    <img src="assets/imgs/banner/banner-4.jpg" alt="">
                    <div class="banner-text d-md-block d-none">
                        <h4 class="mb-15 mt-40 text-brand">Tuổi thơ qua những trang sách</h4>
                        <h1 class="fw-600 mb-20"  style="color: white; ">Tặng sách tôi thấy hoa vàng trên cỏ xanh <br>cho đơn hàng trên 400k</h1>
                        <a href="{{route('shop')}}" class="btn">Xem thêm <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="banners mb-15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="assets/imgs/banner/banner-1.jpg" alt="">
                            <div class="banner-text">
                                <span >Ưu đãi</span>
                                <h4 style="color: blue; ">Giảm 20% vào <br>Ngày nhà giáo Việt Nam</h4>
                                <a href="{{route('shop')}}" class="btn">Mua ngay <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="assets/imgs/banner/banner-2.jpg" alt="">
                            <div class="banner-text">
                                <span >Giảm giá</span>
                                <h4 style="color: blue; ">Tuyển tập <br>sách tiếng anh</h4>
                                <a href="{{route('shop')}}" class="btn">Mua ngay <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img wow fadeIn animated  mb-sm-0">
                            <img src="assets/imgs/banner/banner-3.jpg" alt="">
                            <div class="banner-text">
                                <span style="color:#F">Sách mới về</span>
                                <h4 style="color: yellow; ">Mua ngay hôm nay để nhận <br>Ưu đãi và giảm giá</h4>
                                <a href="{{route('shop')}}" class="btn">Mua ngay <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="home-slider position-relative pt-50">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">Đại lễ giảm giá</h4>
                                    <h2 class="animated fw-900">BLACK FIDAY</h2>
                                    <h1 class="animated fw-900 text-brand">Giảm giá đến 70%</h1>
                                    <p class="animated">Cho tất cả sản phẩm</p>
                                    <a class="animated btn btn-brush btn-brush-3" href="{{route('shop')}}"> Mua ngay </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-1" src="assets/imgs/slider/slider-1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">Ưu đãi cuối năm</h4>
                                    <h2 class="animated fw-900">Ngày Giáng Sinh</h2>
                                    <h1 class="animated fw-900 text-7">Truyện trọn bộ</h1>
                                    <p class="animated">Tiết kiệm đén 20%</p>
                                    <a class="animated btn btn-brush btn-brush-2" href="{{route('shop')}}"> Mua ngay  </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-2" src="assets/imgs/slider/slider-2.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        
        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Nổi bật</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Bán chạy</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false">Mới nhất</button>
                        </li>
                    </ul>
                    <a href="{{route('shop')}}" class="view-more d-none d-md-flex">Xem thêm<i class="fi-rs-angle-double-small-right"></i></a>
                </div>

                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                        @php 
                             $witems = Cart::instance('wishlist')->content()->pluck('id');
                        @endphp
                        @foreach($products as $product )
                            <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap" >
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('product.details',['slug'=>$product->slug])}}" >
                                                <img class="default-img" style="height: 400px" src="{{asset('assets/imgs/products/products')}}/{{$product->image}}" alt="">
                                                <img class="hover-img"  style="height: 400px" src="{{asset('assets/imgs/products/products')}}/{{$product->image}}" alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Nổi bật</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                           
                                        </div>
                                        <h2><a
                                                href="{{route('product.details',['slug'=>$product->slug])}}">{{$product->name}}</a>
                                        </h2>
                                       

                                        <div class="row">
                                        <div class="mb-3 mt-3"> 
                                        <div class="product-price">
                                            <span>{{number_format($product->regular_price)}} VND </span>
                                            <span class="old-price font-md ml-1">{{number_format($product->sale_price)}}</span>
                                            <!-- <span class="old-price">$245.8</span> -->
                                        </div>
                                        <div class="product-action-1 show">
                                            @livewireStyles
                                            @if($witems->contains($product->id))
                                                <a aria-label="Remove From Wishlist" class="action-btn hover-up wishlisted" href="#" wire:click.prevent="removeFromWishlist({{$product->id}})"><i class="fi-rs-heart"></i></a>
                                            @else
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up" href="#" wire:click.prevent="addToWishlist({{$product->id}},'{{$product->name}}',{{$product->regular_price}})"><i class="fi-rs-heart"></i></a>
                                            @endif
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                wire:click.prevent="store({{$product->id}},'{{$product->name}}',{{$product->regular_price}})"><i
                                                    class="fi-rs-shopping-bag-add"></i></a>
                                            @livewireScripts

                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        @endforeach   
                        </div>
                     
                    </div>

                </div>
           
            </div>
        </section>
        <section class="featured section-padding position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-1.png" alt="">
                            <h4 class="bg-1">Vận chuyển nhanh chóng</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-2.png" alt="">
                            <h4 class="bg-3">Mua hàng online</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-3.png" alt="">
                            <h4 class="bg-2">Tiết kiệm tiền</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-4.png" alt="">
                            <h4 class="bg-4">Ưu đãi lớn</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-5.png" alt="">
                            <h4 class="bg-5">Dễ dàng</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-6.png" alt="">
                            <h4 class="bg-6">Hỗ trợ 24/7</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
        <section class="section-padding">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Mới </span>phát hành</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                        
     
                        @foreach($products as $product )
                        <div class="product-cart-wrap small hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route('product.details',['slug'=>$product->slug])}}">
                                        <img class="default-img" style="height: 250px" src=" {{asset('assets/imgs/products/products')}}/{{$product->image}}" alt="">
                                        <img class="hover-img" src=" {{asset('assets/imgs/products/products')}}/{{$product->image}}" alt="">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                        <i class="fi-rs-eye"></i></a>
                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="new">New</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a href="{{route('product.details',['slug'=>$product->slug])}}">{{substr($product->name,0,60)}}</a></h2>
                                <div class="product-price">
                                    <span>{{number_format($product->regular_price)}} VND</span>
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
                    
                        
                    </div>
                </div>
            </div>
        </section>
       
        <section class="section-padding">
            <div class="container">
                <h3 class="section-title mb-20 wow fadeIn animated"><span>Các hãng </span>đối tác</h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                    <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-1.png" alt="" style="width: 100px;">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="" style="width: 100px;">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-2.png" alt="" style="width: 100px;">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-4.png" alt="" style="width: 100px;">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-5.png" alt="" style="width: 100px;">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-6.png" alt="" style="width: 100px;">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-7.png" alt="" style="width: 100px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </main>
    @livewireScripts  
</div>
