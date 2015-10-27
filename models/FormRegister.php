<?php

namespace app\models;
use Yii;
use yii\base\model;
use app\models\Usuarios;

class FormRegister extends model{
	
    public $usuario;
    public $email;
    public $clave;
    public $repita_clave;
   // public $nombre_usuario;
   // public $apellido_usuario;
    //public $locacion_usuario;
    
    public function rules()
    {
        return [

        	['id', 'integer', 'message' => 'Id incorrecto'],
            [['usuario', 'email', 'clave', 'repita_clave'], 'required', 'message' => 'Campo requerido'],
            ['usuario', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'M�nimo 3 y m�ximo 50 caracteres'],
            ['usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'S�lo se aceptan letras y n�meros'],
            ['usuario', 'username_existe'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'M�nimo 5 y m�ximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no v�lido'],
            ['email', 'email_existe'],
            ['clave', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'M�nimo 6 y m�ximo 16 caracteres'],
            ['repita_clave', 'compare', 'compareAttribute' => 'clave', 'message' => 'Los passwords no coinciden'],
        ];
    }
    
    public function email_existe($attribute, $params)
    {
  
  //Buscar el email en la tabla
  $table = Usuarios::find()->where("email=:email", [":email" => $this->email]);
  
  //Si el email existe mostrar el error
  if ($table->count() == 1)
  {
                $this->addError($attribute, "El email seleccionado existe");
  }
    }
 
    public function username_existe($attribute, $params)
    {
  //Buscar el username en la tabla
  $table = Usuarios::find()->where("usuario=:usuario", [":usuario" => $this->usuario]);
  
  //Si el username existe mostrar el error
  if ($table->count() == 1)
  {
                $this->addError($attribute, "El usuario seleccionado existe");
  }
    }
 
}