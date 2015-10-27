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
            ['usuario', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'M�nimo 3 y m�ximo 50 caracteres'],
            ['usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'S�lo se aceptan letras y n�meros'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'M�nimo 5 y m�ximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no v�lido'],
        ];
    }
 
}