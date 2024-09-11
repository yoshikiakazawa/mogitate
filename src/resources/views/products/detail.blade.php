@extends('layouts.app')

@section('main')
<div class="detail">
    <form action="{{ route('update', ['productId' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex space-between align-items-center">
            <div class="detail__ttl">
                <a class="detail__btn-back" href="{{ route('index') }}">商品一覧</a>
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
            <div class="detail__input">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" width="350px">
                <input class="form__input-file" type="file" name="image">
                <div class="error">
                    @error('image')
                    {{$message}}
                    @enderror
                </div>
            </div>
            <div class="detail__input">
                <label for="name">商品名</label>
                <input class="form__input-field" type="text" name="name" id="name" value="{{ $product->name }}"
                    placeholder="商品名を入力">
                <div class="error">
                    @error('name')
                    {{$message}}
                    @enderror
                </div>
                <label for="price">値段</label>
                <input class="form__input-field" type="number" name="price" id="price" value="{{ $product->price }}"
                    placeholder="値段を入力">
                <div class="error">
                    @error('price')
                    {{$message}}
                    @enderror
                </div>
                <label>季節</label>
                <div class="flex align-items-center form__checkbox--group">
                    <input class="form__checkbox" type="checkbox" name="seasons[]" id="spring" value="1">
                    <label class="form__checkbox--label" for="spring">春</label>
                    <input class="form__checkbox" type="checkbox" name="seasons[]" id="summer" value="2">
                    <label class="form__checkbox--label" for="summer">夏</label>
                    <input class="form__checkbox" type="checkbox" name="seasons[]" id="autumn" value="3">
                    <label class="form__checkbox--label" for="autumn">秋</label>
                    <input class="form__checkbox" type="checkbox" name="seasons[]" id="winter" value="4">
                    <label class="form__checkbox--label" for="winter">冬</label>
                </div>
                <div class="error">
                    @error('seasons')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <label for="description">商品説明</label>
        <textarea class="form__input-field--textarea" name="description" id="description" cols="30" rows="10"
            placeholder="商品の説明を入力">{{ $product->description }}</textarea>
        <div class="error">
            @error('description')
            {{$message}}
            @enderror
        </div>
        <div class="flex center align-items-center">
            <a class="form__btn-back" href="{{ route('index') }}">戻る</a>
            <button class="form__btn-submit" type="submit">変更を保存</button>
        </div>
    </form>
    <form action="{{ route('delete',  ['productId' => $product->id]) }}" method="post"
        onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        <button class="detail__btn-delete" type="submit">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>
@endsection
