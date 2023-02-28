@extends('layouts.app')

@section('title', 'index.blade.php')

@section('content')

<div class="container">
  <h1 class="title">
    Todo List
  </h1>

  <!-- ログイン状況 -->
  <div class="todo-top-right">
    <div class="login-user">「 {{$user->name}} 」でログイン中</div>
      <form action="{{ route('logout') }}" method="POST" class="logout_form">
      @csrf
        <input type="submit" value="ログアウト" class="logout_submit">
      </form>
  </div>
  <a href="/indexFind" class="index-tagFind">タスク検索</a>

  <!-- タスクの追加 -->
  <form action="/store" method="POST">
    @csrf
    @if ($errors->has('content'))
      <p>{{$errors->first('content')}}</p>
    @endif
    <div class="todo_error-content">
      <input type="hidden" name="user_id" value="{{$user->id}}">
      <input type="text" name="content" class="todo_textbox">
      <select name="tag_id" class="tag-list">
        <option value=null></option>
        @foreach ($tags as $tag) 
        <option value="{{$tag->id}}">{{$tag->tag}}</option>
        @endforeach
      </select>
      <input type="submit" value="追加" class="todo_submit">
    </div>
  </form>

  <!-- タスクテーブル -->
  <table class="todo_table">
    <!-- 見出し -->
    <tr class="todo_table-tr">
      <th class="todo_table-title">作成日</th>
      <th class="todo_table-title">タスク名</th>
      <th class="todo_table-title">タグ</th>
      <th class="todo_table-title">更新</th>
      <th class="todo_table-title">削除</th>
    </tr>
    <!-- タスクデータ -->
    @foreach ($todos as $todo)
      @if($todo->user_id == $user->id)
      <tr class="todo_table-tr">
        <td class="todo_table-created">{{$todo->created_at}}</td>
        <!-- updateフォーム -->
        <form action="/update" method="POST">
        @csrf
          <td>
            <input type="text" name="content"  class="todo_table-task" value={{$todo->content}}>
          </td>
          <td>
            <select name="tag_id" class="tag-list">
              @foreach ($tags as $tag) 
                @if($todo->tag_id === $tag->id)
                  <option value="{{$tag->id}}" selected="selected">{{$tag->tag}}</option>
                @else
                  <option value="{{$tag->id}}">{{$tag->tag}}</option>
                @endif
              @endforeach
            </select>
          </td>
          <td>  
            <input class="todo_table_form-item" name="id" value={{$todo->id}}>
            <input type="submit" value="更新" class="todo_table-update">
          </td>
        </form>
        <!-- deleteフォーム -->
        <form action="/delete" method="POST">
        @csrf
          <td>
            <input type="text" name="id" class="todo_table_form-item" value={{$todo->id}}>
            <input type="submit" value="削除" class="todo_table-delete">
          </td>
        </form>
      </tr>
      @endif
    @endforeach
  </table>
</div>
@endsection