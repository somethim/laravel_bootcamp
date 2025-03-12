<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        return Member::all();
    }

    public function store(MemberRequest $request)
    {
        return Member::create($request->validated());
    }

    public function show(Member $member)
    {
        return $member;
    }

    public function update(MemberRequest $request, Member $member)
    {
        $member->update($request->validated());

        return $member;
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json();
    }
}
