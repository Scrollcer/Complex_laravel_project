<?php

if (!(Auth::user()->is_Admin)) {
    try {
        \App::abort('302', '', ['Location' => '/']);
    } catch (\Exception $exception) {
        $previousErrorHandler = set_exception_handler(function () {
        });
        restore_error_handler();
        call_user_func($previousErrorHandler, $exception);
        die;
    }
}

?>


<form action="{{route('game.edit', ['id'=>request()->id])}}"
      method="post" enctype="multipart/form-data"
>
    {{ csrf_field() }}
    Название игры:
    <input type="text" name="name" value="{{$tableData->name}}">
    @if ($errors->has('name'))
        <div class="alert alert-danger">{{$errors->first('name')}}</div>
    @endif
    ID категории:
    <input type="text" name="category_id" value="{{$tableData->category_id}}">
    @if ($errors->has('category_id'))
        <div class="alert alert-danger">{{$errors->first('category_id')}}</div>
    @endif
    Цена:
    <input type="text" name="price" value="{{$tableData->price}}">
    @if ($errors->has('price'))
        <div class="alert alert-danger">{{$errors->first('price')}}</div>
    @endif
    Изображение:
    <input type="file" name="image">
    <br>
    Описание:
    <input type="text" name="description" value="{{$tableData->description}}">
    @if ($errors->has('description'))
        <div class="alert alert-danger">{{$errors->first('description')}}</div>
    @endif
    <br>
    <input type="submit" value="Изменить игру">
</form>
