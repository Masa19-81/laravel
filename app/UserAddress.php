<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;

class UserAddress extends Model {
	use SoftDeletes;
	protected $fillable = [
		'user_id', 'name', 'code', 'prefecture', 'city', 'address', 'phone'
	];
	protected $table = 'user_addresses';
	protected $dates = ['deleted_at'];

	public function user() {
		return $this->belongsTo('App\User', 'id');
	}
}
