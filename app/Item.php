<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $fillable = [
		'name', 'description', 'price', 'inventory'
	];
}
