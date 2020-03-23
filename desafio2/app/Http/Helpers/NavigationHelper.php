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
        return ' <button title="Alterar" id="btnEdit'.$idElement.'" data-toggle="tooltip" data-placement="auto" class="btn btn-info btn-circle btn-sm edit '.$class.'"><i class="fa fa-edit"> </i> </button> ';
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
        return ' <button title="Apagar" id="btnDelete'.$idElement.'" data-toggle="tooltip" data-placement="auto" class="btn btn-danger btn-circle btn-sm remove '.$class.'"><i class="fas fa-trash"> </i> </button> ';
    }

    /**
     * Cria os botoes default da tabela de usuarios
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @version 1.0.0
     * @since 1.0.0 Primeira vez que esse metodo é introduzido
     * @return string
     */
    public function builMenuActionsUsersTable($sLabel)
    {
        $html = $this->_buildLinkAlterar();
        $html .= $this->_buildLinkRemover();
        $html .= $sLabel == User::ACCESS_LEVEL_PREMIUM ? $this->buildLinkDowngradeUser() : $this->buildLinkUpgradeUser();

        return $html;
    }

    /**
     * Cria o botao de upgrade de usuario
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @version 1.0.0
     * @since 1.0.0 Primeira vez que esse metodo é introduzido
     * @param null $idElement
     * @param null $class
     * @return string
     */
    public function buildLinkUpgradeUser($idElement = null, $class = null)
    {
        return ' <button title="Upgrade" id="btnDelete'.$idElement.'" data-toggle="tooltip" data-placement="auto" class="btn btn-success btn-circle btn-sm upgrade '.$class.'"><i class="far fa-arrow-alt-circle-up"> </i> </button> ';
    }

    /**
     * Cria o botao de downgrade de usuario
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @version 1.0.0
     * @since 1.0.0 Primeira vez que esse metodo é introduzido
     * @param null $idElement
     * @param null $class
     * @return string
     */
    public function buildLinkDowngradeUser($idElement = null, $class = null)
    {
        return ' <button title="Downgrade" id="btnDelete'.$idElement.'" data-toggle="tooltip" data-placement="auto" class="btn btn-warning btn-circle btn-sm downgrade '.$class.'"><i class="far fa-arrow-alt-circle-down"> </i> </button> ';
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