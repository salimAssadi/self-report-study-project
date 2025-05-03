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
use Illuminate\Support\Facades\DB;

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
        if (!\Auth::user()->can('Create User')) {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        $roles = Role::pluck('name', 'id');
        $standards = Standard::whereNull('parent_id')->with('children')->get();
        return view('self-study.user.create', compact('roles', 'standards'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'standards' => 'nullable|array',
            'standards.*' => 'exists:standards,id',
            'is_active' => 'required|in:0,1',
        ]);

        DB::transaction(function () use ($validated, $request) {
            // Generate a random unique username
            // $username = generateUniqueUsername();
            
            $user = User::create([
                'full_name' => $validated['name'],
                'email' => $validated['email'] ?? null,
                'user_name' => $validated['user_name'],
                'password' => Hash::make($validated['password']),
                'email_verified_at' => now(),
                'is_enable_login' => true,
                'is_active' => $validated['is_active'],
            ]);
            $role = Role::find($validated['role']);
            if ($role) {
                $user->assignRole($role->name);
            }
            if ($request->has('standards')) {
                $user->standards()->attach($request->standards);
            }
        });

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    public function show(User $user)
    {   
        if (!\Auth::user()->can('Show User')) {
            return redirect()->back()->with('error', __('Permission Denied.'));
        } else {
            $settings = settings();
            return view('self-study.user.show', compact('user', 'settings'));
        }
    }


    public function edit(User $user)
    {
        if (!\Auth::user()->can('Edit User')) {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        $roles = Role::all();
        $standards = Standard::whereNull('parent_id')->with('children')->get();
        $userStandards = $user->standards->pluck('id')->toArray();
        return view('self-study.user.edit', compact('user', 'roles', 'standards', 'userStandards'));
    }


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
            'user_name' => 'required|string|max:255|unique:users,user_name,' . $user->id,
            'standards' => 'nullable|array',
            'standards.*' => 'exists:standards,id',
            'is_active' => 'required|in:0,1',
        ]);

        DB::transaction(function () use ($validated, $request, $user) {
            $updateData = [
                'full_name' => $validated['name'],
            ];
            
            if (isset($validated['email'])) {
                $updateData['email'] = $validated['email'];
            }

            if (!empty($validated['password'])) {
                $updateData['password'] = Hash::make($validated['password']);
            }

            // $user->update($updateData);
            $userRole = Role::findById($request->role);
            $user = User::findOrFail($user->id);
            $user->full_name = $request->name;
            if (isset($request->email)) {
                $user->email = $request->email;
            }
            $user->user_name = $request->user_name;
            $user->type = $userRole->name;
            $user->is_active = $request->is_active;
            $user->save();
            $user->roles()->sync($userRole);

            $user->standards()->sync($request->standards ?? []);
        });

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('Delete User')) {
            $user = User::findOrFail($id);
    
            // Detach many-to-many relationships
            $user->standards()->detach();
            $user->roles()->detach();
    
            // Delete direct owned data (if not handled by cascade or set null)
            $user->comments()->delete(); // Or nullify if needed
    
            // Delete the user
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
