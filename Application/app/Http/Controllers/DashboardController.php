<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\QualificaService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();
        try {
            $user->fill($request->all())->save();
            $service = new QualificaService();
            $service->storeUser($user->toArray());

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            flash(__('flash.failed_registration'))->error();
            return redirect(route('users.index'));
        }

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
        DB::beginTransaction();
        try {
            $user->fill(['access_level' => 'premium'])->update();
            $service = new QualificaService();
            $service->upgradeUser($user->qualifica_id);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            flash(__('flash.failed_update'))->error();
            return redirect(route('users.index'));
        }

        flash(__('flash.successful_update'))->success();
        return redirect(route('users.index'));
    }

    public function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->fill($request->all())->update();
            $service = new QualificaService();
            $service->updateUser(collect($user)->only([
                'msisdn',
                'name',
                'access_level',
                'password',
            ])->toArray(), $user->qualifica_id);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            flash(__('flash.failed_update'))->error();
            return redirect(route('users.index'));
        }

        flash(__('flash.successful_update'))->success();
        return redirect(route('users.show', compact('user')));
    }

    public function downgrade(Request $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->fill(['access_level' => 'pro'])->update();
            $service = new QualificaService();
            $service->downgradeUser($user->qualifica_id);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            flash(__('flash.failed_update'))->error();
            return redirect(route('users.index'));
        }

        flash(__('flash.successful_update'))->success();
        return redirect(route('users.index'));
    }

    public function destroy(Request $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            $service = new QualificaService();
            $service->deleteUser($user->qualifica_id);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            flash(__('flash.failed_deleted'))->error();
            return redirect(route('users.index'));
        }

        flash(__('flash.successful_deleted'))->success();
        return redirect(route('users.index'));
    }

}
