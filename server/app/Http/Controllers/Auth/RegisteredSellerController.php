<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredSellerController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.seller-register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class, 'ends_with:@gmail.com'],
            'phone' => ['required', 'numeric', 'digits_between:10,11'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
            'ward' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
        ], [
            'required' => 'Trường :attribute là bắt buộc.',
            'string' => 'Trường :attribute phải là một chuỗi.',
            'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
            'numeric' => 'Trường :attribute phải là một số.',
            'digits_between' => 'Trường :attribute phải có độ dài từ :min đến :max chữ số.',
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.string' => 'Địa chỉ email phải là một chuỗi ký tự.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá 255 ký tự.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'email.ends_with' => 'Địa chỉ email phải là địa chỉ Gmail.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.*' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
        ], [
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'ward' => 'Phường/Xã',
            'district' => 'Quận/Huyện',
            'city' => 'Thành phố',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'order_email' => $request->email,
            'password' => Hash::make($request->password),
            'utype' => 'SELLER',
            'address' => $request['address'] . ',' . $request['ward'] . ',' . $request['district'] . ',' . $request['city'],
            'phone' => $request['phone']
        ]);

        event(new Registered($user));

        Auth::login($user);
        return redirect()->route('verification.notice');
        // return redirect(RouteServiceProvider::HOME);
    }
}
