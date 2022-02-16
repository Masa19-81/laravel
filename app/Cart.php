<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;

class Cart extends Model {
	use SoftDeletes;
	protected $fillable = [
		'user_id', 'item_id', 'inventory'
	];
	protected $table = 'carts';
	protected $dates = ['deleted_at'];

	public function item() {
		return $this->belongsTo('App\Item', 'item_id');
	}
}
