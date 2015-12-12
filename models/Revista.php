<?php

namespace app\models;

use Yii; 

class Revista extends \yii\db\ActiveRecord
{
	
	
	public $img;
	
    
    public static function tableName()
    {
        return 'revista';
    }

    
    public function rules()
    {
        return [
            [['titulo_revista', 'editorial_revista', 'periodicidad_revista',  'desc1', 'desc2', ], 'required', 'message' => 'Campo requerido'],
            [['titulo_revista', 'editorial_revista', 'volumen_revista', 'fasciculo_revista', 'url_revista', 'fecha_revista', 'issn_revista', 'periodicidad_revista',  'desc1', 'desc2', 'desc3', 'desc4'], 'string', 'max' => 500],
        		['img', 'file',/*'skipOnEmpty' => false,*/
        		'uploadRequired' => 'No has seleccionado ningun archivo', //Error
        		//'maxSize' => 1024*1024*1, //1 MB
        		//'tooBig' => 'El tama�o m�ximo permitido es 1MB', //Error
        		//'minSize' => 10, //10 Bytes
        		//'tooSmall' => 'El tama�o m�nimo permitido son 10 BYTES', //Error
        		'extensions' => 'jpg',
        		'wrongExtension' => 'El archivo {img} no contiene una extensión permitida {extensions}', //Error
        		'maxFiles' => 1,
        		'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
        		],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo_revista' => 'Titulo Publicación',
            'editorial_revista' => 'Editorial Publicación',
            'volumen_revista' => 'Volumen Publicación',
            'fasciculo_revista' => 'Fasciculo Publicación',
            'fecha_revista' => 'Fecha Publicación',
            'issn_revista' => 'Issn Publicación',
            'periodicidad_revista' => 'Periodicidad Publicación',
        	'url_revista' => 'Url Publicación',
            'desc1' => 'Descriptor 1',
            'desc2' => 'Descriptor 2',
            'desc3' => 'Descriptor 3',
            'desc4' => 'Descriptor 4',
        	'img'   => 'Seleccionar imagenes en formato .jpg :',
        ];
    }

   
    public function getArticulos()
    {
        return $this->hasMany(Articulo::className(), ['id_revista' => 'id']);
    }
    
    public function getPaginas()
    {
    	return $this->hasMany(Pagina::className(), ['publicaciones' => 'id']);
    }
}
