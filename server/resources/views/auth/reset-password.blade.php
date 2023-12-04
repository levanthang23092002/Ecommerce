<x-app-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Đổi mật khẩu
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
                                            <h3 class="mb-30">Đổi mật khẩu</h3>
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
                                        <form method="POST" action="{{ route('password.store') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                            <x-input id="email" class="block mt-1 w-full" type="hidden" name="email"
                                                :value="old('email', $request->email)" required autofocus
                                                autocomplete="username" />

                                            <div class="mt-4">
                                                <x-label for="password" value="{{ __('Mật khẩu mới') }}" />
                                                <x-input id="password" class="block mt-1 w-full" type="password"
                                                    name="password" required autocomplete="new-password" />
                                            </div>

                                            <div class="mt-4">
                                                <x-label for="password_confirmation"
                                                    value="{{ __('Xác nhận mật khẩu') }}" />
                                                <x-input id="password_confirmation" class="block mt-1 w-full"
                                                    type="password" name="password_confirmation" required
                                                    autocomplete="new-password" />
                                            </div>

                                            <div class="flex items-center justify-end mt-4">
                                                <x-button>
                                                    {{ __('Đổi mật khẩu') }}
                                                </x-button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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