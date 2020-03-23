<?php

namespace App;

use App\Helpers\FormatterHelper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use \App\Api\MlearnApi\User as UserApi;
use App\Api\MlearnApi;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Runner\Exception;

class User extends Authenticatable
{
    use Notifiable;

    CONST ACCESS_LEVEL_FREE = 'free';
    CONST ACCESS_LEVEL_PREMIUM = 'premium';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Metodo custom para o save
     * @param Array $data
     * @throws \Exception
     * @return void
     */
    public function saveCustom($data)
    {

        $this->name = $data['name'];
        $this->cellphone = FormatterHelper::onlyNumbers($data['cellphone']);
        $this->access_level = $data['access_level'];

        if(isset($data['password']) && !empty($data['password']))
            $this->password = Hash::make($data['password']);

        if(empty($data['id'])) {
            $this->_createUserApi();
        } else {
            $this->_updateUserApi();
        }

        if(!$this->saveOrFail())
            throw new \Exception('Falha ao salvar usuário');
    }

    /**
     * Cria o usuário na API
     * @throws \Exception
     */
    private function _createUserApi()
    {
        $oMlearnApi = new MlearnApi();
        $oUserApi = new UserApi();
        $oUserApi->setMsisdn($this->cellphone);
        $oUserApi->setName($this->name);
        $oUserApi->setAccessLevel($this->access_level);
        $oUserApi->setPassword($this->password);
        $oUserApi->setExternalId($this->id);

        try{

            $ret = $oMlearnApi->createUser($oUserApi);
            $this->mlearn_id = $ret['data']['id'];
            $this->save();

        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Cria o usuário na API
     * @throws \Exception
     */
    private function _updateUserApi()
    {
        $oMlearnApi = new MlearnApi();
        $oUserApi = new UserApi();
        $oUserApi->setMsisdn($this->cellphone);
        $oUserApi->setName($this->name);
        $oUserApi->setAccessLevel($this->access_level);
        $oUserApi->setPassword($this->password);
        $oUserApi->setExternalId($this->id);
        $oUserApi->setMlearnId($this->mlearn_id);

        try{

            $oMlearnApi->updateUser($oUserApi);

        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Realiza o upgrade de um usuário
     */
    public function upgrade()
    {
        $this->access_level = self::ACCESS_LEVEL_PREMIUM;

        try{
            $this->_upgradeUserApi();
            $this->saveOrFail();
        } catch (\Exception $ex){
            throw new \Exception('Falha ao realizar upgrade do usuario: '.$ex->getMessage());
        }
    }

    /**
     * Realiza o downgrade de um usuário
     */
    public function downgrade()
    {
        $this->access_level = self::ACCESS_LEVEL_FREE;

        try{
            $this->_downgradeUserApi();
            $this->saveOrFail();
        } catch (\Exception $ex){
            throw new \Exception('Falha ao realizar downgrade do usuario: '.$ex->getMessage());
        }
    }

    /**
     * Realiza o upgrade de um usuário junto à API
     * @throws \Exception
     */
    private function _upgradeUserApi()
    {
        $oMlearnApi = new MlearnApi();
        $oUserApi = new UserApi();
        $oUserApi->setMlearnId($this->mlearn_id);
        try{
            $oMlearnApi->upgrade($oUserApi);
        } catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Realiza o downgrade de um usuário junto à API
     * @throws \Exception
     */
    private function _downgradeUserApi()
    {

        $oMlearnApi = new MlearnApi();
        $oUserApi = new UserApi();
        $oUserApi->setMlearnId($this->mlearn_id);
        try{
            $oMlearnApi->downgrade($oUserApi);
        } catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Metodo custom para delete
     * @throws \Exception
     * @return void
     */
    public function deleteCustom()
    {
        if(!$this->delete())
            throw new \Exception('Falha ao deletar usuário');

        $this->_deleteUserApi();
    }

    /**
     * Remove o usuário na API
     * @throws \Exception
     */
    private function _deleteUserApi()
    {
        $oMlearnApi = new MlearnApi();
        $oUserApi = new UserApi();
        $oUserApi->setMlearnId($this->mlearn_id);

        try{

            $oMlearnApi->deleteUser($oUserApi);

        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Remove o usuário na API
     * @throws \Exception
     * @return array
     */
    private function _findUserApi()
    {
        $oMlearnApi = new MlearnApi();
        $oUserApi = new UserApi();
        $oUserApi->setExternalId($this->id);
        $oUserApi->setMsisdn($this->cellphone);

        try{

            return $oMlearnApi->findUser($oUserApi);

        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Lista de opções para preencher o <select>
     *
     * @author Rodrigo Cabral <rbatista.ti@gmail.com>
     * @since 1.0.0
     *
     * @return array
     */
    public static function listOptionsAccessLevel()
    {
        return [
            self::ACCESS_LEVEL_FREE => 'Free',
            self::ACCESS_LEVEL_PREMIUM => 'Premium'
        ];
    }

}
