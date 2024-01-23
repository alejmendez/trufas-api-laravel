<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles');

        $order = request('order');
        if ($order) {
            $order = explode(',', $order);
            foreach ($order as $col) {
                $firstChar = substr($col, 0, 1);
                $direction = 'asc';
                if ($firstChar === '-') {
                    $col = substr($col, 1);
                    $direction = 'desc';
                }
                $users->orderBy($col, $direction);
            }
        }

        \Log::debug($users->toSql());

        return new UserCollection($users->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new UserResource(User::with('roles')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return response()->json(null, 204);
    }
}
