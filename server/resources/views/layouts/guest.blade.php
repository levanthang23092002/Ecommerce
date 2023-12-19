<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang Quản Lý</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/favicon.ico') }}">


    <!-- Favicon -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="{{route('admin.dashboard')}}" class="navbar-brand mx-4 mb-3">
                @auth
                    @if(Auth::user()->utype == 'SELLER')
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Quản lý shop</h3>
                    @else
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Trang Admin</h3>
                    @endif
                @endif
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ Auth::user()->profile_photo_path ? asset('assets/imgs/products/avatars/' .  Auth::user()->profile_photo_path) :  asset('assets/imgs/admin.png/')}}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>

                        <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a href="{{ route('logout') }}"
                                                        onClick="event.preventDefault(); this.closest('form').submit();">Đăng xuất</a>
                                                </form>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                @auth
                    @if(Auth::user()->utype == 'SELLER')
                    <a href="{{route('shop', ['seller_id' => Auth::user()->id])}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Shop</a>

                    <a href="{{route('seller.products')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Sản phẩm</a>
                    <a href="{{route('seller.orders')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Đơn hàng</a>

                    <a href="{{route('seller.dashboard')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Thống kê</a>
                    @else
                    
                    <a href="/" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Trang chủ</a>
                    <a href="{{route('admin.publishers')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Nhà phát hành</a>
                    <a href="{{route('admin.categories')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Danh mục</a>
                    <a href="{{route('admin.dashboard')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Thống kê</a>
                    @endif
                @endif
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            
            {{$slot}}
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main2.js') }}"></script>
    
</body>

</html>