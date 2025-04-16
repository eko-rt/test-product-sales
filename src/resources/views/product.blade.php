@extends('layouts.layout')
<style>
      svg.w-5.h-5 {
    width: 30px;
    height: 30px;
  }
</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="index">
    <div class="header__inner">        
        <h2>商品一覧</h2>
        <div class="header__inner--register">
            <a href="{{ route('products.store') }}" class="btn-add">+ 商品を追加</a>
        </div>
    </div>

    <section class="search-section">
        <form action="{{ route('products.search') }}" method="GET">
            <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
            <button type="submit">検索</button>
        </form>
        <form action="{{ route('products.index') }}" method="GET">
            <p>価格順で表示</p>
            <select name="sort" onchange="this.form.submit()">
                <option value="">価格で並べ替え</option>
                <option value="high" {{ request('sort') === 'high' ? 'selected' : '' }}>高い順に表示</option>
                <option value="low" {{ request('sort') === 'low' ? 'selected' : '' }}>低い順に表示</option>
            </select>
        </form>
        @if (request('sort'))
        <div class="sort-tag">
            <span>
                {{ request('sort') === 'high' ? '高い順に表示' : '低い順に表示' }}
                <a href="{{ route('products.index') }}" class="reset-sort">×</a>
            </span>
        </div>
        @endif
    </section>

    <section class="product-list">
        @foreach ($products as $product)
            <div class="product">
                <a href="{{ route('products.show', $product->id) }}">
                  
                    <img src="{{ asset('storage/fruits-img/' . $product->image) }}" alt="{{ $product->name }}" width="max">

                    <p><strong>{{ $product->name }}</strong></p>

                    <p>¥{{ number_format($product->price) }}</p>
                </a>
            </div>
        @endforeach
    </section>
</div>

    <div class="pagination">
        {{ $products->links() }}
    </div>

@endsection