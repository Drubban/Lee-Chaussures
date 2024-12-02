<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lastName',
        'password',
        'email',
        'phone',
        'location',
        'about_me',
        'userType',
        'status',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    

    public function usuarios()
    {
        $usuarios = DB::select('sp_ins_cli_yair()');
        return view('tablesEdit', ['usuarios' => $usuarios]);
    }

    protected static function booted()
    {
        static::created(function ($user) {
            switch ($user->userType) {
                case 'Cliente':
                    Cliente::create(['userId' => $user->id]);
                    break;

                case 'Trabajador':
                    Trabajador::create(['userId' => $user->id, 'token' => bin2hex(random_bytes(16))]);
                    break;

                case 'Administrador':
                    Administrador::create(['userId' => $user->id, 'token' => bin2hex(random_bytes(16))]);
                    break;
            }
        });
    }


    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'userId');
    }

    public function trabajador()
    {
        return $this->hasOne(Trabajador::class, 'userId');
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'userId');
    }
}
