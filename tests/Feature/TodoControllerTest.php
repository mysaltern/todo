<?php
use Illuminate\Support\Facades\Cache;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\delete;

beforeEach(function () {
    Cache::forget('todos');  // Clear the cache before each test
});

it('returns an empty todo list initially', function () {
    get('/api/todo')
        ->assertOk()
        ->assertJson([]);
});

it('can add a new todo item', function () {
    $response = post('/api/todo/store', [
        'title' => 'Buy groceries'
    ]);

    $response->assertCreated() // Check if 201 response (successfully created)
             ->assertJsonFragment(['title' => 'Buy groceries', 'completed' => false]);

    // Verify the item exists in cache
    $todos = Cache::get('todos', []);
    expect($todos)->toHaveCount(1);
    expect($todos[0]['title'])->toBe('Buy groceries');
});

it('requires a title when creating a new todo', function () {
    post('/api/todo/store', [])
        ->assertStatus(400)
        ->assertJson(['error' => 'Title is required']);
});

it('can list all todo items', function () {
    // Seed a todo item in cache
    $seededTodo = [
        'id' => uniqid(),
        'title' => 'Learn Pest Testing',
        'completed' => false
    ];
    Cache::put('todos', [$seededTodo]);

    get('/api/todo')
        ->assertOk()
        ->assertJson([$seededTodo]);
});

it('can delete an existing todo item', function () {
    // Seed a todo in cache
    $seededTodo = [
        'id' => 'todo-123',
        'title' => 'Delete this task',
        'completed' => false
    ];
    Cache::put('todos', [$seededTodo]);

    delete('/api/todo/todo-123')
        ->assertOk()
        ->assertJson(['message' => 'Todo deleted']);

    // Verify that the cache no longer contains the deleted todo
    $todos = Cache::get('todos', []);
    expect($todos)->toBeEmpty();
});

it('returns a 404 when deleting a non-existent todo', function () {
    delete('/api/todo/nonexistent-id')
        ->assertStatus(404)
        ->assertJson(['error' => 'Todo not found']);
});
