<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller{
    public function index(){
        $user = Auth::user();
        $todos = Todo::all();
        $tags = Tag::all();
        $param = ['todos' => $todos, 'user' =>$user, 'tags' =>$tags];
        return view('index', $param);
    }

    public function store(TodoRequest $request){
        $todo = $request->all();
        Todo::create($todo);
        return redirect('/home');
    }

    public function update(TodoRequest $request){
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        return redirect('/home');
    }

    public function delete(ClientRequest $request){
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->delete();
        return redirect('/home');
    }

    public function indexFind(){
        $user = Auth::user();
        $todos = Todo::all();
        $tags = Tag::all();
        $param = ['todos' => $todos, 'user' =>$user, 'tags' =>$tags];
        return view('tagFind', $param);
    }

    public function find(Request $request){
        $user = Auth::user();
        $todo = Todo::all();
        $tags = tag::all();
        if($request->content == null && $request->tag_id != "null"){
            $search = Todo::where('tag_id', 'LIKE BINARY',"%{$request->tag_id}%")->get();
        } elseif($request->content != null && $request->tag_id == "null"){
            $search = Todo::where('content', 'LIKE BINARY',"%{$request->content}%")->get();
        } else {
            $search = Todo::where('content', 'LIKE BINARY',"%{$request->content}%")->where('tag_id', 'LIKE BINARY',"%{$request->tag_id}%")->get();
        }
        $param = [
        'request' => $request,
        'search' => $search,
        'user' => $user,
        'tags' => $tags
        ];
        return view('tagFind', $param);
    }

    public function check(Request $request){
        $text = ['text' => 'ログインして下さい。'];
        return view('auth', $text);
    }

    public function checkUser(Request $request){
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email,
            'password' => $password])) {
            $text =   Auth::user()->name . 'さんがログインしました';
        } else {
            $text = 'ログインに失敗しました';
        }
        return view('auth', ['text' => $text]);
    }
}
