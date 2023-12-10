
<div>
@livewireStyles
    

<main class="main">
        @if($product == null)
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                <a href="/" rel="nofollow">Sản Phẩm Không tại Hoặc đã xóa</a>
                </div>
            </div>
        </div>
        @else
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Chi tiết sản phẩm
                    <span></span>{{$product->name}}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        <div class="product-image-slider">
                                            <figure class="border-radius-10 overflow-hidden">
                                                <img src="{{asset('assets/imgs/products/products')}}/{{$product->image}} " alt="product image">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="social-icons single-share">
                                        <ul class="text-grey-5 d-inline-block">
                                            <li><strong class="mr-10">Chia sẻ:</strong></li>
                                            <li class="social-facebook"><a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-facebook.svg') }}" alt=""></a></li>
                                            <li class="social-twitter"> <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a></li>
                                            <li class="social-instagram"><a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a></li>
                                            <li class="social-linkedin"><a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{$product->name}}</h2>
                                        <div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                               
                                               <p style="font-size:17px">Nhà xuất bản: <a href="#" >{{$publisher->name}}</a></p>
                                               <p style="font-size:17px">Tác giả: <a href="#" >{{$author->name}}</a></p>
                                               @php
                                                    $totalRatings = count($product->reviews);
                                                    $countRatings = [0, 0, 0, 0, 0];
                                                    $sumRatings = 0;

                                                    foreach ($product->reviews as $review) {
                                                        $sumRatings += $review->rating;
                                                        switch($review->rating) {
                                                            case 1: $countRatings[0] += 1; break;
                                                            case 2: $countRatings[1] += 1; break;
                                                            case 3: $countRatings[2] += 1; break;
                                                            case 4: $countRatings[3] += 1; break;
                                                            default: $countRatings[4] += 1;
                                                        }
                                                    }

                                                    $averageRating = $totalRatings > 0 ? $sumRatings / $totalRatings : 0;
                                                @endphp

                                                <p style="font-size:17px">Đánh giá: {{ $totalRatings > 0 ? number_format($averageRating, 2) : 'Không có đánh giá' }} <img src="{{ asset('assets/imgs/star.png')}}" width="20" height="20"></p>
                                            </div>
                                        <div>
                                            </div>
                                        </div>
                                        <div class="short-desc mb-30">
                                            <p class="font-sm">Mô tả: {{$product->description}}</p>
                                        </div>
                                        <div class="clearfix product-price-cover mb-20">
                                            <div class="product-price primary-color float-left">
                                                <ins><span class="text-brand">{{number_format($product->regular_price)}} VND</span></ins>
                                                <ins><span class="old-price font-md ml-15">{{number_format($product->sale_price)}} VND</span></ins>
                                                @php
                                                    $percentageOff = (($product->sale_price - $product->regular_price) / $product->sale_price) * 100;
                                                @endphp
                                                <span class="discount-percentage" style="font-size:20px">
                                                    {{ number_format($percentageOff, 2) }}% off
                                                </span>
                                            </div>
                                        </div>

                                        <div class="detail-extralink">
                                            <div class="border radius m-auto" style="max-width: 80px;padding: 9px 20px;position: relative;width: 100%; border-radius: 4px;">
                                                @if($quantity != 1)
                                                    <a href="#" class="qty-down" style="bottom:0;font-size: 16px;position: absolute;right: 8px;color: #707070;" wire:click.prevent="decrementQuantity()">
                                                        <i class="fi-rs-angle-small-down"></i>
                                                    </a>
                                                @endif
                                                <span class="qty-val">{{$quantity}}</span>
                                                @if($quantity != $product->quantity)
                                                    <a href="#" class="qty-up" style="top:0;font-size: 16px;position: absolute;right: 8px;color: #707070;" wire:click.prevent="incrementQuantity()">
                                                        <i class="fi-rs-angle-small-up"></i>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="product-extra-link2">
                                                @if($product->quantity > 0)
                                                    <button type="button" class="button button-add-to-cart" wire:click.prevent="store({{$product->id}},'{{$product->name}}',{{$product->regular_price}}, {{$quantity}})">Thêm vào giỏ hàng</button>
                                                @else    
                                                    <button type="button" class="button button-add-to-cart " onclick="addToCart('{{$product->name}}')" >Hết Hàng</button>
                                                @endif
                                                @if(Auth::check())
                                                    @if(Auth::user()->wishes && Auth::user()->wishes->pluck('product_id')->contains($product->id))
                                                        <a aria-label="Bỏ yêu thích" class="action-btn hover-up" style="background-color: #07b55b; color: #fff;" href="#" wire:click.prevent="removeFromWishlist({{$product->id}})"><i class="fi-rs-heart"></i></a>
                                                    @else
                                                        <a aria-label="Yêu thích" class="action-btn hover-up" href="#" wire:click.prevent="addToWishlist({{$product->id}},'{{$product->name}}',{{$product->regular_price}})"><i class="fi-rs-heart"></i></a>
                                                    @endif
                                                @else
                                                    <a aria-label="Yêu thích" class="action-btn hover-up" href="{{route('login')}}"><i class="fi-rs-heart"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-20">
                                            @if($product->quantity > 0)
                                                <p style="font-size:17px">Số lượng:<span class="in-stock text-success ml-5">{{$product->quantity}}</span></p>
                                            @else 
                                                <p style="font-size:17px">Số lượng:<span class="in-stock text-success ml-5">Hết hàng</span></p>
                                            @endif   
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-style3 mb-20">
                                <ul class="nav nav-tabs text-uppercase mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Chi tiết sản phẩm</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content mt-0">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div  class="row bg-success p-3 rounded-3">
                                            <div class="col-md-4 col-sm-12">
                                                <div style=" padding: 5px; "><strong>Định dạng : </strong><span> {{$product->cover_type}}</span></div>
                                                <div style=" padding: 5px; "><strong>Kích Thước : </strong><span> {{$product->size}}</span></div>
                                                <div style=" padding: 5px; "><strong>Trọng Lượng : </strong><span> {{$product->weight}}g</span></div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div style=" padding: 5px; "><strong>Số Trang : </strong><span> {{$product->pages}}</span></div>
                                                <div style=" padding: 5px; "><strong>Trạng thái : </strong><span> {{$product->stock_status}}</span></div>
                                                <div style=" padding: 5px; "><strong>Ngày Phát Hành : </strong><span> {{$product->release_date}}</span></div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div style=" padding: 5px; "><strong>ISBN : </strong><span> {{$product->ISBN}}</span></div>
                                                <div style=" padding: 5px; "><strong>Ngôn ngữ : </strong><span> {{$product->language}}</span></div>
                                                <div style=" padding: 5px; "><strong>Đối tượng : </strong><span> {{$product->demographic}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Đánh giá ({{$totalRatings}})</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content mt-0">
                                    <div class="tab-pane fade show active" id="Reviews">
                                        <!--comment form-->
                                        @if(Auth::check())
                                            @if($errors->any()) 
                                                <div class="alert alert-danger" role="alert">Vui lòng đánh giá sản phẩm trước khi gửi.</div>
                                            @endif
                                            @if(Session::has('error_message'))
                                                <div class="alert alert-danger" role="alert">{{Session::get('error_message')}}</div>
                                            @endif

                                            @if(Session::has('success_message'))
                                                <div class="alert alert-success" role="alert">{{Session::get('success_message')}}</div>
                                            @endif

                                            <div class="comment-form pt-0 border-0">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <form class="form-contact comment_form" wire:submit.prevent="submitReview" wire:ignore id="commentForm">
                                                            <h4 class="">Thêm đánh giá của bạn</h4>
                                                            <div id="stars" style="margin-top: 20px;">
                    
                                                                <label id="label1" for="star1" style="cursor: pointer; font-size: 35px; color: gold; margin: 0 5px;" onclick="setRating(1)">
                                                                    <input required type="radio" name="rating" id="star1" value="1" style="display: none" wire:model="rating">★
                                                                </label>

                                                                <label id="label2" for="star2" style="cursor: pointer; font-size: 35px; color: gold; margin: 0 5px;" onclick="setRating(2)">
                                                                    <input type="radio" name="rating" id="star2" value="2" style="display: none" wire:model="rating">★
                                                                </label>

                                                                <label id="label3" for="star3" style="cursor: pointer; font-size: 35px; color: gold; margin: 0 5px;" onclick="setRating(3)">
                                                                    <input type="radio" name="rating" id="star3" value="3" style="display: none" wire:model="rating">★
                                                                </label>

                                                                <label id="label4" for="star4" style="cursor: pointer; font-size: 35px; color: gold; margin: 0 5px;" onclick="setRating(4)">
                                                                    <input type="radio" name="rating" id="star4" value="4" style="display: none" wire:model="rating">★
                                                                </label>

                                                                <label id="label5" for="star5" style="cursor: pointer; font-size: 35px; color: gold; margin: 0 5px;" onclick="setRating(5)">
                                                                    <input type="radio" name="rating" id="star5" value="5" style="display: none" wire:model="rating">★
                                                                </label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control w-100" name="comment" wire:model="comment" id="comment" cols="30" rows="5" placeholder="Viết đánh giá của bạn về sản phẩm này."></textarea>
                                                                    </div>
                                                                </div>                                                            
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="button button-contactForm">Gửi đánh giá</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <h4 class="">Đăng nhập để được đánh giá.</h4>
                                        @endif

                                        <!--Comments-->
                                        <div class="comments-area">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    @if($totalRatings > 0) 
                                                    <h4 class="mb-30">Tất cả đánh giá</h4>
                                                    <div class="comment-list mb-3">
                                                        @foreach($reviews as $review)
                                                            <div class="single-comment justify-content-between d-flex">
                                                                <div class="user justify-content-between d-flex w-100">
                                                                    <div class="thumb text-center">
                                                                        <!-- <img src="{{ asset('assets/imgs/user.png')}}" alt=""> -->
                                                                        <img src="{{$review->user->profile_photo_path ?? asset('assets/imgs/user.png')}}" alt="">
                                                                    </div>
                                                                    <div class="desc w-100">
                                                                        <div class="d-flex align-items-center gap-1">
                                                                            <h6><a href="#">{{$review->user->name}}</a></h6>
                                                                            <p class="font-xs">{{ $review->updated_at->timezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y')}} </p>
                                                                        </div>
                                                                        <div class="product-rate d-inline-block p-0">
                                                                            <div class="product-rating" style="width:{{$review->rating * 20}}%">
                                                                            </div>
                                                                        </div>
                                                                        <p class="mb-3">{{$review->comment}}</p>
                                                                        
                                                                        @if($review->response_review)
                                                                        <div class="p-3 alert alert-secondary">
                                                                            <h5>Phản hồi của người bán</h5>
                                                                            <p>{{$review->response_review->comment}}</p>
                                                                            <p class="font-xs mr-30">{{$review->response_review->updated_at->timezone('Asia/Ho_Chi_Minh')->format('H:i d-m-Y')}} </p>
                                                                        </div>
                                                                        @endif
                                                                        <a aria-label="" class="action-btn hover-up d-flex gap-1 align-items-center" href="#" style="color: {{Auth::check() && $review->review_likes->where('user_id', Auth::user()->id)->first() ? '#07b55b' : '#999'}};" wire:click.prevent="likeReview({{$review->id}})">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="18" height="18" fill="{{Auth::check() && $review->review_likes->where('user_id', Auth::user()->id)->first() ? '#07b55b' : '#999'}}"><path d="M6,8H3a3,3,0,0,0-3,3v8a3,3,0,0,0,3,3H6Z"/><path d="M14,8l.555-3.328a2.269,2.269,0,0,0-1.264-2.486,2.247,2.247,0,0,0-2.9,1.037L8,8V22H22l2-11V8Z"/></svg>
                                                                            {{$review->review_likes && $review->review_likes->count() > 0 ? (Auth::check() && $review->review_likes->where('user_id', Auth::user()->id)->first() ? 'Đã thích' : '') .  ' (' . $review->review_likes->count() . ')' : 'Hữu ích?'}}
                                                                        </a>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            {{$reviews->links()}}
                                                        </div>
                                                    @else
                                                    <h4 class="mb-30">Không có đánh giá</h4>
                                                    @endif
                                                </div>
                                                <div class="col-lg-4">
                                                    <h4 class="mb-30">Thống kê đánh giá</h4>
                                                    <div class="d-flex mb-30">
                                                        <div class="product-rate d-inline-block mr-15">
                                                            <div class="product-rating" style="width:{{ number_format($averageRating, 2) * 20}}%">
                                                            </div>
                                                        </div>
                                                        <h6>{{ number_format($averageRating, 2) }}/5 ({{$totalRatings}} Đánh giá)</h6>
                                                    </div>
                                                    <div class="progress">
                                                        <span>5 sao</span>
                                                        <div class="progress-bar" role="progressbar" style="width: {{$totalRatings > 0 ? ($countRatings[4]/$totalRatings) * 100 : 0}}%;" aria-valuemin="0" aria-valuemax="100">{{number_format($totalRatings > 0 ? ($countRatings[4]/$totalRatings) * 100 : 0, 2)}}%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>4 sao</span>
                                                        <div class="progress-bar" role="progressbar" style="width: {{$totalRatings > 0 ? ($countRatings[3]/$totalRatings) * 100 : 0}}%;" aria-valuemin="0" aria-valuemax="100">{{number_format($totalRatings > 0 ? ($countRatings[3]/$totalRatings) * 100 : 0, 2)}}%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>3 sao</span>
                                                        <div class="progress-bar" role="progressbar" style="width: {{$totalRatings > 0 ? ($countRatings[2]/$totalRatings) * 100 : 0}}%;" aria-valuemin="0" aria-valuemax="100">{{number_format($totalRatings > 0 ? ($countRatings[2]/$totalRatings) * 100 : 0, 2)}}%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>2 sao</span>
                                                        <div class="progress-bar" role="progressbar" style="width: {{$totalRatings > 0 ? ($countRatings[1]/$totalRatings) * 100 : 0}}%;" aria-valuemin="0" aria-valuemax="100">{{number_format($totalRatings > 0 ? ($countRatings[1]/$totalRatings) * 100 : 0, 2)}}%</div>
                                                    </div>
                                                    <div class="progress mb-30">
                                                        <span>1 sao</span>
                                                        <div class="progress-bar" role="progressbar" style="width: {{$totalRatings > 0 ? ($countRatings[0]/$totalRatings) * 100 : 0}}%;" aria-valuemin="0" aria-valuemax="100">{{number_format($totalRatings > 0 ? ($countRatings[0]/$totalRatings) * 100 : 0, 2)}}%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                
                            
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30">Sản Phẩm Liên Quan</h3>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                        @foreach($rproducts as $rproduct)
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{route('product.details',['slug'=>$rproduct->slug])}}" tabindex="0">
                                                            <img class="default-img" src="{{asset('assets/imgs/products/products')}}/{{$rproduct->image}}" alt="{{$rproduct->name}}">
                                                            <img class="hover-img" src="{{asset('assets/imgs/products/products')}}/{{$rproduct->image}}" alt="{{$rproduct->name}}">
                                                        </a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">Hot</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="{{route('product.details',['slug'=>$rproduct->slug])}}" tabindex="0">{{substr($rproduct->name,0,60)}}</a></h2>
                                                    
                                                    <div class="product-price">
                                                        <span>{{number_format($product->regular_price)}} VND</span>
                                                        <!-- <span class="old-price">$245.8</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                      
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <!-- <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                <li><a href="shop.html">Shoes & Bags</a></li>
                                <li><a href="shop.html">Blouses & Shirts</a></li>
                                <li><a href="shop.html">Dresses</a></li>
                                <li><a href="shop.html">Swimwear</a></li>
                                <li><a href="shop.html">Beauty</a></li>
                                <li><a href="shop.html">Jewelry & Watch</a></li>
                                <li><a href="shop.html">Accessories</a></li>
                            </ul>
                        </div> -->
                        <!-- Fillter By Price -->
                       
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Sản Phẩm Mới</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @foreach($nproducts as $nproduct)
                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="{{asset('assets/imgs/products/products')}}/{{$nproduct->image}}" alt="{{$nproduct->name}}">
                                </div>
                                <div class="content pt-10">
                                    <h5><a href="{{route('product.details',['slug'=>$nproduct->slug])}}">{{substr($nproduct->name,0,50)}}...</a></h5>
                                    <p class="price mb-0 mt-5">{{number_format($product->regular_price)}} VND</p>
                                    
                                </div>
                            </div>
                            @endforeach
                           
                        </div>                        
                    </div>
                </div>
            </div>
        </section>
        @endif
    </main>
    @livewireScripts
</div>
@push('scripts')
    <script>

        function addToCart(name) {
            alert("sản phẩm "+ name +" đã hết hàng");
        }
        var sliderrange = $('#slider-range');
        var amountprice = $('#amount');
        $(function() {
            sliderrange.slider({
                range: true,
                min: 10000,
                max: 900000,
                values: [10000, 900000],
                slide: function(event, ui) {
                    
                    @this.set('min_value',ui.values[0]);
                    @this.set('max_value',ui.values[1]);
                }
            });
        }); 
    </script>
    <script>
        function setRating(rating) {
            // document.getElementById('selectedRating').innerText = 'Đánh giá: ' + rating + ' sao';

            for (let i = 1; i <= 5; i++) {
                document.getElementById('label' + i).style.color = '#ccc';
            }

            for (let i = 1; i <= rating; i++) {
                document.getElementById('label' + i).style.color = 'gold';
            }
        }
    </script>
@endpush