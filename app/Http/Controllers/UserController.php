<?php

namespace App\Http\Controllers;

use App\Services\Users\FindUser;
use App\Services\Users\ListUser;
use App\Services\Users\CreateUser;
use App\Services\Users\UpdateUser;
use App\Services\Users\DeleteUser;

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
        $order = request('order', '');
        $search = request('search', '');
        $users = ListUser::call($order, $search);

        return new UserCollection($users->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $data['avatar'] = $this->storeAvatar($request);
        $user = CreateUser::call($data);

        return response()->json(new UserResource($user), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = FindUser::call($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $avatar = $this->storeAvatar($request);
        $data = $request->all();
        $data['avatar'] = $avatar;
        $user = UpdateUser::call($id, $data);

        return response()->json(new UserResource($user), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DeleteUser::call($id);
        return response()->json(null, 204);
    }

    protected function storeAvatar(UpdateUserRequest | StoreUserRequest $request)
    {
        if (!$request->hasFile('avatar')) {
            return null;
        }

        return $request->file('avatar')->store(options: 'avatars');
    }
}
