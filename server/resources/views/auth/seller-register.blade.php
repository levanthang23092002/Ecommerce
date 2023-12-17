<x-app-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Đăng ký tài khoản bán hàng
                </div>
            </div>
        </div>
        <section class="pt-3 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Đăng ký tài khoản bán hàng</h3>
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
                                        <form method="POST" action="{{ route('seller.register') }}">
                                            @csrf

                                            <div>
                                                <x-label for="name" value="{{ __('Họ tên') }}" />
                                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                                    :value="old('name')" required autofocus autocomplete="name" />
                                            </div>

                                            <div class="mt-4">
                                                <x-label for="email" value="{{ __('Email') }}" />
                                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                                    :value="old('email')" required autocomplete="username" />
                                            </div>

                                            <div class="mt-4">
                                                <x-label for="password" value="{{ __('Mật khẩu') }}" />
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

                                            <div class="mt-4">
                                                <x-label for="" value="{{ __('Địa chỉ shipper nhận hàng') }}" />
                                                <div class="form-group d-flex gap-3">

                                                    <select class="form-control form-select form-select-sm" name="city"
                                                        id="city" required aria-label=".form-select-sm">
                                                        <option value="" selected disabled>Chọn tỉnh
                                                            thành *
                                                        </option>
                                                    </select>

                                                    <select class="form-control form-select form-select-sm"
                                                        name="district" id="district" required
                                                        aria-label=".form-select-sm">
                                                        <option value="" selected disabled>Chọn quận
                                                            huyện *
                                                        </option>
                                                    </select>

                                                    <select class="form-control form-select form-select-sm" name="ward"
                                                        id="ward" required aria-label=".form-select-sm">
                                                        <option value="" selected disabled>Chọn phường xã
                                                            *</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" name="address" required
                                                        placeholder="Số nhà, tên đường *" value="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                        <label>SĐT <span class="required">*</span></label>

                                                        <input required type="tel" name="phone" pattern="[0-9]{10,11}"
                                                            placeholder="Số điện thoại *"
                                                            >
                                                    </div>
                                            <div class="flex mt-20">
                                                <x-button class="me-3">{{ __('Đăng ký') }}</x-button>
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    href="{{ route('login') }}">
                                                    {{ __('Đăng nhập') }}
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <img src="{{asset('assets/imgs/login.jpg')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var cities = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
        renderCity(result.data);

    });

    function renderCity(data) {
        for (const x of data) {
            cities.options[cities.options.length] = new Option(x.Name, x.Name);
        }
        cities.onchange = function () {
            district.length = 1;
            ward.length = 1;
            if (this.value != "") {
                const result = data.filter(n => n.Name === this.value);

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Name);
                }
            }
        };
        district.onchange = function () {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Name === cities.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Name);
                }
            }
        };
    }

</script>