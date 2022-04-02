<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;
use App\UserAddress;

class UserAddressRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
	public function authorize() {
		return true;
	}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
	public function rules() {
		return [
			'id' => 'regex:/^[1-9][0-9]*/|not_in:0',
			'name' => 'required|string|max:30',
			'code' => 'required|regex:/^[0-9]{7}$/',
			'prefecture' => 'required|in:北海道,青森県,岩手県,宮城県,秋田県,山形県,福島県,茨城県,栃木県,群馬県,埼玉県,千葉県,東京都,神奈川県,新潟県,富山県,石川県,福井県,山梨県,長野県,岐阜県,静岡県,愛知県,三重県,滋賀県,京都府,大阪府,兵庫県,奈良県,和歌山県,鳥取県,島根県,岡山県,広島県,山口県,徳島県,香川県,愛媛県,高知県,福岡県,佐賀県,長崎県,熊本県,大分県,宮崎県,鹿児島県,沖縄県',
			'city' => 'required|string|max:30',
			'address' => 'required|max:50',
			'phone' => 'required|numeric|digits_between:10,11'
		];
	}

	public function messages() {
		return [
			'name.required' => '名前を入力して下さい',
			'name.string' => '名前は文字列で入力して下さい',
			'name.max:30' => '名前は30文字以内で入力して下さい',
			'code.required' => '郵便番号を入力して下さい',
			'code.regex' => '郵便番号は7桁の数字で入力して下さい',
			'prefecture.required' => '都道府県名を入力して下さい',
			'prefecture.in' => '漢字で都道府県名を正確に入力して下さい',
			'city.required' => '市区町村名を入力して下さい',
			'city.string' => '市区町村名は文字列で入力して下さい',
			'city.max:30' => '市町村名は30文字以内で入力して下さい',
			'address.required' => '住所を入力して下さい',
			'address.max:50' => '住所は50文字以内で入力して下さい',
			'phone.required' => '電話番号を入力して下さい',
			'phone.numeric' => '電話番号は数字で入力して下さい',
			'phone.digits_between:10,11' => '電話番号は10桁または11桁の数字で入力して下さい'
		];
	}
}
