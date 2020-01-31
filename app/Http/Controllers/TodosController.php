<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Http\Resources\Todo as TodoResource;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public  function index(){
        return view('home');
    }

    public function store(Request $request){
        $todo = new Todo();
        $todo->todo = $request['todo'];
        $todo->status = 'incomplete';
        $todo->save();
        return new TodoResource($todo);
    }

    public function showAll(){
        $todos = Todo::orderBy('id', 'DESC')->get();
        return TodoResource::collection($todos);
    }

    public function updateStatus(Request $request){
        $todo = Todo::find($request->id);
        $todo->status = $request['status'];
        $todo->save();
        return new TodoResource($todo);
    }

    public function updateTodo(Request $request){
        $todo = Todo::find($request->id);
        $todo->todo = $request['todo'];
        $todo->save();
        return new TodoResource($todo);
    }

    public function deleteTodo($id){
        $todo = Todo::find($id);
        $todo->delete();
        return new TodoResource($todo);
    }

    public function deleteCompleted(){
        $todos = Todo::where('status', 'complete')->delete();
//        return TodoResource::collection($todos);
        return $todos;
    }
}
