<?php

namespace app\models;

use Yii;
use yii\base\Model;


class LoginForm extends Model
{
    public $usuario;
    public $clave;
    public $recuerdame = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // usuario y clave son requeridos
            [['usuario', 'clave'], 'required','message' => 'Campo requerido'],
            // recuerdame es un valor booleano
            ['recuerdame', 'boolean'],
            // clave es validado por validatepassword
            ['clave', 'validatePassword'],
        ];
    }

   
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->clave)) {
                $this->addError($attribute, 'Usuario o Clave incorrecta');
            }
        }
    }

    /**
   
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->recuerdame ? 3600*24*30 : 0);
        } else {
            return false;
        }
    }

    /**
     * encontrar usuario via usuario
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->usuario);
        }

        return $this->_user;
    }
}
