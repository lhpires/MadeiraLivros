<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use \Inertia\Inertia;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return Inertia::render('UsersPage',[
            "users" => $users
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CreateUsersPage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = new User();

        $user->name = $validated['name'];
        $user->cpf = $validated['cpf'];
        $user->save();

        return redirect()->route('users.index')->withErrors(["teste" => "asas"]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::query()->findOrFail($id);
        
        return Inertia::render('UserEditPage',[
            "user" => $user
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id)
    {
        $user = User::query()->findOrFail($id);

        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->cpf = $validated['cpf'];
        $user->save();
        return redirect()->route('users.edit',[$user->id])->with('success','Editado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {        
        $user = User::query()->findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    
    }
}
