<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TodoController extends Controller
{
    private $cacheKey = 'todos';

    public function index()
    {
        $todos = Cache::get($this->cacheKey, []);
        return response()->json($todos);
    }

    public function store(Request $request)
    {
        $title = $request->input('title');

        if (!$title) {
            return response()->json(['error' => 'Title is required'], 400);
        }

        $newTodo = [
            'id' => uniqid(),
            'title' => $title,
            'completed' => false,
        ];

        $todos = Cache::get($this->cacheKey, []);
        $todos[] = $newTodo;

        Cache::put($this->cacheKey, $todos);

        return response()->json($newTodo);
    }

 
}
