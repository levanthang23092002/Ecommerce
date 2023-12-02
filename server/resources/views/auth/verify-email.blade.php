<x-app-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Xác thực email
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-5">
                                <div
                                    class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Xác thực email</h3>
                                        </div>
                                        @if ($errors->any())
                                        <div class="alert alert-danger mt-3 mb-3">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <div class="mb-4 text-sm text-gray-600">
                                            Trước khi tiếp tục, Vui lòng xác thực email của bạn theo hướng dẫn vừa được gửi đến hòm thư {{Auth::user()->email}}. (Hãy kiểm tra trong mục spam nếu bạn không nhận được thư của chúng tôi)
                                        </div>

                                        @if (session('status') == 'verification-link-sent')
                                        <div class="alert alert-success mt-3 mb-3">
                                            Đã gửi email xác thực mới. Vui lòng kiểm tra hòm thư của bạn.
                                        </div>
                                        @endif

                                        <div class="mt-4 flex items-center justify-between">
                                            <form method="POST" action="{{ route('verification.send') }}">
                                                @csrf
                                                <div>
                                                    <x-button type="submit">
                                                        {{ __('Gửi lại email xác thực') }}
                                                    </x-button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                <img src="assets/imgs/login.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>