<?php

namespace App\Helpers;
use App\User;

/**
 * Class NavigationHelper
 *
 * @package App\Http\Helpers
 */

class NavigationHelper {

    /**
     * Cria o botão de editar default para as tabelas do sistema
     * @param string $idElement
     * @param string $class
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @version 1.0.0
     * @since 1.0.0 Primeira vez que esse metodo é introduzido
     * @return string
     */
    private function _buildLinkAlterar($idElement = null, $class = null){
        return ' <button title="Alterar" id="btnEdit'.$idElement.'" data-toggle="tooltip" data-placement="auto" class="btn btn-xs btn-inverse tip-top edit '.$class.'"><i class="fa fa-edit"> </i> </button> ';
    }

    /**
     * Cria o botão de apagar default para as tabelas do sistema
     * @param string $idElement
     * @param string $class
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @version 1.0.0
     * @since 1.0.0 Primeira vez que esse metodo é introduzido
     * @return string
     */
    private function _buildLinkRemover($idElement = null, $class = null){
        return ' <button title="Apagar" id="btnDelete'.$idElement.'" data-toggle="tooltip" data-placement="auto" class="btn btn-xs tip-top remove '.$class.'"><i class="fas fa-trash"> </i> </button> ';
    }

    /**
     * Cria os botoes default da tabela de usuarios
     * @param string $idElement
     * @param string $class
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @version 1.0.0
     * @since 1.0.0 Primeira vez que esse metodo é introduzido
     * @return string
     */
    public function builMenuActionsUsersTable($idElement = null, $class = null)
    {
        $html = $this->_buildLinkAlterar($idElement, $class);
        $html .= $this->_buildLinkRemover($idElement, $class);

        return $html;
    }

    /**
     * Cria o label para exibição do nível de acesso do usuário na listagem dos usuários
     * @param string $sLabel
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @version 1.0.0
     * @since 1.0.0 Primeira vez que esse metodo é introduzido
     * @return string
     */
    public function builLabelAccessLevelUser($sLabel)
    {
        return $sLabel == User::ACCESS_LEVEL_PREMIUM ? "<span class='badge badge-success badge-pill'> {$sLabel} </span>" : "<span class='badge badge-primary badge-pill'> {$sLabel} </span>";
    }
}