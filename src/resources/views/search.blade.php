@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
    <div class="header__inner">
        <h2>“{{ $keyword }}”の商品一覧</h2>
    </div>

    <section class="product-list">
        @if ($products->isEmpty())
            <p>該当する商品が見つかりませんでした。</p>
        @else
            @foreach ($products as $product)
                <div class="product">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ asset('storage/fruits-img/' . $product->image) }}" alt="{{ $product->name }}" width="200">
                        <p><strong>{{ $product->name }}</strong></p>
                        <p>¥{{ number_format($product->price) }}</p>
                    </a>
                </div>
            @endforeach
        @endif
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
                <a href="{{ route('products.index') }}" class="reset-sort"></a>
            </span>
        </div>
        @endif
    </section>

    <div class="pagination">
        {{ $products->links() }}
    </div>
@endsection