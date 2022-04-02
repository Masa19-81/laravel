@extends('layouts.app')

@section('content')
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
</tr>
@foreach ($addresses as $address)
<tr>
<td>{{ $address->name }}</td>
<td>{{ $address->code }}</td>
<td>{{ $address->prefecture }}</td>
<td>{{ $address->city }}</td>
<td>{{ $address->address }}</td>
<td>{{ $address->phone }}</td>
</tr>
@endforeach
</table>
@endif
<h3><a href="{{ route('address.add') }}">新規お届け先追加</a></h3>
<h3><a href="{{ route('index') }}">商品一覧へ戻る</a></h3>
@endsection
