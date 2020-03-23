<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;

class UserController extends Controller
{
    /**
     * Parse Index DataTable da listagem de usuarios
     *
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @since 1.0.0
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function parse_index(Request $request)
    {
        $aRetorno = [];

        $aUsers = User::all();

        $aRetorno['total'] = $aUsers->count();

        foreach ($aUsers as $oUser) {
            $oData = new \stdClass();
            $oData->id = $oUser->id;
            $oData->name = $oUser->name;
            $oData->cellphone = $oUser->cellphone;
            $oData->access_level = $this->NavigationHelper->builLabelAccessLevelUser($oUser->access_level);
            $oData->actions = $this->NavigationHelper->builMenuActionsUsersTable($oUser->access_level);

            $aRetorno['rows'][] = $oData;
        }

        return response()->json($aRetorno);
    }

    /**
     * Parse Index DataTable da listagem de usuarios
     *
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @since 1.0.0
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $aRetorno = ['msg' => 'Usuário salvo com sucesso!', 'class' => 'success'];

        try {
            if ($request->has('id') && !empty($request->get('id'))) {

                $oUser = User::find($request->get('id'));
                if(!$oUser)
                    throw new \Exception('Usuário não localizado');
            } else {
                $oUser = new User;
            }

            $oUser->saveCustom($request->all());

        } catch (\Exception $ex){
            $aRetorno = ['msg' => $ex->getMessage(), 'class' => 'error'];
        }

        return response()->json($aRetorno);
    }

    /**
     * Formulario para editar um usuário
     *
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @since 1.0.0
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {

        if(!$request->has('id'))
            return view('users.edit');

        $oUser = User::find($request->get('id'));
        return view('users.edit', compact("oUser"))->render();
    }


    /**
     * Remove um usuario
     *
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @since 1.0.0
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {

        $aRetorno = ['msg' => 'Usuário deletado com sucesso!', 'class' => 'success'];

        try {
            if ($request->has('id') && !empty($request->get('id'))) {

                $oUser = User::find($request->get('id'));
                if(!$oUser)
                    throw new \Exception('Usuário não localizado');
            } else {
                $oUser = new User;
            }

            $oUser->deleteCustom();

        } catch (\Exception $ex){
            $aRetorno = ['msg' => $ex->getMessage(), 'class' => 'error'];
        }

        return response()->json($aRetorno);
    }

    /**
     * Realiza o upgrade de um usuario
     *
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @since 1.0.0
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upgrade(Request $request)
    {

        $aRetorno = ['msg' => 'Upgrade realizado com sucesso!', 'class' => 'success'];

        try {
            if ($request->has('id') && !empty($request->get('id'))) {

                $oUser = User::find($request->get('id'));
                if(!$oUser)
                    throw new \Exception('Usuário não localizado');
            } else {
                $oUser = new User;
            }

            $oUser->upgrade();

        } catch (\Exception $ex){
            $aRetorno = ['msg' => $ex->getMessage(), 'class' => 'error'];
        }

        return response()->json($aRetorno);
    }

    /**
     * Realiza o upgrade de um usuario
     *
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @since 1.0.0
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function downgrade(Request $request)
    {

        $aRetorno = ['msg' => 'Downgrade realizado com sucesso!', 'class' => 'success'];

        try {
            if ($request->has('id') && !empty($request->get('id'))) {

                $oUser = User::find($request->get('id'));
                if(!$oUser)
                    throw new \Exception('Usuário não localizado');
            } else {
                $oUser = new User;
            }

            $oUser->downgrade();

        } catch (\Exception $ex){
            $aRetorno = ['msg' => $ex->getMessage(), 'class' => 'error'];
        }

        return response()->json($aRetorno);
    }
}
