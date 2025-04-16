@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="header__inner">
        <a href="{{ route('products.index') }}">商品一覧</a> > {{ $product->name }}
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="product-detail">
            <div class="product-detail__image">
                <img src="{{ asset('storage/fruits-img/' . $product->image) }}" alt="{{ $product->name }}" width="300">
                <input type="file" id="image" name="image">
                <label for="image">{{ $product->image }}</label>
                @if ($errors->has('image'))
                    <p class="error">{{ $errors->first('image') }}</p>
                @endif
            </div>

            <div class="product-detail__info">
                <div class="form-group">
                    <label for="name">商品名</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}">
                    @if ($errors->has('name'))
                        <p class="error">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="price">値段</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}">
                    @if ($errors->has('price'))
                        <p class="error">{{ $errors->first('price') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>季節</label>
                    <div class="seasons">
                        @foreach (['春', '夏', '秋', '冬'] as $season)
                            <label>
                                <input type="checkbox" name="seasons[]" value="{{ $season }}" 
                                    {{ in_array($season, old('seasons', $product->seasons->pluck('name')->toArray())) ? 'checked' : '' }}>
                                {{ $season }}
                            </label>
                        @endforeach
                    </div>
                    @if ($errors->has('seasons'))
                        <p class="error">{{ $errors->first('seasons') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">商品説明</label>
                    <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
                    @if ($errors->has('description'))
                        <p class="error">{{ $errors->first('description') }}</p>
                    @endif
                </div>

                <div class="form-actions">
                    <a href="{{ route('products.index') }}">
                        <button type="button" class="btn-back">戻る</button>
                    <button type="submit" class="btn-save">変更を保存</button>
                    </a>               
                </div>
            </div>
        </div>
    </form>        
    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>
@endsection