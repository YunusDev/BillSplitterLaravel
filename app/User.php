<?php

namespace App;

use App\Model\Bill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const USER_VERIFIED = '1';
    const USER_NOT_VERIFIED = '0';

    protected $appends = ['frontend_url', 'is_admin'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','verification_token','phone', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return in_array($this->email, config('admin.administrators'));
    }

    public function getIsAdminAttribute(){

        return in_array($this->email, config('admin.administrators'));

    }


    public function isVerified()
    {
        return $this->verified == User::USER_VERIFIED;
    }


    public static function generateVerificationToken()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle($permitted_chars), 0, 30);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getFrontendUrlAttribute(){

        return 'http://localhost:8080/verify/' . strval($this->verification_token);

    }

    public function bills(){

        return $this->belongsToMany(Bill::class, 'bill_user')->withTimestamps()->orderBy('created_at','DESC');

    }
}
