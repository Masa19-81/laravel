@extends('layouts.app')

@section('content')
@if (session('message'))
<h3>{{ session('message') }}</h3>
@endif
<h1>カート情報</h1>
@if (count($carts) == 0)
<h3>カートが空です</h3>
@else
<table border="1" style="font-size : 20px">
<tr>
<th>商品名</th>
<th>価格</th>
<th>購入数</th>
<th>小計</th>
<th>カートから削除</th>
</tr>
@foreach ($carts as $cart)
<tr>
<td>{{ $cart->item->name }}</td>
<td>{{ $cart->item->price }}円</td>
<td>{{ $cart->inventory }}個</td>
<td>{{ $cart->item->price * $cart->inventory }}円</td>
<td>
<form method="post" action="{{ route('cart.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ $cart->id }}">
<button type="submit">削除</button>
</form>
</td>
</tr>
@endforeach
</table>
<h3>合計金額:{{ $total }}円</h3>
@endif
<button onclick="location.href='{{ route("address.select") }}'">お届け先選択</button>
<h3><a href="{{ route('index') }}">商品一覧へ戻る</a></h3>
@endsection
