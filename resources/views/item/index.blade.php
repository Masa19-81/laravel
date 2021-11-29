<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>商品一覧</title>
</head>
<body>
<h1>商品一覧</h1>
<table border="1">
<tr>
<th>商品名</th>
<th>値段</th>
<th>在庫の有無</th>
</tr>
@foreach ($items as $item)
<tr>
<td><a href="{{route('detail', ['id' => $item->id])}}">{{$item->name}}</a></td>
<td>{{$item->price}}</td>
@if ($item->inventory == 0)
<td>在庫無し</td>
@else
<td>在庫あり</td>
@endif
</tr>
@endforeach
</table>
</body>
</html>
