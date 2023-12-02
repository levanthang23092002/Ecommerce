
<x-app-layout>
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>                    
                    <span></span> Đăng ký tài khoản
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Đăng ký tài khoản</h3>
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
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf

                                            <div>
                                                <x-label for="name" value="{{ __('Họ tên') }}" />
                                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                            </div>

                                            <div class="mt-4">
                                                <x-label for="email" value="{{ __('Email') }}" />
                                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                            </div>

                                            <div class="mt-4">
                                                <x-label for="password" value="{{ __('Mật khẩu') }}" />
                                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                            </div>

                                            <div class="mt-4">
                                                <x-label for="password_confirmation" value="{{ __('Xác nhận mật khẩu') }}" />
                                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                            </div>

                                            <div class="flex mt-20">
                                                <x-button class="me-3">{{ __('Đăng ký') }}</x-button>
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                                    {{ __('Đăng nhập') }}
                                                </a>
                                            </div>
                                        </form>                                     
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-lg-6">
                               <img src="assets/imgs/login.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>