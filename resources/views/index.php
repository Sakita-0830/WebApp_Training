<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('../css/style.css') }}">
  <title>Todoリスト</title>
</head>
<body>
  <div class="todo_container">
    <div class="todo_content">
      <h1 class="todo_title">
        Todo List
      </h1>
      <form action="/store" method="POST">
          <input type="text" name="content" class="todo_textbox">
          <input type="submit" class="todo_submit">
      </form>
      <table class="todo_table">
        <tr>
          <th class="todo_table-title">作成日</th>
          <th class="todo_table-title">タスク名</th>
          <th class="todo_table-title">更新</th>
          <th class="todo_table-title">削除</th>
        </tr>
        <tr>
          <td class="todo_table-created">作成日</td>
          <td class="todo_table-task">タスク名</td>
          <td class="todo_table-update">
            <a href="">更新ボタン</a>
          </td>
          <td class="todo_table-delete">
            <a href="">削除ボタン</a>
          </td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>