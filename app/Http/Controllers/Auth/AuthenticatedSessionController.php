<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Languages;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Utility;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */


    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;



    public function __construct()
    {
        if (!file_exists(storage_path() . "/installed")) {
            header('location:install');
            die;
        }
        $settings = Utility::settings();
        if($settings['recaptcha_module'] == 'yes')
        {
            config(['captcha.secret'  => $settings['google_recaptcha_secret']]);
            config(['captcha.sitekey' => $settings['google_recaptcha_key']]);
        }
    }

    protected function authenticated(Request $request, $user)
    {
    }


    public function create()
    {
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
        $settings = Utility::settings();
        $lang = !empty($settings['default_language']) ? $settings['default_language'] : 'en';
        if ($settings['recaptcha_module'] == 'yes') {
            $validation['g-recaptcha-response'] = 'required|captcha';
        } else {
            $validation = [];
        }
        $this->validate($request, $validation);
        $request->authenticate();

        $request->session()->regenerate();
        $user = \Auth::user();

        if (isset($user->is_active) && $user->is_active == 0 || isset($user->is_enable_login) && $user->is_enable_login == 0) {
            auth()->logout();
            return redirect('/login'.'/'.$lang)->with('status', __('Your Account has been Deactivated. Please contact your Site Admin.!'));
        }

        if ($user->type == 'Owner') {
          
            
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }



    public function showLoginForm($lang = '')
    {
        if ($lang == '') {
            $lang = \App\Models\Utility::getValByName('default_language');
        }

        $language_name = Languages::where('code', $lang)->get()->first();

        if (isset($language_name)) {
            \App::setLocale($lang);

            return view('auth.login', compact('lang', 'language_name'));
        } else {
            return redirect()->back();
        }
    }

    public function showLinkRequestForm($lang = '')
    {

        $admin_setting = Utility::settings();
        if (empty($admin_setting['mail_password'] && $admin_setting['mail_username'])) {
            return redirect()->back()->with('error', __('SMTP configuration not found.<br>Please contact your site admin.'));
        }
        if ($lang == '') {
            $lang = \App\Models\Utility::getValByName('default_language');
        }

        $language_name = Languages::where('code', $lang)->get()->first();

            \App::setLocale($lang);
            return view('auth.forgot-password', compact('lang', 'language_name'));
        // } else {
        //     return redirect()->back();
        // }
    }
}
