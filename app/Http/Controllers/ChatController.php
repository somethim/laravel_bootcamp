<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        return Chat::all();
    }

    public function store(ChatRequest $request)
    {
        return Chat::create($request->validated());
    }

    public function show(Chat $chat)
    {
        return $chat;
    }

    public function update(ChatRequest $request, Chat $chat)
    {
        $chat->update($request->validated());

        return $chat;
    }

    public function destroy(Chat $chat)
    {
        $chat->delete();

        return response()->json();
    }
}
