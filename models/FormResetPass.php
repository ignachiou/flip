<?php
 
namespace app\models;
use Yii;
use yii\base\Model;
 
class FormResetPass extends Model{
 
 public $email;
 public $clave;
 public $password_repeat;
 public $verification_code;
 public $recover;
     
    public function rules()
    {
        return [
            [['email', 'clave', 'password_repeat', 'verification_code', 'recover'], 'required', 'message' => 'Campo requerido'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
            ['clave', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 8 y máximo 16 caracteres'],
            ['password_repeat', 'compare', 'compareAttribute' => 'clave', 'message' => 'Las claves no coinciden'],
        ];
    }
    
public function attributeLabels()
	{
		return [
				'clave' => 'Clave nueva',
				'password_repeat' => 'Repita clave nueva',
				'verification_code' => 'Codigo de verificación',
		];
	}
    
}