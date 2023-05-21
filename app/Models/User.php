<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
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

    public function eventos()
    {
        return $this->belongsToMany(Eventos::class);
    }

    public function scopeindex($query){
        return $query->select('*')
        ->where('monitor',true)
        ->orWhere('admin',true)
        ->get();

    }

    public function scopebuscaruser($query, $correo){
       
        return $query->select('*')->where('email',$correo)->get();
    }

    public function scopehacermonitor($query,$correo){
        $user = User::where('email',$correo)->first();
        $user->monitor = 1;
        $user->save();

       return true;

    }

    public function scopequitarMonitor($query,$correo){
        $user = User::where('email',$correo)->first();
        $user->monitor = 0;
        return $user->save();
    }
    public function scopehaceradmin($query,$correo){
        $user = User::where('email',$correo)->first();
        $user->admin = 1;
        $user->save();

       return true;

    }

    public function scopequitaradmin($query,$correo){
        $user = User::where('email',$correo)->first();
        $user->admin = 0;
        return $user->save();
    }


    public function scopeVerRegistrodePagos($query){
        return $query->select('name','email','monitor')->where('monitor',true)->get();
    }
}
