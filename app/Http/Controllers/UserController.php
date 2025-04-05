<?php

namespace App\Http\Controllers;

use App\Models\LoggedHistory;
use App\Models\Notification;
use App\Models\PackageTransaction;
use App\Models\Standard;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('Manage User')) {
            if (\Auth::user()->type == 'super admin') {
                $users = User::get();
                return view('self-study.user.index', compact('users'));
            
            } else {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
    }


    public function create()
    {
        $standards = Standard::whereNull('parent_id')->get();
        $userRoles = Role::whereNotIn('name', ['tenant', 'maintainer'])->get()->pluck('name', 'id');
        return view('self-study.user.create', compact('userRoles','standards'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('Create User')) {
            if (\Auth::user()->type == 'super admin') {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                        'email' => 'required|email|unique:users',
                        'password' => 'required|min:6',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $userRole = Role::findById($request->role);
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = \Hash::make($request->password);
                $user->type = $userRole->name;
                $user->email_verified_at = now();
                $user->avatar = 'avatar.png';
                $user->lang = 'english';
                $user->save();
                $user->assignRole($userRole);


                return redirect()->route('admin.users.index')->with('success', __('User successfully created.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(User $user)
    {   
        if (!\Auth::user()->can('show user')) {
            return redirect()->back()->with('error', __('Permission Denied.'));
        } else {
            $settings = settings();
            $transactions = PackageTransaction::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
            $subscriptions = Subscription::get();
            return view('user.show', compact('user', 'transactions','settings', 'subscriptions'));
        }
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $standards = Standard::whereNull('parent_id')->get();
        $userRoles = Role::whereNotIn('name', ['tenant', 'maintainer'])->get()->pluck('name', 'id');

        return view('self-study.user.edit', compact('user', 'userRoles','standards'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('Edit User')) {
                
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                        'email' => 'required|email|unique:users,email,' . $id,
                        'role' => 'required',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $userRole = Role::findById($request->role);
                $user = User::findOrFail($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->type = $userRole->name;
                $user->save();
                $user->roles()->sync($userRole);
                return redirect()->route('admin.users.index')->with('success', 'User successfully updated.');
            
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete user')) {
            $user = User::find($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', __('User successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function loggedHistory()
    {
        $ids = parentId();
        $authUser = \App\Models\User::find($ids);
        $subscription = \App\Models\Subscription::find($authUser->subscription);

        if (\Auth::user()->can('manage logged history') && $subscription->enabled_logged_history == 1) {
            $histories = LoggedHistory::where('parent_id', parentId())->get();
            return view('logged_history.index', compact('histories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function loggedHistoryShow($id)
    {
        if (\Auth::user()->can('manage logged history')) {
            $histories = LoggedHistory::find($id);
            return view('logged_history.show', compact('histories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function loggedHistoryDestroy($id)
    {
        if (\Auth::user()->can('delete logged history')) {
            $histories = LoggedHistory::find($id);
            $histories->delete();
            return redirect()->back()->with('success', 'Logged history succefully deleted.');
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
