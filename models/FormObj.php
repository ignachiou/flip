<?php

namespace app\models;
use Yii;
use yii\base\model;

class FormObj extends model{

public $id_objeto;
public $nombre_objeto_bibliografico;
public $autor;
public $editorial;
public $fecha;
public $lengua;
public $colaborador;
public $resumen;
public $tema;
public $img;
public $url;
public $isbn;
public $descriptor_a;
public $descriptor_b;
public $descriptor_c;
public $descriptor_d;



public function rules()
 {
  return [
   ['id_objeto', 'integer', 'message' => 'Id incorrecto'],
   ['nombre_objeto_bibliografico', 'required', 'message' => 'Campo requerido'],
   ['nombre_objeto_bibliografico', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
   ['nombre_objeto_bibliografico', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['autor', 'required', 'message' => 'Campo requerido'],
   ['autor', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['autor', 'match', 'pattern' => '/^.{3,80}$/', 'message' => 'Mínimo 3 máximo 80 caracteres'],
   ['editorial', 'required', 'message' => 'Campo requerido'],
   ['editorial', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['editorial', 'match', 'pattern' => '/^.{3,80}$/', 'message' => 'Mínimo 3 máximo 80 caracteres'],
   ['fecha', 'required', 'message' => 'Campo requerido'],
   ['fecha', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'solo se aceptan numeros'],
   ['fecha', 'match', 'pattern' => '/^.{1,5}$/', 'message' => 'Mínimo 1 máximo 5 caracteres'],
   ['lengua', 'required', 'message' => 'Campo requerido'],
   ['lengua', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
   ['lengua', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['tema', 'required', 'message' => 'Campo requerido'],
   ['tema', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
   ['tema', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['resumen', 'required', 'message' => 'Campo requerido'],
   ['resumen', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
   ['resumen', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['isbn', 'required', 'message' => 'Campo requerido'],
   ['isbn', 'match', 'pattern' => '/^[0-9a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras y numeros'],
   ['isbn', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['descriptor_a', 'required', 'message' => 'Campo requerido'],
   ['descriptor_a', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
   ['descriptor_a', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['descriptor_b', 'required', 'message' => 'Campo requerido'],
   ['descriptor_b', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
   ['descriptor_b', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['descriptor_c', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
   ['descriptor_c', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['descriptor_d', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Solo se aceptan letras'],
   ['descriptor_d', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
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