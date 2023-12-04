<?php

namespace App\Http\Controllers;

use App\Http\Livewire\user\UserProfileComponent;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return App::call(UserProfileComponent::class);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->all();
        $request->user()->fill($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'order_email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric', 'digits_between:10,11'],
            'address' => ['required', 'string', 'max:255'],
            'ward' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'order_email.required' => 'Vui lòng nhập địa chỉ email.',
            'order_email.string' => 'Địa chỉ email phải là một chuỗi ký tự.',
            'order_email.email' => 'Địa chỉ email không hợp lệ.',
            'order_email.max' => 'Địa chỉ email không được vượt quá 255 ký tự.',
            'required' => 'Trường :attribute là bắt buộc.',
            'string' => 'Trường :attribute phải là một chuỗi.',
            'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
            'numeric' => 'Trường :attribute phải là một số.',
            'digits_between' => 'Trường :attribute phải có độ dài từ :min đến :max chữ số.',
        ],[
            'name' => 'Họ tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'ward' => 'Phường/Xã',
            'district' => 'Quận/Huyện',
            'city' => 'Thành phố',
        ]));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->address = $data['address'] . ',' . $data['ward'] . ',' . $data['district'] . ',' . $data['city'];

        $request->user()->save();

        return Redirect::route('user.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
