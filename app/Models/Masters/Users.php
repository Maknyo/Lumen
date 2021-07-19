<?php 

namespace App\Models\Masters;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
	use Authorizable, Authenticatable;

	protected $table = 'msuser';

	public $timestamps = false;

	protected $fillable = [
		'fullname',
		'username',
		'userpassword',
	];

	protected $hidden = [
		'userpassword',
	];

	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims()
	{
		return [];
	}

	public function getAuthPassword()
	{
		return $this->userpassword;
	}
}
 ?>