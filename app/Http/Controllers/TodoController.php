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
        $todo = Todo::all();
        $tag = Tag::all();
        $param = ['todo' => $todo, 'user' =>$user, 'tag' =>$tag];
        return view('index', $param);
    }

    public function store(TodoRequest $request){
        dd($request);
        $todo = Todo::with('tag')->get();
        $todo = Todo::with('users')->get();
        $todo = $request->all();
        Todo::create($todo);
        return redirect('/');
    }

    public function update(TodoRequest $request){
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        return redirect('/');
    }

    public function delete(ClientRequest $request){
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->delete();
        return redirect('/');
    }

    public function indexFind(){
        $user = Auth::user();
        $todo = Todo::all();
        $param = ['todo' => $todo, 'user' =>$user];
        return view('tagFind', $param);
    }

    public function find(Request $request){
        $user = Auth::user();
        $todo = Todo::all();
        $search = Todo::where('content', 'LIKE BINARY',"%{$request->input}%")->where('tag', 'LIKE BINARY',"%{$request->tag}%")->get();
        
        $tag = tag::all();
        $param = [
        'input' => $request->input,
        'todo' => $search,
        'user' => $user
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
