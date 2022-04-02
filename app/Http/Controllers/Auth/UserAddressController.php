<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressRequest;
use App\UserAddress;
use App\User;

class UserAddressController extends Controller {
	public function index() {
		$id = Auth::id();
		$addresses = UserAddress::where('user_id', $id)->get();
		return view('address.index', compact('addresses'));
	}

	public function select() {
		$id = Auth::id();
		$addresses = UserAddress::where('user_id', $id)->get();
		return view('address.select', compact('addresses'));
	}

	public function add(UserAddressRequest $request) {
		$address = UserAddress::firstOrCreate(['user_id' => Auth::id(), 'code' => $request->code, 'prefecture' => $request->prefecture, 'city' => $request->city, 'address' => $request->address], ['name' => $request->name, 'phone' => $request->phone]);
		if ($address->wasRecentlyCreated == true) {
			return redirect(route('address.select'))->with('message', '新規お届け先住所を追加しました');
		} else {
			return redirect(route('address.select'))->with('message', '既に登録済みの住所です');
		}
	}

	public function edit($id) {
		$address = UserAddress::findOrFail($id);
		if ($address->user_id == Auth::id()) {
			return view('address.edit', ['address' => $address]);
		} else {
			return redirect(route('address.select'))->with('message', '不正な編集処理です');
		}
	}

	public function update(UserAddressRequest $request) {
		$address = UserAddress::findOrFail($request->id);
		if ($address->user_id == Auth::id()) {
			$address->fill(['name' => $request->input('name')]);
			$address->fill(['code' => $request->input('code')]);
			$address->fill(['prefecture' => $request->input('prefecture')]);
			$address->fill(['city' => $request->input('city')]);
			$address->fill(['address' => $request->input('address')]);
			$address->fill(['phone' => $request->input('phone')]);
			$address->save();
			return redirect(route('address.select'))->with('message', 'お届け先情報を変更しました');
		} else {
			return redirect(route('address.select'))->with('message', '不正な編集処理です');
		}
	}

	public function delete(Request $request) {
		$address = UserAddress::where('user_id', Auth::id())->where('id', $request->id)->firstOrFail();
		$address->delete();
		return redirect(route('address.select'))->with('message', 'お届け先情報を削除しました');
	}
}
