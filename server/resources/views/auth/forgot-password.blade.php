<x-app-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Quên mật khẩu
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
                                            <h3 class="mb-30">Nhập email tài khoản của bạn</h3>
                                        </div>
                                        @if (session('status'))
                                        <div class="alert alert-success mt-3 mb-3">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                        @if ($errors->any())
                                        <div class="alert alert-danger mt-3 mb-3">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf

                                            <div class="block">
                                                <x-label for="email" value="{{ __('Email') }}" />
                                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                                    :value="old('email')" required autofocus autocomplete="username" />
                                            </div>

                                            <div class="flex items-center justify-end mt-4">
                                                <x-button>
                                                    {{ __('Gửi yêu cầu cấp lại mật khẩu') }}
                                                </x-button>
                                            </div>
                                        </form>
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