<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\UserCreate;
use App\Filters\UserFilters;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(UserFilters $filters): View|Factory|Application
    {
        $users = User::filter($filters)->with('orders')->paginate(9);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $roles = Role::get();
        return view('admin.user.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        (new UserCreate())->create($request->validated());
        return redirect()->route('admin.users.index')->with('success', 'Пользователь создан');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user): View|Factory|Application
    {
        $user->load('orders.cart.positions', 'orders.cart.coupons', 'orders.currency', 'role');
        return view('admin.user.show', compact('user'));
    }

    public function ban(User $user): RedirectResponse
    {
        if (!Gate::allows('user-ban', $user)){
            return redirect()->back()->with('warning', 'Нельзя забанить себя');
        }
        $user->ban = true;
        $user->save();
        return redirect()->back()->with('warning', 'Пользователь заблокирован');
    }

    public function unBan(User $user): RedirectResponse
    {
        if (!Gate::allows('user-ban', $user)){
            return redirect()->back()->with('warning', 'Нельзя разбанить себя');
        }
        $user->ban = false;
        $user->save();
        return redirect()->back()->with('success', 'Пользователь разблокирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->back()->with('warning', 'Пользователь удалён');
    }
}
