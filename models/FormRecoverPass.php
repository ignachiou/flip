<?php
 
namespace app\models;
use Yii;
use yii\base\Model;
 
class FormRecoverPass extends Model{
 
    public $email;
     
    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'Campo requerido'],
            ['email', 'match', 'pattern' => "/^.{3,80}$/", 'message' => 'Mínimo 3 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
        ];
    }
}