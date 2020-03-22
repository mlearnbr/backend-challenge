<?php

namespace App;

use App\Helpers\FormatterHelper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

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
        $this->celphone = FormatterHelper::onlyNumbers($data['celphone']);
        $this->access_level = $data['access_level'];

        if(!$this->saveOrFail())
            throw new \Exception('Falha ao salvar usuário');
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
