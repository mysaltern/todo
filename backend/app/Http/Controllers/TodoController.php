<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $todos = [];

    public function __construct()
    {
        session()->put('todo', session('todos', []));
    }

    public function index()
    {
        return response()->json(session('todos'));
    }
}
