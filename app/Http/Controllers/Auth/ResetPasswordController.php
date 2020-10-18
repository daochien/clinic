<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6|max:20',
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'email' => __('auth.email_title'),
            'password' => __('auth.password_title'),
            'password.min' => __('auth.reset_pwd.validate.min_6'),
            'password.max' => __('auth.reset_pwd.validate.max_20'),
            'password.confirmed' => __('auth.reset_pwd.validate.confirmed'),
        ];
    }

    public function resetPasswordByApp(Request $request, $token)
    {
        $email = $request->input('email');
        if (empty($token) || empty($email)) {
            return null;
        }
        $user  = User::where('email', $email)->first();

        if (!$user->isMobileUser()) {
            return null;
        }
        $resetUrl = env('APP_MOBILE_ID') . "://password_reset/{$token}?email={$email}";

        return view('auth.passwords.mobile.reset')->with(['resetUrl' => $resetUrl]);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);
        $user->save();
        event(new PasswordReset($user));
    }
}
