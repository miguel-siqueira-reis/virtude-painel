<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function store(Request $request) {
        $user = User::where('email', $request->email)
            ->where('phone', $request->phone)
            ->where('type', 'customer')->first();

        if ($user) {
            $user->update([
                'name' => $request->name,
            ]);
            return new UserResource($user);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->type = $request->type;
        $user->save();

        return new UserResource($user);
    }

    public function update(User $user, Request $request) {
        $user->update($request->all());
        return new UserResource($user);
    }
}
