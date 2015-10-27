<?php

namespace app\models;
use Yii;
use yii\base\model;

class FormRevista extends model{
	
	public $id;
	public $titulo_revista;
	public $editorial_revista;
	public $volumen_revista;
	public $fasciculo_revista;
	public $fecha_revista;
	public $issn_revista;	
	public $periodicidad_revista;
	public $url_revista;
	public $img;
	public $desc1;
	public $desc2;
	public $desc3;
	public $desc4;

	
	public function rules(){
		
		return [
				['id', 'integer', 'message' => 'Id incorrecto'],
				['public $volumen_revista;', 'required', 'message' => 'Campo requerido'],
				['public $volumen_revista;', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['public $volumen_revista;', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
				['editorial_revista', 'required', 'message' => 'Campo requerido'],
				['editorial_revista', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
				['editorial_revista', 'match', 'pattern' => '/^.{3,80}$/', 'message' => 'Mínimo 3 máximo 80 caracteres'],				
				['fasciculo_revista', 'required', 'message' => 'Campo requerido'],
				['fasciculo_revista', 'match', 'pattern' => '/^[0-9a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
				['fasciculo_revista', 'match', 'pattern' => '/^.{1,20}$/', 'message' => 'Mínimo 1 máximo 20 caracteres'],
				['fecha_revista', 'required', 'message' => 'Campo requerido'],
				['fecha_revista', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'solo se aceptan numeros'],
				['fecha_revista', 'match', 'pattern' => '/^.{1,5}$/', 'message' => 'Mínimo 1 máximo 5 caracteres'],
				['issn_revista','match','pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['issn_revista','match','pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 caracteres  máximo 50 caracteres'],
				['volumen_revista', 'required', 'message' => 'Campo requerido'],
				['volumen_revista', 'match', 'pattern' => '/^[0-9a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
				['volumen_revista', 'match', 'pattern' => '/^.{1,20}$/', 'message' => 'Mínimo 1 máximo 20 caracteres'],
				['periodicidad_revista', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
				['periodicidad_revista', 'match', 'pattern' => '/^.{3,80}$/', 'message' => 'Mínimo 3 máximo 80 caracteres'],
				['desc1', 'required', 'message' => 'Campo requerido'],
				['desc1', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['desc1', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 caracteres y máximo 50 caracteres'],
				['desc2', 'required', 'message' => 'Campo requerido'],
				['desc2', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['desc2', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 caracteres  máximo 50 caracteres'],
				['desc3', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['desc3', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 caracteres  máximo 50 caracteres'],
				['desc4', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
				['desc4', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 caracteres  máximo 50 caracteres'],
		
				['img', 'file',/*'skipOnEmpty' => false,*/
						'uploadRequired' => 'No has seleccionado ningun archivo', //Error
						//'maxSize' => 1024*1024*1, //1 MB
						//'tooBig' => 'El tamaño máximo permitido es 1MB', //Error
						//'minSize' => 10, //10 Bytes
						//'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
						'extensions' => 'jpg, gif,png',
						'wrongExtension' => 'El archivo {img} no contiene una extensión permitida {extensions}', //Error
						'maxFiles' => 500,
						'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
				],
		];
		
	}
	
	public function attributeLabels()
	{
		return [
				'img' => 'Seleccionar imagenes en formato .jpg .gif o .png:',
		];
	}
}