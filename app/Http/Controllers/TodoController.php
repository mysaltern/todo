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

    public function destroy($id)
    {
        // Get the current todos from the cache
        $todos = Cache::get($this->cacheKey, []);
    
        // Check if the todo with the given ID exists
        $todoExists = collect($todos)->firstWhere('id', $id);
    
        if (!$todoExists) {
            return response()->json(['error' => 'Todo not found'], 404);
        }
    
        // Filter out the todo with the given ID
        $filteredTodos = array_filter($todos, fn($todo) => $todo['id'] !== $id);
    
        // Update the cache
        Cache::put($this->cacheKey, array_values($filteredTodos));
    
        return response()->json(['message' => 'Todo deleted']);
    }
    
    
}
