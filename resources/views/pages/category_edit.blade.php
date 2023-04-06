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


<form action="{{route('category.edit', ['id'=>request()->id])}}"
      method="post"
>
    {{ csrf_field() }}

    Название категории:
    <input type="text" name="name" value="{{$tableData->name}}">
    @if ($errors->has('name'))
        <div class="alert alert-danger">{{$errors->first('name')}}</div>
    @endif
    Описание:
    <input type="text" name="description" value="{{$tableData->Description}}">
    @if ($errors->has('description'))
        <div class="alert alert-danger">{{$errors->first('description')}}</div>
    @endif
    <br>
    <input type="submit" value="Изменить категорию">
</form>
