<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Admin\Post;
use Illuminate\Support\Str;
use App\Models\Hrd\Karyawan;
use App\Models\Admin\Userapp;
use App\Models\Cso\Booking;
use App\Models\Operasi\Spjmasuk;
use App\Models\Operasi\Spjkeluar;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'status',
        'role_id',
        'password',
    ];

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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role)
{
    return $this->roles->contains('name', $role);
}

    public function getRoles()
    {
        return $this->roles()->pluck('name')->toArray();
    }

    // public function scopeRole($query, $role)
    // {
    //     return $query->whereHas('roles', function ($query) use ($role) {
    //         $query->where('name', $role);
    //     });
    // }


    public static function generateUserName($username)
    {
        if ($username === null) {
            $username = Str::lower(Str::random(8));
        }
        if (User::where('username', $username)->exists()) {
            $newUsername = $username.Str::lower(Str::random(3));
            $username = self::generateUserName($newUsername);
        }

        return $username;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function userapps()
    {
        return $this->belongsTo(Userapp::class, 'password');
    }

    public function karyawans()
    {
        return $this->belongsTo(Karyawan::class, 'nokar_id');
    }

    public function bookings()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function spjkeluars()
    {
        return $this->belongsTo(Spjkeluar::class, 'nospj_id');
    }

    public function spjmasuks()
    {
        return $this->belongsTo(Spjmasuk::class);
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }

}
