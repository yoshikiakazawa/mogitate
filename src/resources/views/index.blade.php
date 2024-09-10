@extends('layouts.app')

@section('main')

<div class="main product-lists">
    <div class="flex space-between align-items-center">
        @if(isset($name) && !empty($name))
        <h2 class="product-lists__ttl">“{{ $name }}”の商品一覧</h2>
        @else
        <h2 class="product-lists__ttl">商品一覧</h2>
        @endif
        <a class="product-lists__link" href="">+ 商品を追加</a>
    </div>
    <div class="product-lists__grid">
        <div class="product-lists__search">
            <form class="product-lists__search__form" action="{{ route('search') }}" method="get">
                <input class="product-lists__search__form--input" type="text" name="name" value="{{ $name ?? '' }}"
                    placeholder="商品名で検索">
                <button class="product-lists__search__form--btn">検索</button>
                <span class="product-lists__search__form--span">価格順で表示</span>
                <div class="product-lists__search__form--pull-down">
                    <select name="sort">
                        <option value="" {{ is_null(request()->input('sort')) ? 'selected' : '' }}>価格で並べ替え</option>
                        <option value="asc" {{ request()->input('sort') == 'asc' ? 'selected' : '' }}>価格が低い順</option>
                        <option value="desc" {{ request()->input('sort') == 'desc' ? 'selected' : '' }}>価格が高い順</option>
                    </select>
                </div>
            </form>
            <form class="product-lists__search__form--reset" action="{{ route('search') }}" method="get">
                @if(isset($sort))
                <div class="flex product-lists__search__form--reset-btn">
                    <label class="product-lists__search__form--reset-btn-txt">
                        {{ $sort == 'asc' ? '低い順に表示' : ($sort == 'desc' ? '高い順に表示' : '') }}
                    </label>
                    <input type="hidden" name="name" value="{{ $name ?? '' }}">
                    <input type="hidden" name="sort" value="">
                    <button class="product-lists__search__form--reset-btn-close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                @endif
            </form>
        </div>
        @if($products->isEmpty())
        <p class='error'>{{ $message }}</p>
        @endif
        <div class="product-lists__card__grid">
            @foreach ($products as $product)
            <div class="product-card">
                <img class="product-card__img" src="{{ $product->image }}" alt="{{ $product->name }}">
                <div class="flex space-between align-items-center product-card__detail">
                    <p>{{ $product->name }}</p>
                    <p>￥{{ $product->price }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @if($products->isNotEmpty())
    {{ $products->links('vendor.pagination.custom') }}
    @endif
</div>
@endsection
