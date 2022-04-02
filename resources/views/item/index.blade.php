@extends('layouts.app')

@section('content')
@if (session('message'))
<h3>{{ session('message') }}</h3>
@endif
<h1>商品一覧</h1>
<table border="1" style="font-size : 20px">
<tr>
<th>商品名</th>
<th>値段</th>
<th>在庫の有無</th>
</tr>
@foreach ($items as $item)
<tr>
<td><a href="{{ route('detail', ['id' => $item->id]) }}">{{$item->name}}</a></td>
<td>{{ $item->price }}円</td>
@if ($item->inventory == 0)
<td>在庫無し</td>
@else
<td>在庫あり</td>
@endif
</tr>
@endforeach
</table>
<br>
<h3><a href="{{ route('address.index') }}">お届け先住所一覧</a></h3>
<h3><a href="{{ route('cart.index') }}">カート情報</a></h3>
@endsection
