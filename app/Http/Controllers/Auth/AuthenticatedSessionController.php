<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoggedHistory;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (!file_exists(setup())) {
            header('location:install');
            die;
        }

        $user = \App\Models\User::find(1);
        \App::setLocale($user->lang);

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
      
        $validation = [];
        $this->validate($request, $validation);

        $request->authenticate();
        $request->session()->regenerate();
        $loginUser = Auth::user();
        if ($loginUser->is_active == 0) {
            auth()->logout();
            return redirect()->route('login')->with('error', __('Your account is temporarily inactive. Please contact your administrator to reactivate your account.'));
        }
        if (empty($loginUser->email_verified_at)) {
            auth()->logout();
            return redirect()->route('login')->with('error', __('Verification required: Please check your email to verify your account before continuing.'));
        }
        userLoggedHistory();
       
        return redirect()->intended(RouteServiceProvider::HOME);
    }

//     public function store(Request $request)
//     {
//         $this->validate($request, [
//             'email' => ['required', 'string', 'email'],
//             'password' => ['required', 'string'],
//         ]);

//         if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
//             throw ValidationException::withMessages([
//                 'email' => __('auth.failed'),
//             ]);
//         }

//         $request->session()->regenerate();

//         $user = Auth::user();

//         if ($user->is_active == 0) {
//             Auth::logout();
//             return redirect()->route('login')->with('error', __('Your account is temporarily inactive. Please contact your administrator to reactivate your account.'));
//         }

//         if (empty($user->email_verified_at)) {
//             Auth::logout();
//             return redirect()->route('login')->with('error', __('Verification required: Please check your email to verify your account before continuing.'));
//         }

//         userLoggedHistory();

//         return redirect()->intended(RouteServiceProvider::HOME);
// }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {   
        $usertype= auth()->user()->type;
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
