<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Item;

class ItemController extends Controller
{
	public function index() {
		$items = Item::all();
		return view('item.index', ['items' => $items]);
	}

	public function detail($id) {
		$item = Item::findOrFail($id);
		return view('item.detail', ['item' => $item]);
	}
}
