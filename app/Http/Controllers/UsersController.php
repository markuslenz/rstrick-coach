<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\RoleEnum;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UsersController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        return Inertia::render('users/Index',[
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('viewAny', User::class);
        return Inertia::render('users/Edit',[
            'user' => $user,
            'roleOptions' => RoleEnum::options(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('viewAny', User::class);
        // If validation passes, the data is automatically validated
        $validatedData = $request->validate([
            'name'  => 'required|string|max:120',
            'email' => 'required',
            'role'  => 'required'
        ]);

        $user->update($validatedData);

        return redirect()->route('users.edit', $user->id)->with('message', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('viewAny', User::class);
        $user->delete();
        return redirect()->route('users.index')->with('message','User deleted successfully!');
    }
}
