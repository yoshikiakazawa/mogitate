@extends('layouts.app')

@section('main')
<div class="register">
    <h2 class="register__ttl">商品登録</h2>
    <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex align-items-center">
            <label class="register__label" for="name">商品名</label>
            <span class="required">必須</span>
        </div>
        <input class="form__input-field" type="text" name="name" id="name" value="{{ old('name') }}"
            placeholder="商品名を入力">
        <div class="error">
            @error('name')
            {{$message}}
            @enderror
        </div>
        <div class="flex align-items-center">
            <label class="register__label" for="price">値段</label>
            <span class="required">必須</span>
        </div>
        <input class="form__input-field" type="number" name="price" id="price" value="{{ old('price') }}"
            placeholder="値段を入力">
        <div class="error">
            @error('price')
            {{$message}}
            @enderror
        </div>
        <div class="flex align-items-center">
            <label class="register__label" for="image">商品画像</label>
            <span class="required">必須</span>
        </div>
        <img src="" alt="" width="350" id="imagePreview" style="margin: .25rem">
        <input class="form__input-file" type="file" id="image" name="image" onchange="previewImage(event)">
        <div class="error">
            @error('image')
            {{$message}}
            @enderror
        </div>
        <div class="flex align-items-center">
            <label class="register__label">季節</label>
            <span class="required">必須</span>
            <span class="register__span">複数選択可</span>
        </div>
        <div class="flex align-items-center form__checkbox--group">
            <input class="form__checkbox" type="checkbox" name="seasons[]" id="spring" value="1" {{ in_array(1,
                old('seasons', [])) ? 'checked' : '' }}>
            <label class="form__checkbox--label" for="spring">春</label>
            <input class="form__checkbox" type="checkbox" name="seasons[]" id="summer" value="2" {{ in_array(2,
                old('seasons', [])) ? 'checked' : '' }}>
            <label class="form__checkbox--label" for="summer">夏</label>
            <input class="form__checkbox" type="checkbox" name="seasons[]" id="autumn" value="3" {{ in_array(3,
                old('seasons', [])) ? 'checked' : '' }}>
            <label class="form__checkbox--label" for="autumn">秋</label>
            <input class="form__checkbox" type="checkbox" name="seasons[]" id="winter" value="4" {{ in_array(4,
                old('seasons', [])) ? 'checked' : '' }}>
            <label class="form__checkbox--label" for="winter">冬</label>
        </div>
        <div class="error">
            @error('seasons')
            {{$message}}
            @enderror
        </div>
        <div class="flex align-items-center">
            <label class="register__label" for="description">商品説明</label>
            <span class="required">必須</span>
        </div>
        <textarea class="form__input-field--textarea" name="description" id="description" cols="30" rows="8"
            placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        <div class="error">
            @error('description')
            {{$message}}
            @enderror
        </div>
        <div class="flex center align-items-center">
            <a class="form__btn-back" href="{{ route('index') }}">戻る</a>
            <button class="form__btn-submit" type="submit">登録</button>
        </div>
    </form>
</div>
<script src="/js/image.js" defer></script>
@endsection
