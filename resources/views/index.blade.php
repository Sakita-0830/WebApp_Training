
@extends('layouts.app')

@section('title', 'index.blade.php')

@section('content')
<div class="container">
  <h1 class="title">
    Todo List
  </h1>
  <form action="/store" method="POST" class="form_text">
    @csrf
      <input type="text" name="content" class="todo_textbox">
      <input type="submit" value="追加" class="todo_submit">
  </form>
  <table class="todo_table">
    <tr class="todo_table-tr">
      <th class="todo_table-title">作成日</th>
      <th class="todo_table-title">タスク名</th>
      <th class="todo_table-title">更新</th>
      <th class="todo_table-title">削除</th>
    </tr>
    @foreach ($todo as $todo)
    <tr class="todo_table-tr">
      <td class="todo_table-created">{{$todo->created_at}}</td>
      <form action="/update" method="POST">
      @csrf
        <td>
          <input type="text" name="content"  class="todo_table-task" value={{$todo->content}}>
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
</div>
@endsection