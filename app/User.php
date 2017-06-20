<?php namespace App;

use Esensi\Model\Contracts\ValidatingModelInterface;
use Esensi\Model\Traits\ValidatingModelTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Acoustep\EntrustGui\Contracts\HashMethodInterface;

//, HashMethodInterface
use Hash;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, ValidatingModelInterface, HashMethodInterface
{
    use Authenticatable, CanResetPassword, ValidatingModelTrait, EntrustUserTrait;

    protected $throwValidationExceptions = true;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'code', 'estado', 'avatar'];

    protected $hidden = ['password', 'remember_token'];

    protected $hashable = ['password'];

    protected $rulesets = [

        'creating' => [
            'email'      => 'required|email|unique:users',
        ],

        'updating' => [
            'email'      => 'required|email|unique:users',
        ],
    ];

    public function entrustPasswordHash() 
    {
        $this->password = Hash::make($this->password);
        $this->save();
    }

}
