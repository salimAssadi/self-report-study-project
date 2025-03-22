<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JetBrains\PhpStorm\Language;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Lab404\Impersonate\Models\Impersonate;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use Notifiable;
    use Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'lang',
        'avatar',
        'currant_store',
        'plan',
        'plan_expire_date',
        'storage_limit',
        'referral_code',
        'used_referral_code',
        'commission_amount',
        'mode',
        'plan_is_active',
        'type',
        'created_by',
        'is_active',
        'is_disable',
        'is_enable_login',
        'trial_plan',
        'trial_expire_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function creatorId()
    {
        if($this->type == 'Owner' || $this->type == 'super admin')
        {
            return $this->id;
        }
        else
        {
            return $this->created_by;
        }
    }

    private static $getLang = null;

    public function currentLanguages()
    {
        if (is_null(self::$getLang)) {
            $currantLang = $this->lang;
            if(!isset($currantLang)){
                $currantLang = 'en';
            }
            $language = Languages::where('code',$currantLang)->get()->first();
            self::$getLang = $language;
        }
        return self::$getLang;
    }

 
    public function dateFormat($date)
    {
        $settings = Utility::settings();

        return date($settings['site_date_format'], strtotime($date));
    }

    public function countUsers()
    {
        return User::where('created_by', '=', $this->creatorId())->count();
    }

    public function countStoreUsers($storeID)
    {
        return User::where('created_by', '=', $this->creatorId())->where('current_store', '=', $storeID)->count();
    }
    

 
}
