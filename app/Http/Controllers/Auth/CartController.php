<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Cart;
use App\Item;

class CartController extends Controller {
	public function index() {
		$id = Auth::id();
		$carts = Cart::where('user_id', $id)->get();
		$total = 0;
		foreach ($carts as $cart) {
			$total += $cart->item->price * $cart->inventory;
		}
		return view('cart.index', compact('carts', 'total'));
	}

	public function add(Request $request) {
		$item = Item::findOrFail($request->id);
		if ($item->inventory == 0) {
			return redirect(route('index'))->with('message', '在庫無しの商品が選択されています');
		}
		$itemInCart = Cart::where('user_id', Auth::id())->where('item_id', $request->id)->first();
		DB::transaction(function() use($itemInCart, $request) {
			if ($itemInCart) {
				Cart::where('item_id', $itemInCart->item_id)->increment('inventory');
			} else {
				$cart = new Cart;
				$cart->user_id = Auth::id();
				$cart->item_id = $request->id;
				$cart->inventory = 1;
				$cart->save();
			}
			Item::where('id', $request->id)->decrement('inventory');
		});
		return redirect(route('cart.index'))->with('message', 'カートに商品を追加しました');
	}

	public function delete(Request $request) {
		$cart = Cart::where('user_id', Auth::id())->where('id', $request->id)->first();
		if (!$cart) {
			return redirect(route('index'))->with('message', '不正な商品削除処理です');
		}
		DB::transaction(function() use($cart) {
			Item::where('id', $cart->item_id)->increment('inventory', $cart->inventory);
			Cart::where('user_id', Auth::id())->where('id', $cart->id)->delete();
		});
		return redirect(route('cart.index'))->with('message', 'カートから商品を削除しました');
	}

}
