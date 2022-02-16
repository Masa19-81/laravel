@extends('layouts.app')

@section('content')
<h1>商品詳細</h1>
<table border="1" style="font-size : 20px">
<tr>
<th>商品名</th>
<th>商品説明</th>
<th>値段</th>
<th>在庫の有無</th>
<th>商品購入</th>
</tr>
<tr>
<td>{{ $item->name }}</td>
<td>{{ $item->description }}</td>
<td>{{ $item->price }}円</td>
@if ($item->inventory == 0)
<td>在庫無し</td>
@else
<td>在庫あり</td>
@endif
@if ($item->inventory == 0)
<td>在庫無し</td>
@else
@auth
<td>
<form method="post" action="{{ route('cart.add') }}">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ $item->id }}">
<button type="submit">カートに追加</button>
</form>
</td>
@endauth
@guest
<td>ログインしてください</td>
@endguest
@endif
</tr>
</table>
<h3><a href="{{ route('index') }}">商品一覧へ戻る</a></h3>
@endsection
