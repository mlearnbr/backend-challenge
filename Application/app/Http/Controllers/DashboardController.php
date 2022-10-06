<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function datatable()
    {
        return DataTables::eloquent(User::query())
            ->make(true);
    }

    public function create(User $user)
    {
        return view('dashboard.create', compact('user'));
    }

    public function store(UserRequest $request, User $user)
    {
        $user->fill($request->all())->save();

        flash(__('flash.successful_registration'))->success();
        return redirect(route('users.show', compact('user')));
    }

    public function show(User $user)
    {
        return view('dashboard.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('dashboard.edit', compact('user'));
    }

    public function upgrade(Request $request, User $user)
    {
        $user->fill(['access_level' => 'premium'])->update();

        flash(__('flash.successful_update'))->success();
        return redirect(route('users.index', compact('user')));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all())->update();

        flash(__('flash.successful_update'))->success();
        return redirect(route('users.show', compact('user')));
    }

    public function downgrade(Request $request, User $user)
    {
        $user->fill(['access_level' => 'pro'])->update();

        flash(__('flash.successful_update'))->success();
        return redirect(route('users.index', compact('user')));
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $message = __('flash.successful_deleted');
        if ($request->ajax())
            return response()
                ->json(['message' => $message]);

        flash($message)->success();
        return redirect(route('users.index'));
    }

}
