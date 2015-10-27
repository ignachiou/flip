<?php

namespace app\models;
use Yii;
use yii\base\model;

class FormTesis extends model{
	
	public $id_tesis;
	public $titulo;
	public $redactor;
	public $tutor;
	public $cotutor;
	public $universidad;
	public $fecha_de_publicacion;
	public $resumen;
	public $img;
	public $url_tesis;
	public $descriptor1_tesis;
	public $descriptor2_tesis;
	public $descriptor3_tesis;
	public $descriptor4_tesis;

	
	public function rules(){
		
		return [
				['id_tesis', 'integer', 'message' => 'Id incorrecto'],
				['titulo', 'required', 'message' => 'Campo requerido'],
				['titulo', 'match', 'pattern' => '/^[a-z������\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['titulo', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'M�nimo 3 m�ximo 50 caracteres'],
				['redactor', 'required', 'message' => 'Campo requerido'],
				['redactor', 'match', 'pattern' => '/^[a-z������\s]+$/i', 'message' => 'S�lo se aceptan letras'],
				['redactor', 'match', 'pattern' => '/^.{3,80}$/', 'message' => 'M�nimo 3 m�ximo 80 caracteres'],
				['tutor', 'required', 'message' => 'Campo requerido'],
				['tutor', 'match', 'pattern' => '/^[a-z������\s]+$/i', 'message' => 'S�lo se aceptan letras'],
				['tutor', 'match', 'pattern' => '/^.{3,80}$/', 'message' => 'M�nimo 3 m�ximo 80 caracteres'],
				['cotutor', 'match', 'pattern' => '/^[a-z������\s]+$/i', 'message' => 'S�lo se aceptan letras'],
				['cotutor', 'match', 'pattern' => '/^.{3,80}$/', 'message' => 'M�nimo 3 m�ximo 80 caracteres'],
				['universidad', 'match', 'pattern' => '/^[a-z������\s]+$/i', 'message' => 'S�lo se aceptan letras'],
				['universidad', 'match', 'pattern' => '/^.{3,80}$/', 'message' => 'M�nimo 3 m�ximo 80 caracteres'],
				['fecha_de_publicacion', 'required', 'message' => 'Campo requerido'],
				['fecha_de_publicacion', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'solo se aceptan numeros'],
				['fecha_de_publicacion', 'match', 'pattern' => '/^.{1,5}$/', 'message' => 'M�nimo 1 m�ximo 5 caracteres'],
				['resumen', 'required', 'message' => 'Campo requerido'],
				['resumen', 'match', 'pattern' => '/^[a-z������\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['resumen', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'M�nimo 3 caracteres  m�ximo 50 caracteres'],
				['descriptor1_tesis', 'required', 'message' => 'Campo requerido'],
				['descriptor1_tesis', 'match', 'pattern' => '/^[a-z������\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['descriptor1_tesis', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'M�nimo 3 caracteres y m�ximo 50 caracteres'],
				['descriptor2_tesis', 'required', 'message' => 'Campo requerido'],
				['descriptor2_tesis', 'match', 'pattern' => '/^[a-z������\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['descriptor2_tesis', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'M�nimo 3 caracteres  m�ximo 50 caracteres'],
				['descriptor3_tesis', 'match', 'pattern' => '/^[a-z������\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['descriptor3_tesis', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'M�nimo 3 caracteres  m�ximo 50 caracteres'],
				['descriptor4_tesis', 'match', 'pattern' => '/^[a-z������\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['descriptor4_tesis', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'M�nimo 3 caracteres  m�ximo 50 caracteres'],
		
				['img', 'file',/*'skipOnEmpty' => false,*/
  				'uploadRequired' => 'No has seleccionado ningun archivo', //Error
  				//'maxSize' => 1024*1024*1, //1 MB
  				//'tooBig' => 'El tama�o m�ximo permitido es 1MB', //Error
  				//'minSize' => 10, //10 Bytes
  				//'tooSmall' => 'El tama�o m�nimo permitido son 10 BYTES', //Error
  				'extensions' => 'jpg, gif,png',
  				'wrongExtension' => 'El archivo {img} no contiene una extensi�n permitida {extensions}', //Error
  				'maxFiles' => 500,
  				'tooMany' => 'El m�ximo de archivos permitidos son {limit}', //Error
  				],
		];
		
	}
	
	public function attributeLabels()
	{
		return [
				'img' => 'Seleccionar imagenes en formato .jpg .gif o .png:'
		];
	}
}