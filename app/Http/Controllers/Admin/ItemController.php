<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Item;

class ItemController extends Controller
{
	public function index() {
		$items = Item::all();
		return view('admin.index', ['items' => $items]);
	}

	public function detail($id) {
		$item = Item::findOrFail($id);
		return view('admin.detail', ['item' => $item]);
	}

	public function add(Request $request) {
		$validatedData = $request->validate([
			'name' => 'required',
			'description' => 'required',
			'price' => 'required|regex:/^[1-9][0-9]*/|not_in:0',
			'inventory' => 'required|regex:/^[1-9][0-9]*/|not_in:0'
		], [
			'name.required' => '商品名を入力して下さい',
			'description.required' => '商品説明を入力して下さい',
			'price.required' => '値段を入力して下さい',
			'price.regex' => '値段は正の整数のみ有効です',
			'inventory.required' => '在庫数を入力して下さい',
			'inventory.regex' => '在庫数は正の整数のみ有効です'
		]);
		$name = $request->input('name');
		$description = $request->input('description');
		$price = $request->input('price');
		$inventory = $request->input('inventory');
		Item::create(compact('name', 'description', 'price', 'inventory'));
		return redirect(route('admin.index'))->with('message', '新規商品を追加しました');
	}

	public function edit($id) {
		$item = Item::findOrFail($id);
		return view('admin.edit', ['item' => $item]);
	}

	public function update(Request $request) {
		$validatedData = $request->validate([
			'name' => 'required',
			'description' => 'required',
			'inventory' => 'required|regex:/^[1-9][0-9]*/|not_in:0'
		], [
			'name.required' => '商品名を入力して下さい',
			'description.required' => '商品説明を入力して下さい',
			'inventory.required' => '在庫数を入力して下さい',
			'inventory.regex' => '在庫数は正の整数のみ有効です'
		]);
		$item = Item::findOrFail($request->id);
		$item->fill(['name' => $request->input('name')]);
		$item->fill(['description' => $request->input('description')]);
		$item->fill(['inventory' => $request->input('inventory')]);
		$item->save();
		return redirect(route('admin.index'))->with('message', '商品情報を更新しました');
	}
}
