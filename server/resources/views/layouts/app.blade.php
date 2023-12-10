<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Bookstore</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @livewireScripts
</head>

<body>
    
    <header class="header-area header-style-1 header-height-2">
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="/"><img src="{{ asset('assets/imgs/logo/logo.png')}}" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        @livewire('search')
                        <div class="header-action-right">
                            <div class="header-action-2">
                                @livewire('wishlist-icon-component')
                                @livewire('cart-icon-component')
                                
                                            <div class="search-style-1">

                                    </div>
                                <div class="header-action-right">
                                    <div class="header-action-2">
                                        @auth
                                        
                                        <ul style="font-size: 16px;text-align: center;">
                                            <li><img src="{{ Auth::user()->profile_photo_path ?? asset('assets/imgs/logo/person.png')}}" width="20" height="20" style="margin-right:3px; border-radius: 50%;"> {{ Auth::user()->name }} 
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a href="{{ route('logout') }}"
                                                        onClick="event.preventDefault(); this.closest('form').submit();">Đăng xuất</a>
                                                </form>
                                            </li>
                                        </ul>
                                        @else
                                        <img src="{{ asset('assets/imgs/login.png')}}" width="17" height="17" style="margin-right:2px;margin-bottom:1px"><a href="{{ route('login') }}">
                                        <ul style="font-size: 16px;">
                                            <li> Đăng nhập </a> /
                                                <a href="{{ route('register') }}">Đăng ký</a></li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom header-bottom-bg-color sticky-bar">
                    <div class="container">
                        <div class="header-wrap header-space-between position-relative">
                            <div class="logo logo-width-1 d-block d-lg-none">
                                <a href="index.html"><img src="assets/imgs/logo/logo.png" alt="logo"></a>
                            </div>
                            <div class="header-nav d-none d-lg-flex">

                                <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                                    <nav>
                                        <ul>
                                            <li><a class="active" href="/">Trang chủ </a></li>
                                            <li class="position-static"><a href="#">Danh mục <i
                                                        class="fi-rs-angle-down"></i></a>
                                                <ul class="mega-menu">
                                                    <li class="sub-mega-menu sub-mega-menu-width-22">
                                                        <a class="menu-title" href="#">Truyện chữ</a>
                                                        <ul>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-chu-han-quoc']) }}">Truyện chữ Hàn Quốc</a>
                                                            </li>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-chu-nhat-ban']) }}">Truyện chữ Nhật Bản</a>
                                                            </li>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-chu-phuong-tay']) }}">Truyện chữ Phương Tây</a>
                                                            </li>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-chu-viet-nam']) }}">Truyện chữ Việt Nam</a>
                                                            </li>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-chu-trung-quoc']) }}">Truyện chữ Trung Quốc</a>
                                                            </li>

                                                        </ul>
                                                    </li>
                                                    <li class="sub-mega-menu sub-mega-menu-width-22">
                                                        <a class="menu-title" href="#">Truyện tranh</a>
                                                        <ul>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-tranh-han-quoc']) }}">Truyện tranh Hàn Quốc</a>
                                                            </li>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-tranh-nhat-ban']) }}">Truyện tranh Nhật Bản</a>
                                                            </li>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-tranh-phuong-tay']) }}">Truyện tranh Phương
                                                                    Tây</a></li>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-tranh-viet-nam']) }}">Truyện tranh Việt Nam</a>
                                                            </li>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-tranh-trung-quoc']) }}">Truyện tranh Trung
                                                                    Quốc</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="sub-mega-menu sub-mega-menu-width-22">
                                                        <a class="menu-title" href="#">Khác</a>
                                                        <ul>
                                                            <li><a href="{{ route('product.category', ['slug' => 'art-book']) }}">Art Book</a></li>
                                                            <li><a href="{{ route('product.category', ['slug' => 'truyen-chon-bo']) }}">Truyện chọn bộ</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            @auth
                                                @if(Auth::user()->utype == 'USR')
                                                 <li><a href="#">Tài khoản<i class="fi-rs-angle-down"></i></a>
                                                
                                                    <ul class="sub-menu">
                                                        <li><a href="{{route('profile.edit')}}">Trang cá nhân</a></li>
                                                    </ul>

                                                </li>
                                                @endif
                                            @endif

                                            <li><a href="{{route('shop')}}">Mua sắm</a></li>
                                            <li><a href="{{route('about')}}">Về website</a></li>
                                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="hotline d-none d-lg-block">
                                <p><i class="fi-rs-smartphone"></i><span>Liên hệ</span> (+84) 0966-948-914 </p>
                            </div>
                        
                        </div>
                    </div>
                </div>
    </header>
    

    {{$slot}}

    <footer class="main">
        <section class="newsletter p-30 text-white wow fadeIn animated">
            <div class="container">
                <div class="row align-items-center">
                    
                </div>
            </div>
        </section>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="/"><img src="{{ asset('assets/imgs/logo/logo.png')}}" alt="logo"></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                            <p class="wow fadeIn animated">
                                <strong>Địa chỉ: </strong>48 Cao Thắng - Hải Châu - Đà Nẵng
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Số điện thoại: </strong>+84 966-948-914
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Email: </strong>levanthang230902@gmail.com
                            </p>
                            <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Theo dõi chúng tôi</h5>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-youtube.svg')}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">Thông tin</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li><a href="{{route('about')}}">Về chúng tôi</a></li>
                            <li><a href="#">Thông tin vận chuyển</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Các điều khoản</a></li>
                            <li><a href="#">Liên hệ</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-3">
                        <h5 class="widget-title wow fadeIn animated">Tài khoản</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="my-account.html">Thông tin tài khoản</a></li>
                            <li><a href="{{route('shop.cart')}}">Xem giỏ hàng</a></li>
                            <li><a href="#">Xem sản phẩm yêu thích</a></li>
                            <li><a href="#">Theo dõi đơn hàng</a></li>
                            <li><a href="{{route('user.checkout')}}">Đơn hàng</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 mob-center">
                        <h5 class="widget-title wow fadeIn animated">Cài đặt App</h5>
                        <div class="row">
                            <div class="col-md-8 col-lg-12">
                                <p class="wow fadeIn animated">Từ App Store hoặc Google Play</p>
                                <div class="download-app wow fadeIn animated mob-app">
                                    <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active"
                                            src="{{ asset('assets/imgs/theme/app-store.jpg')}}" alt=""></a>
                                    <a href="#" class="hover-up"><img src="{{ asset('assets/imgs/theme/google-play.jpg')}}"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                                <p class="mb-20 wow fadeIn animated">Các phương thức thanh toán</p>
                                <img class="wow fadeIn animated" src="{{ asset('assets/imgs/theme/payment-method.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated mob-center">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">
                        <a href="privacy-policy.html">Chính sách bảo mật</a> | <a href="terms-conditions.html">Điều khoản sử dụng</a>
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                    Thuộc quyền sở hửu &copy; <strong class="text-brand">TTT</strong> 
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Vendor JS-->
    <script src="{{ asset ('assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{ asset ('assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset ('assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{ asset ('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/slick.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/wow.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/jquery-ui.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/counterup.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/images-loaded.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/isotope.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{ asset ('assets/js/plugins/jquery.elevatezoom.js')}}"></script>
    <!-- Template  JS -->
    <script src="{{ asset ('assets/js/main.js?v=3.3')}}"></script>
    <script src="{{ asset ('assets/js/shop.js?v=3.3')}}"></script>
    
  
  <!-- Messenger Plugin chat Code -->
        <!-- Messenger Plugin chat Code -->
            <div id="fb-root"></div>

        <!-- Your Plugin chat code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>
        <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "164229313445795");
        chatbox.setAttribute("attribution", "biz_inbox");
        </script>

        <!-- Your SDK code -->
        <script>
        window.fbAsyncInit = function() {
            FB.init({
            xfbml            : true,
            version          : 'v18.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>
        @livewireStyles
        @stack('scripts')
     
        
</body>

</html>