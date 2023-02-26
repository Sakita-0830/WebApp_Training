@extends('layouts.app')

@section('title', 'index.blade.php')

@section('content')

<div class="container">
  <h1 class="title">タスク検索</h1>
  <div class="todo-top-right">
    <div class="login-user">「 {{$user->name}} 」でログイン中</div>
      <form action="{{ route('logout') }}" method="POST" class="logout_form">
      @csrf
        <input type="submit" value="ログアウト" class="logout_submit">
      </form>
  </div>
  <form action="/find" method="POST">
    @csrf
    @if ($errors->has('content'))
      <p>{{$errors->first('content')}}</p>
    @endif
    <div class="todo_error-content">
      <input type="text" name="content" class="todo_textbox">
      <select name="tag" name="tag" class="tag-list">
        <option value=" "></option>  
        <option value="家事">家事</option>
        <option value="勉強">勉強</option>
        <option value="食事">食事</option>
        <option value="運動">運動</option>
        <option value="移動">移動</option>
      </select>
      <input type="submit" value="検索" class="todo_submit">
    </div>
  </form>
  <table class="todo_table">
    <tr class="todo_table-tr">
      <th class="todo_table-title">作成日</th>
      <th class="todo_table-title">タスク名</th>
      <th class="todo_table-title">タグ</th>
      <th class="todo_table-title">更新</th>
      <th class="todo_table-title">削除</th>
    </tr>
    @foreach ($todo as $todo)
    <tr class="todo_table-tr">
      <td class="todo_table-created">{{$tag->created_at}}</td>
      <form action="/update" method="POST">
      @csrf
        <td>
          <input type="text" name="content"  class="todo_table-task" value={{$tag->content}}>
        </td>
        <td>
          <select name="tag" class="tag-list">
            <option value=" "></option>  
            <option value="家事">家事</option>
            <option value="勉強">勉強</option>
            <option value="食事">食事</option>
            <option value="運動">運動</option>
            <option value="移動">移動</option>
          </select>
        </td>
        <td>  
          <input class="todo_table_form-item" name="id" value={{$todo->id}}>
          <input type="submit" value="更新" class="todo_table-update">
        </td>
      </form>
      <form action="/delete" method="POST">
      @csrf
        <td>
          <input type="text" name="id" class="todo_table_form-item" value={{$todo->id}}>
          <input type="submit" value="削除" class="todo_table-delete">
        </td>
      </form>
    </tr>
    @endforeach
  </table>
  <a href="/home" class="index-return">戻る</a>
</div>
@endsection