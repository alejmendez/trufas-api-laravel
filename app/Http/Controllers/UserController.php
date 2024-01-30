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
        $users = User::with('roles');
        $users->order(request('order', ''));
        $users->search(request('search', ''));

        return new UserCollection($users->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $avatar = $request->file('avatar');
        $data = $request->all();
        if ($avatar) {
            $data['avatar'] = $request->file('avatar')->store('avatars');
        }
        $user = User::create($data)->assignRole($data['role']);
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
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $avatar = $request->file('avatar');
        $data = $request->all();
        if ($avatar) {
            $data['avatar'] = $request->file('avatar')->store('avatars');
        }
        logger()->error(request());
        $user->update($data);
        if (isset($data['role'])) {
            $user->assignRole($data['role']);
        }
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
