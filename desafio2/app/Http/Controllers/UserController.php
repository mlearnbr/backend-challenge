<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Helpers\NotificationHelper;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::All();
        return view('users.index', ['users' => $users]);        
    }

    public function create(Request $request)
    {                
        return view('users.form');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        
        try {
            DB::beginTransaction();
            $user = User::create($data);

            $user->save();

            DB::commit();
            NotificationHelper::sendNotification(
                'success',
                'Usuário administardor adicionado com sucesso.'
            );

            return redirect('users');
        } catch (Exception $e) {
            DB::rollback();
            NotificationHelper::sendNotification(
                'error',
                'Não foi possível adicionar este usuário. Verifique os dados informados e tente novamente!'
            );

            return back()->withInput();
        }
    }

    public function edit(Request $request, $id)
    {
        $user = User::with('areas')->find($id);

        if ($user->role->name === 'administrator') {
            $roles = Role::orderBy('label', 'asc')->get();
            $companies = Company::orderBy('name', 'asc')->get();
        } else {
            $roles = Role::where('name', '!=', 'administrator')
                ->orderBy('label', 'asc')
                ->get();
                $company = Company::find($user->company_id);
        
                $areas = Area::where('company_id', $user->company_id)->orderBy('name', 'asc')->get();
        }

        return view('users.form', [
            'user' => $user,
            'roles' => $roles,
            'companies' => isset($companies) ? $companies : [],
            'company' => isset($company) ? $company : '',
            'areas' => isset($areas) ? $areas : '',
        ]);
    }

    public function update(Request $request, $id)
    {

        $user = User::with('areas')->find($id);
        $data = $request->all();                     
        $data['password'] = bcrypt($data['password']);

        try {
            DB::beginTransaction();
            $user->update($data);

            if($user->role->name !== 'administrator'){
                $areas = $data['area_array'];
                UserAreas::where('user_id', 0)->delete();

                foreach($areas as $area){
                    if($area){                    
                        UserAreas::create(
                            array_merge(
                                [
                                    'user_id' => $user->id,
                                    'area_id' => $area, 
                                ]
                            )
                        );
                    }
                }
            }

            DB::commit();
            NotificationHelper::sendNotification(
                'success',
                'Usuário editado com sucesso.'
            );

            return redirect('users');
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            NotificationHelper::sendNotification(
                'error',
                'Não foi possível editar este usuário. Verifique os dados informados e tente novamente!'
            );

            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            NotificationHelper::sendNotification(
                'success',
                'Usuário deletado com sucesso.'
            );

            return redirect('users');
        } catch (Exception $e) {
            DB::rollback();
            NotificationHelper::sendNotification(
                'error',
                'Não foi possível deletar este usuário. Verifique os dados informados e tente novamente!'
            );

            return redirect('users');
        }
    }
       
}
