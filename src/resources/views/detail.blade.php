@extends('layouts.app')

@section('main')
<div class="detail">
    <form action="{{ route('update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex space-between align-items-center">
            <div class="detail__ttl">
                <a class="detail__link" href="{{ route('index') }}">商品一覧</a>
                <span>＞</span>
                <span>{{ $product->name }}</span>
            </div>
            <div class="flash_message">
                @if (session('message'))
                {{ session('message') }}
                @endif
            </div>
        </div>
        <div class="flex space-between align-items-center">
            <div class="flex-column">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" width="350px">
                <input class="detail__input--file" type="file" name="image">
                @error('image')
                <div class="error">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="detail__input">
                <div class="flex-column detail__input--text">
                    <label class="detail__label" for="name">商品名</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}" placeholder="商品名を入力">
                    @error('name')
                    <div class="error">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="flex-column detail__input--text">
                    <label class="detail__label" for="price">値段</label>
                    <input type="text" name="price" id="price" value="{{ $product->price }}" placeholder="値段を入力">
                    @error('price')
                    <div class="error">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <label class="flex-column detail__label" for="season">季節</label>
                <div class="flex align-items-center">
                    <input class="detail__checkbox" type="checkbox" name="seasons[]" id="spring" value="1">
                    <label class="detail__checkbox--label" for="spring">春</label>
                    <input class="detail__checkbox" type="checkbox" name="seasons[]" id="summer" value="2">
                    <label class="detail__checkbox--label" for="summer">夏</label>
                    <input class="detail__checkbox" type="checkbox" name="seasons[]" id="autumn" value="3">
                    <label class="detail__checkbox--label" for="autumn">秋</label>
                    <input class="detail__checkbox" type="checkbox" name="seasons[]" id="winter" value="4">
                    <label class="detail__checkbox--label" for="winter">冬</label>
                </div>
                @error('season')
                <div class="error">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="flex-column detail__description">
            <label class="detail__label" for="description">商品説明</label>
            <textarea class="detail__description--textarea" name="description" id="description" cols="30" rows="10"
                placeholder="商品の説明を入力">{{ $product->description }}</textarea>
            @error('description')
            <div class="error">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="flex center align-items-center">
            <a class="detail__back--link" href="{{ route('index') }}">戻る</a>
            <button class="detail__form--btn" type="submit">変更を保存</button>
        </div>
    </form>
    <form action="{{ route('delete', $product->id) }}" method="post" onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        <button class="detail__delete-btn" type="submit">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>
@endsection
