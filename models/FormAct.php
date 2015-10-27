<?php

namespace app\models;
use Yii;
use yii\base\model;
use app\models\Usuarios;

class FormAct extends model{
	
 	public $id;
    public $usuario;
    public $email;
    public $rol;
    public $nombre_usuario;
    public $apellido_usuario;
    public $locacion_usuario;
    
    public function rules()
    {
        return [

        	['rol', 'integer'],
        	['id', 'integer', 'message' => 'Id incorrecto'],
            [['usuario', 'email',], 'required', 'message' => 'Campo requerido'],
            ['usuario', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
        ];
    }
 
}