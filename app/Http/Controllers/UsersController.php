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
        // Check authorizations
        $this->authorize('viewAny', User::class);

        // Render page
        return Inertia::render('users/Index',[
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Check authorizations
        $this->authorize('viewAny', User::class);

        // Render page
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
        // Check authorizations
        $this->authorize('viewAny', User::class);

        // If validation passes, the data is automatically validated
        $validatedData = $request->validate([
            'name'  => 'required|string|max:120',
            'email' => 'required',
            'role'  => 'required'
        ]);

        // Update the user record
        $user->update($validatedData);

        // Redirect to index page
        return redirect()->route('users.edit', $user->id)->with('message', __('messages.users.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Check authorizations
        $this->authorize('viewAny', User::class);

        // Delete the user record
        $user->delete();

        // REdirect to index page
        return redirect()->route('users.index')->with('message',__('messages.users.delete'));
    }
}
