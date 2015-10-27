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
            ['usuario', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['usuario', 'username_existe'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
            ['email', 'email_existe'],
            ['clave', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 6 y máximo 16 caracteres'],
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