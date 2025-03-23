<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Custom;
use App\Models\Document;
use App\Models\FAQ;
use App\Models\HomePage;
use App\Models\MainStandard;
use App\Models\NoticeBoard;
use App\Models\PackageTransaction;
use App\Models\Page;
use App\Models\Reminder;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\SubStandard;
use App\Models\Support;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // public function index()
    // {
    //     if (\Auth::check()) {
    //         if (\Auth::user()->type == 'super admin') {
    //             $result['totalOrganization'] = User::where('type', 'owner')->count();
    //             $result['totalSubscription'] = Subscription::count();
    //             $result['totalTransaction'] = PackageTransaction::count();
    //             $result['totalIncome'] = PackageTransaction::sum('amount');
    //             $result['totalNote'] = NoticeBoard::where('parent_id', parentId())->count();
    //             $result['totalContact'] = Contact::where('parent_id', parentId())->count();

    //             $result['organizationByMonth'] = $this->organizationByMonth();
    //             $result['paymentByMonth'] = $this->paymentByMonth();

    //             return view('dashboard.super_admin', compact('result'));
    //         } else {
    //             $result['totalUser'] = User::where('parent_id', parentId())->count();
    //             $result['totalDocument'] = Document::where('parent_id', parentId())->count();
    //             $result['todayDocument'] = Document::whereDate('created_at',Carbon::today())->where('parent_id', parentId())->count();
    //             $result['totalCategory'] = Category::where('parent_id', parentId())->count();
    //             $result['totalReminder'] = Reminder::where('parent_id', parentId())->count();
    //             $result['todayReminder'] = Reminder::whereDate('date',Carbon::today())->where('parent_id', parentId())->count();

    //             $result['totalContact'] = Contact::where('parent_id', \Auth::user()->id)->count();

    //             $result['documentByCategory'] = $this->documentByCategory();
    //             $result['documentBySubCategory'] = $this->documentBySubCategory();
    //             $result['settings']=settings();


    //             return view('dashboard.index', compact('result'));
    //         }
    //     } else {
    //         if (!file_exists(setup())) {
    //             header('location:install');
    //             die;
    //         } else {

    //             $landingPage=getSettingsValByName('landing_page');
    //             if($landingPage=='on'){
    //                 $subscriptions=Subscription::get();
    //                 $menus = Page::where('enabled',1)->get();
    //                 $FAQs = FAQ::where('enabled',1)->get();
    //                 return view('layouts.landing',compact('subscriptions', 'menus', 'FAQs'));
    //             }else{
    //                 return redirect()->route('login');
    //             }
    //         }

    //     }

    // }

    // public function index()
    // {
    //     $landingPage=getSettingsValByName('landing_page');
    //     if($landingPage=='on'){
    //         $subscriptions=Subscription::get();
    //         $menus = Page::where('enabled',1)->get();
    //         $FAQs = FAQ::where('enabled',1)->get();
    //         return view('layouts.landing',compact('subscriptions', 'menus', 'FAQs'));
    //     }

    // }

    public function index()
    {

        if (\Auth::check()) {

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
                return view('self-study.dashboard.index', [
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
               
                // return view('self-study.dashboard.index',compact('result'));
            // } else {
            //     return redirect()->back()->with('error', 'Permission denied.');
            // }
        } else {
            return redirect('login');
        }
    }

    public function organizationByMonth()
    {
        $start = strtotime(date('Y-01'));
        $end = strtotime(date('Y-12'));

        $currentdate = $start;

        $organization = [];
        while ($currentdate <= $end) {
            $organization['label'][] = date('M-Y', $currentdate);

            $month = date('m', $currentdate);
            $year = date('Y', $currentdate);
            $organization['data'][] = User::where('type', 'owner')->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
            $currentdate = strtotime('+1 month', $currentdate);
        }


        return $organization;

    }

    public function paymentByMonth()
    {
        $start = strtotime(date('Y-01'));
        $end = strtotime(date('Y-12'));

        $currentdate = $start;

        $payment = [];
        while ($currentdate <= $end) {
            $payment['label'][] = date('M-Y', $currentdate);

            $month = date('m', $currentdate);
            $year = date('Y', $currentdate);
            $payment['data'][] = PackageTransaction::whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('amount');
            $currentdate = strtotime('+1 month', $currentdate);
        }

        return $payment;

    }

    public function documentByCategory()
    {
        $categories=Category::where('parent_id',parentId())->get();
        $documents = [];
        $cat = [];
        foreach ($categories as $category) {
            $documents[] = Document::where('parent_id',parentId())->where('category_id',$category->id)->count();
            $cat[]=$category->title;
        }
        $result['data']=$documents;
        $result['category']=$cat;
        return $result;
    }
    public function documentBySubCategory()
    {
        $categories=SubCategory::where('parent_id',parentId())->get();
        $documents = [];
        $cat = [];
        foreach ($categories as $category) {
            $documents[] = Document::where('parent_id',parentId())->where('category_id',$category->id)->count();
            $cat[]=$category->title;
        }
        $result['data']=$documents;
        $result['category']=$cat;
        return $result;
    }

}
