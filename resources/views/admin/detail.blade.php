@extends('layouts.app_admin')

@section('content')
<body>
<h1>商品詳細</h1>
<table border="1" style="font-size : 20px">
<tr>
<th>商品名</th>
<th>商品説明</th>
<th>値段</th>
<th>在庫の有無</th>
</tr>
<tr>
<td>{{ $item->name }}</td>
<td>{{ $item->description }}</td>
<td>{{ $item->price }}</td>
@if ($item->inventory == 0)
<td>在庫無し</td>
@else
<td>在庫あり</td>
@endif
</tr>
</table>
<h3><a href="{{ route('admin.edit', ['id' => $item->id]) }}">商品情報編集</a></h3>
<h3><a href="{{ route('admin.index') }}">商品一覧へ戻る</a></h3>
</body>
@endsection
