<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('admin', auth()->user());

        $filters = [
            'name' => request('name'),
        ];

        $users = User::query()->filter($filters)->latest()->paginate(5);

        return Inertia::render('Admin/Users/Index', [
            'users' => $users->through(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->is_admin ? 'Admin' : 'Author',
                    'created_at' => $user->created_at->format('Y-m-d'),
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('admin', auth()->user());

        return Inertia::render('Admin/Users/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->authorize('admin', auth()->user());

        $data = $request->validated();
        // dd($data);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Form', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_admin' => $user->is_admin ? true : false,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('admin', auth()->user());

        $data = $request->validated();

        if($request->password != null)
        {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('admin', auth()->user());

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}
