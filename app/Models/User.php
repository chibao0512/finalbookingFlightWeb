<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use LaravelEntrustUserTrait; // add this trait to your user model
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'address',
        'status',
        'birthday',
        'gender',
        'id_agency',
        'type',
        'info',
        'remember_token',
        'remember_token',
    ];

    const STATUS = [
        1 => 'Hoạt động',
        2 => 'Đã khóa'
    ];

    const CLASS_STATUS = [
        2 => 'btn-danger',
        1 => 'btn-success'
    ];

    const GENDERS = [
        1 => 'Nam',
        2 => 'Nữ',
        3 => 'Không xác định'
    ];

    const ACTIVE  = 1;
    const LOCK  = 2;
    const TYPE_USER  = 2;
    const TYPE_ADMIN  = 1;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getInfoEmail($email)
    {
        return $this->where(['email'=>$email, 'status' =>  self::ACTIVE])->first();
    }

    public function userRole()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
}
