@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品登録</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">商品名 <span class="required">必須</span></label>
            <input type="text" id="name" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            <p class="error">
                @error('name')
                    {{ $message }}
                @enderror
            </p>
        </div>

        <div class="form-group">
            <label for="price">値段 <span class="required">必須</span></label>
            <input type="number" id="price" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            <p class="error">
                @if ($errors->has('price'))
                        @foreach ($errors->get('price') as $error)
                        {{ $error}}<br>
                        @endforeach
                @endif
            </p>
        </div>

        <div class="form-group">
            <label for="image">商品画像 <span class="required">必須</span></label>
            <input type="file" id="image" name="image">
            <p class="error">
                @if ($errors->has('image'))
                        @foreach ($errors->get('image') as $error)
                        {{ $error}}<br>
                        @endforeach
                @endif
            </p>
        </div>

        <div class="form-group">
            <label>季節 <span class="required">必須</span> <span class="optional">複数選択可</span></label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="seasons[]" value="春" {{ is_array(old('seasons')) && in_array('春', old('seasons')) ? 'checked' : '' }}> 春</label>
                <label><input type="checkbox" name="seasons[]" value="夏" {{ is_array(old('seasons')) && in_array('夏', old('seasons')) ? 'checked' : '' }}> 夏</label>
                <label><input type="checkbox" name="seasons[]" value="秋" {{ is_array(old('seasons')) && in_array('秋', old('seasons')) ? 'checked' : '' }}> 秋</label>
                <label><input type="checkbox" name="seasons[]" value="冬" {{ is_array(old('seasons')) && in_array('冬', old('seasons')) ? 'checked' : '' }}> 冬</label>
            </div>
            <p class="error">
                @error('seasons')
                    {{ $message }}
                @enderror
            </p>
        </div>

        <div class="form-group">
            <label for="description">商品説明 <span class="required">必須</span></label>
            <textarea id="description" name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            <p class="error">
                @if ($errors->has('description'))
                        @foreach ($errors->get('description') as $error)
                        {{ $error}}<br>
                        @endforeach
                @endif
            </p>
        
        </div>

        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-back">
            <button type="button" onclick="history.back()">戻る</button>
            </a>
            <button type="submit" class="btn-submit">登録</button>
        </div>
    </form>
</div>
@endsection