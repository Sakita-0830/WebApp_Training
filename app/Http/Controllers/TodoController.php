<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\ClientRequest;

class TodoController extends Controller{
    public function index(){
        $todo = Todo::all();
        return view('index', ['todo' => $todo]);
    }

    public function store(TodoRequest $request){
        $form = $request->all();
        Todo::create($form);
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
}
