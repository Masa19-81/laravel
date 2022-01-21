@extends('layouts.app_admin')

@section('content')
<body>
<h1>新規商品追加</h1>
<form method="post" action="{{ route('admin.add_post') }}">
{{ csrf_field() }}
商品名
<br>
<input type="text" name="name" value="{{ old('name') }}">
@if($errors->has('name'))
<span>{{ $errors->first('name') }}</span>
@endif
<br>
商品説明
<br>
<textarea name="description">{{ old('description') }}</textarea>
@if($errors->has('description'))
<span>{{ $errors->first('description') }}</span>
@endif
<br>
値段
<br>
<input type="number" name="price" value="{{ old('price') }}">
@if($errors->has('price'))
<span>{{ $errors->first('price') }}</span>
@endif
<br>
在庫数
<br>
<input type="number" name="inventory" value="{{ old('inventory') }}">
@if($errors->has('inventory'))
<span>{{ $errors->first('inventory') }}</span>
@endif
<br>
<input type="submit" value="追加">
</form>
<h3><a href="{{ route('admin.index') }}">商品一覧へ戻る</a></h3>
</body>
@endsection
