<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')
            ->order(request('order', ''))
            ->search(request('search', ''));

        return new UserCollection($users->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $data['avatar'] = $request->file('avatar') ? $request->file('avatar')->store('avatars') : null;

        $user = User::create($data);

        if ($data['role']) {
            $user->assignRole($data['role']);
        }
        return response()->json(new UserResource($user), 201);
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
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->all();
        $data['avatar'] = $request->file('avatar') ? $request->file('avatar')->store('avatars') : null;

        $user->update($data);

        if (isset($data['role'])) {
            $user->getRoleNames()
                ->filter(function ($name) use ($data) {
                    return $data['role'] !== $name;
                })
                ->map(function ($name) use ($user) {
                    $user->removeRole($name);
                });

            if (!$user->hasExactRoles($data['role'])) {
                $user->assignRole($data['role']);
            }
        }
        return response()->json(new UserResource($user), 200);
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
