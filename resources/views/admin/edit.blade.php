@extends('layouts.app_admin')

@section('content')
<body>
<h1>商品情報編集</h1>
<form method="post" action="{{ route('admin.update') }}">
{{ csrf_field() }}
商品名
<br>
<input type="text" name="name" value="{{ old('name', $item->name) }}">
@if($errors->has('name'))
<span>{{ $errors->first('name') }}</span>
@endif
<br>
商品説明
<br>
<textarea name="description">{{ old('description', $item->description) }}</textarea>
@if($errors->has('description'))
<span>{{ $errors->first('description') }}</span>
@endif
<br>
在庫数
<br>
<input type="number" name="inventory" value="{{ old('inventory', $item->inventory) }}">
@if($errors->has('inventory'))
<span>{{ $errors->first('inventory') }}</span>
@endif
<br>
<input type="hidden" name="id" value="{{ $item->id }}">
<input type="submit" value="更新">
</form>
<h3><a href="{{ route('admin.index') }}">商品一覧へ戻る</a></h3>
</body>
@endsection
