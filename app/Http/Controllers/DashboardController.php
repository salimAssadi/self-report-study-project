<?php

namespace App\Http\Controllers;

use App\Models\MainStandard;
use App\Models\SubStandard;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Spatie\Permission\Models\Role;
use File;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (\Auth::check()) {
            if (\Auth::user()->can('Manage Dashboard')) {

                // Fetch total standards
                $totalUsers = User::count();
                $totalMainStandards = MainStandard::count();
                $totalSubStandards = SubStandard::count();

                // Fetch total criteria
                $totalCriteria = \App\Models\Criterion::count();

                // Fetch fulfillment statuses
                $fulfillmentStatuses = DB::table('criteria')
                    ->select('fulfillment_status', DB::raw('count(*) as count'))
                    ->groupBy('fulfillment_status')
                    ->get()
                    ->keyBy('fulfillment_status'); 

                // Default values for fulfillment statuses
                $notFulfilled = $fulfillmentStatuses['1']->count ?? 0;
                $partiallyFulfilled = $fulfillmentStatuses['2']->count ?? 0;
                $fulfilled = $fulfillmentStatuses['3']->count ?? 0;
                $fulfilledWithPrecision = $fulfillmentStatuses['4']->count ?? 0;
                $fulfilledWithExcellence = $fulfillmentStatuses['5']->count ?? 0;
                // Pass data to the view
                return view('home', [
                    'totalUsers' => $totalUsers,
                    'totalMainStandards' => $totalMainStandards,
                    'totalSubStandards' => $totalSubStandards,
                    'totalCriteria' => $totalCriteria,
                    'notFulfilled' => $notFulfilled,
                    'partiallyFulfilled' => $partiallyFulfilled,
                    'fulfilled' => $fulfilled,
                    'fulfilledWithPrecision' => $fulfilledWithPrecision,
                    'fulfilledWithExcellence' => $fulfilledWithExcellence,
                ]);
            } else {
                return redirect()->back()->with('error', 'Permission denied.');
            }
        } else {
            return redirect('login');
        }
    }

    // public function getOrderChart($arrParam)
    // {
    //     $user        = Auth::user();
    //     $userstore   = UserStore::where('store_id', $user->current_store)->first();
    //     $arrDuration = [];
    //     if ($arrParam['duration']) {
    //         if ($arrParam['duration'] == 'week') {
    //             $previous_week = strtotime("-1 week +1 day");
    //             for ($i = 0; $i < 7; $i++) {
    //                 $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
    //                 $previous_week                              = strtotime(date('Y-m-d', $previous_week) . " +1 day");
    //             }
    //         }
    //     }

    //     $arrTask          = [];
    //     $arrTask['label'] = [];
    //     $arrTask['data']  = [];
    //     foreach ($arrDuration as $date => $label) {
    //         if (Auth::user()->type == 'Owner') {
    //             $data = Order::select(\DB::raw('count(*) as total'))->where('user_id', $userstore->store_id)->whereDate('created_at', '=', $date)->first();
    //         } else {
    //             $data = Order::select(\DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
    //         }

    //         $arrTask['label'][] = $label;
    //         $arrTask['data'][]  = $data->total;
    //     }

    //     return $arrTask;
    // }

    public function stripe(Request $request)
    {
        $price   = 100;
        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
        $payment_setting = Utility::getAdminPaymentSetting();
        if ($price > 0.0) {
            Stripe\Stripe::setApiKey(!empty($payment_setting['stripe_secret']) ? $payment_setting['stripe_secret'] : '');
            $data = Stripe\Charge::create(
                [
                    "amount" => 100 * $price,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => " Test Plan ",
                    "metadata" => ["order_id" => $orderID],
                ]
            );
        }
    }

    public function check() {}

    public function profile()
    {
        $userDetail = \Auth::user();

        return view('profile', compact('userDetail'));
    }

    public function editprofile(Request $request)
    {
        $userDetail = \Auth::user();

        $user = User::findOrFail($userDetail['id']);
        $this->validate(
            $request,
            [
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users,email,' . $userDetail['id'],
                // 'profile' => 'required',
            ]
        );

        if ($request->hasFile('profile')) {
            $image_size = $request->file('profile')->getSize();
            $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size);
            if ($result == 1) {
                $filenameWithExt = $request->file('profile')->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $request->file('profile')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $settings = Utility::getStorageSetting();
                // $settings = Utility::settings();
                $dir        = 'uploads/profile';

                $image_path = $dir . $userDetail['avatar'];
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $path = Utility::upload_file($request, 'profile', $fileNameToStore, $dir, []);
                if ($path['flag'] == 1) {
                    $url = $path['url'];
                } else {
                    return redirect()->back()->with('error', __($path['msg']));
                }
            } else {
                return redirect()->back()->with('error', 'Plan storage limit is over so please upgrade the plan.');
            }
        }

        if (!empty($request->profile)) {
            $user['avatar'] = $fileNameToStore;
        }
        $user['name']  = $request['name'];
        $user['email'] = $request['email'];
        $user->save();


        return redirect()->back()->with('success', __('Profile successfully updated.'));
    }

    public function updatePassword(Request $request)
    {
        if (\Auth::Check()) {
            $request->validate(
                [
                    'current_password' => 'required',
                    'new_password' => 'required|min:6',
                    'confirm_password' => 'required|same:new_password',
                ]
            );
            $objUser          = \Auth::user();
            $request_data     = $request->All();
            $current_password = $objUser->password;
            if (Hash::check($request_data['current_password'], $current_password)) {
                $user_id            = \Auth::User()->id;
                $obj_user           = User::find($user_id);
                $obj_user->password = Hash::make($request_data['new_password']);;
                $obj_user->save();

                return redirect()->route('profile', $objUser->id)->with('success', __('Password successfully updated.'));
            } else {
                return redirect()->route('profile', $objUser->id)->with('error', __('Please enter correct current password.'));
            }
        } else {
            return redirect()->route('profile', \Auth::user()->id)->with('error', __('Something is wrong.'));
        }
    }

    public function changeMode()
    {
        $usr = Auth::user();
        if ($usr->mode == 'light') {
            $usr->mode = 'dark';
        } else {
            $usr->mode = 'light';
        }
        $usr->save();

        return redirect()->back();
    }
}
