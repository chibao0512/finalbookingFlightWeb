<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Hash;

class ChangePassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //


    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $user = User::find(\Auth::guard('users')->user()->id);
        $checkPass = Hash::check($value, $user->password);

        if($checkPass) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mật khẩu hiện tại không trùng khớp';
    }
}
