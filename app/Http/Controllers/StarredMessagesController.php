<?php

namespace App\Http\Controllers;

use App\Http\Requests\StarredMessagesRequest;
use App\Models\StarredMessages;

class StarredMessagesController extends Controller
{
    public function index()
    {
        return StarredMessages::all();
    }

    public function store(StarredMessagesRequest $request)
    {
        return StarredMessages::create($request->validated());
    }

    public function show(StarredMessages $starredMessages)
    {
        return $starredMessages;
    }

    public function update(StarredMessagesRequest $request, StarredMessages $starredMessages)
    {
        $starredMessages->update($request->validated());

        return $starredMessages;
    }

    public function destroy(StarredMessages $starredMessages)
    {
        $starredMessages->delete();

        return response()->json();
    }
}
