<?php

namespace App\Http\Controllers;

use App\Models\CustomDomainRequest;
use App\Models\Mail\TestMail;
use App\Models\Plan;
use App\Models\Store;
use App\Models\Utility;
use App\Models\User;
use App\Models\Settings;
use App\Models\PixelFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Artisan;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateLang;
use App\Models\UserEmailTemplate;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            $user  = Auth::user()->current_store;
            $store = Store::where('id', $user)->first();
            \App::setLocale(isset($store->lang) ? $store->lang : 'en');
        }
    }

    public function index()
    {
        if (\Auth::user()->can('Manage Settings')) {
            $settings = Utility::settings();
            if (Auth::user()->type == 'super admin') {
                return view('settings.index', compact('settings'));
            }
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function saveBusinessSettings(Request $request)
    {
        $user = \Auth::user();
        if (\Auth::user()->type == 'super admin') {
            if ($request->dark_logo) {
                $logoName = 'logo-dark.png';
                $dir = 'uploads/logo/';

                $validation = [
                    'mimes:' . 'png',
                    'max:' . '20480',
                ];
                $path = Utility::upload_file($request, 'dark_logo', $logoName, $dir, $validation);
                if ($path['flag'] == 1) {

                    $dark_logo = $path['url'];
                } else {

                    return redirect()->back()->with('error', __($path['msg']));
                }
            }

            if ($request->light_logo) {
                $logoName = 'logo-light.png';
                $dir = 'uploads/logo/';
                $validation = [
                    'mimes:' . 'png',
                    'max:' . '20480',
                ];
                $path = Utility::upload_file($request, 'light_logo', $logoName, $dir, $validation);

                if ($path['flag'] == 1) {
                    $light_logo = $path['url'];
                } else {
                    return redirect()->back()->with('error', __($path['msg']));
                }
            }

            if ($request->favicon) {

                $favicon = 'favicon.png';
                $dir = 'uploads/logo/';
                $validation = [
                    'mimes:' . 'png',
                    'max:' . '20480',
                ];
                $path = Utility::upload_file($request, 'favicon', $favicon, $dir, $validation);
                if ($path['flag'] == 1) {
                    $favicon = $path['url'];
                } else {
                    return redirect()->back()->with('error', __($path['msg']));
                }
            }


            if (!empty($request->title_text) || !empty($request->verification_btn) || !empty($request->footer_text) || !empty($request->default_language) || !empty($request->display_landing_page)) {
                $settings = Utility::settings();
                $post = $request->all();

                if (!isset($request->display_landing_page)) {
                    $post['display_landing_page'] = 'off';
                }

                if (!isset($request->signup_button)) {
                    $post['signup_button'] = 'off';
                }
                if (!isset($request->verification_btn)) {
                    $post['verification_btn'] = 'off';
                }

                if (!isset($request->cust_darklayout)) {
                    $post['cust_darklayout'] = 'off';
                } else {
                    $post['cust_darklayout'] = 'on';
                }

                if (!isset($request->cust_theme_bg)) {
                    $post['cust_theme_bg'] = 'off';
                } else {
                    $post['cust_theme_bg'] = 'on';
                }

                if (isset($request->color) && $request->color_flag == 'false') {
                    $post['color'] = $request->color;
                } else {
                    $post['color'] = $request->custom_color;
                }
                $post['color_flag'] = $request->color_flag;

                if (!isset($request->SITE_RTL)) {
                    $post['SITE_RTL'] = 'off';
                } else {
                    $post['SITE_RTL'] = 'on';
                }

                unset($post['_token'], $post['dark_logo'], $post['light_logo'], $post['small_logo'], $post['favicon']);
                foreach ($post as $key => $data) {
                    $settings = Utility::settings();
                    if (in_array($key, array_keys($settings))) {
                        \DB::insert(
                            'insert into settings (`value`, `name`,`created_by`,`store_id`) values (?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                            [
                                $data,
                                $key,
                                $user->creatorId(),
                                '0',
                            ]
                        );
                    }
                }
            }

      
        }
        return redirect()->back()->with('success', __('Business setting successfully saved.') . ((isset($result) && $result != 1) ? '<br> <span class="text-danger">' . $result . '</span>' : ''));
    }
    public function saveFacilitySettings(Request $request)
    {
        $user = \Auth::user();
        if (\Auth::user()->type == 'super admin') {
            
            // Validate Request Data
            $validated = $request->validate([
                'facility_name_ar' => 'nullable|string|max:255',
                'facility_name_en' => 'nullable|string|max:255',
                'vision_ar' => 'nullable|string',
                'vision_en' => 'nullable|string',
                'goals_ar' => 'nullable|string',
                'goals_en' => 'nullable|string',
                'report_guidelines_ar' => 'nullable|string',
                'report_guidelines_en' => 'nullable|string',
                'contact_name_ar' => 'nullable|string|max:255',
                'contact_name_en' => 'nullable|string|max:255',
                'contact_position_ar' => 'nullable|string|max:255',
                'contact_position_en' => 'nullable|string|max:255',
                'report_date' => 'nullable|date',
                'report_preparer_name' => 'nullable|string|max:255',
                'contact_email' => 'nullable|email|max:255',
                'contact_phone' => 'nullable|string|max:20',
            ]);

            // Save or Update Settings in the Database
            foreach ($validated as $key => $value) {
                DB::insert(
                    'INSERT INTO settings (`value`, `name`, `created_by`, `store_id`) VALUES (?, ?, ?, ?) 
                    ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)',
                    [
                        $value,
                        $key,
                        $user->creatorId(),
                        '0', // Assuming global settings (store_id = 0)
                    ]
                );
            }

      
        }
        return redirect()->back()->with('success', __('Business setting successfully saved.') . ((isset($result) && $result != 1) ? '<br> <span class="text-danger">' . $result . '</span>' : ''));
    }


}
