@extends('layouts.app')

@section('content')
<h1>お届け先住所登録</h1>
<form method="post" action="{{ route('address.add_post') }}">
{{ csrf_field() }}
氏名
<br>
<input type="text" name="name" value="{{ old('name') }}">
@if($errors->has('name'))
<span>{{ $errors->first('name') }}</span>
@endif
<br>
郵便番号(7桁・ハイフンなし)
<br>
<input type="text" name="code" value="{{ old('code') }}">
@if($errors->has('code'))
<span>{{ $errors->first('code') }}</span>
@endif
<br>
都道府県
<br>
<input type="text" name="prefecture" value="{{ old('prefecture') }}">
@if($errors->has('prefecture'))
<span>{{ $errors->first('prefecture') }}</span>
@endif
<br>
市区町村
<br>
<input type="text" name="city" value="{{ old('city') }}">
@if($errors->has('city'))
<span>{{ $errors->first('city') }}</span>
@endif
<br>
それ以下の住所
<br>
<input type="text" name="address" value="{{ old('address') }}">
@if($errors->has('address'))
<span>{{ $errors->first('address') }}</span>
@endif
<br>
電話番号
<br>
<input type="number" name="phone" value="{{ old('phone') }}">
@if($errors->has('phone'))
<span>{{ $errors->first('phone') }}</span>
@endif
<br>
<input type="submit" value="追加">
</form>
<h3><a href="{{ route('index') }}">商品一覧へ戻る</a></h3>
@endsection
