@extends('layouts.app')

@section('content')
@if (session('message'))
<h3>{{ session('message') }}</h3>
@endif
<h1>お届け先一覧</h1>
@if (count($addresses) == 0)
<h3>お届け先が未登録です</h3>
@else
<table border="1" style="font-size : 20px">
<tr>
<th>氏名</th>
<th>郵便番号</th>
<th>都道府県</th>
<th>市区町村</th>
<th>それ以下の住所</th>
<th>電話番号</th>
<th>選択</th>
<th>編集</th>
<th>削除</th>
</tr>
@foreach ($addresses as $address)
<tr>
<td>{{ $address->name }}</td>
<td>{{ $address->code }}</td>
<td>{{ $address->prefecture }}</td>
<td>{{ $address->city }}</td>
<td>{{ $address->address }}</td>
<td>{{ $address->phone }}</td>
<td><input type="radio" name="address" value="{{ $address->id }}"></td>
<td>
<button onclick="location.href='{{ route("address.edit", ['id' => $address->id]) }}'">編集</button>
</td>
<td>
<form method="post" action="{{ route('address.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ $address->id }}">
<button type="submit">削除</button>
</form>
</td>
</tr>
@endforeach
</table>
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
@endif
<h3><a href="{{ route('cart.index') }}">カート情報へ戻る</a></h3>
@endsection
