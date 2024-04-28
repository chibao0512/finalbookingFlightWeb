<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use App\Helpers\MailHelper;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function forgotPassword()
    {
        return view('page.auth.forgot_password');
    }

    public function potForgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Thông tin tài khoản không tồn tại');
        }

        try {
            $passwordNew = randString(8);
            $user->password = bcrypt($passwordNew);

            if ($user->save()) {

                MailHelper::sendMail($user, $passwordNew);
            }
            return redirect()->back()->with('success', 'Mật khẩu được gửi thành công tới mail của bạn');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể lấy lại mật khẩu');
        }
    }
}
