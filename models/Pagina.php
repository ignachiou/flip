<?php

namespace app\models;

use Yii;

class Pagina extends \yii\db\ActiveRecord
{
	
	public $img;
    
    public static function tableName()
    {
        return 'pagina';
    }

    
    public function rules()
    {
        return [
            [['descripcion'], 'required', 'message' => 'Campo requerido'],
            [['dependencia', 'tesis', 'publicaciones', 'articulo'], 'integer'],
            [['descripcion', 'url'], 'string', 'max' => 100],
        		['img', 'file',/*'skipOnEmpty' => false,*/
        		'uploadRequired' => 'No has seleccionado ningun archivo', //Error
        		//'maxSize' => 1024*1024*1, //1 MB
        		//'tooBig' => 'El tama�o m�ximo permitido es 1MB', //Error
        		//'minSize' => 10, //10 Bytes
        		//'tooSmall' => 'El tama�o m�nimo permitido son 10 BYTES', //Error
        		'extensions' => 'jpg,',
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
            'descripcion' => 'Descripcion de la página',
            'url' => 'Url',
            'dependencia' => 'Id de Monográfia',
            'tesis' => 'Id de Tesis',
            'publicaciones' => 'Id de Publicaciones',
            'articulo' => 'Id de Articulo',
        	'img'   => 'Seleccionar imagenes en formato .jpg :'
        ];
    }

    
    public function getDependencia()
    {
        return $this->hasOne(Objeto::className(), ['id_objeto' => 'dependencia']);
    }

   
    public function getArticulo()
    {
        return $this->hasOne(Articulo::className(), ['id_articulo' => 'articulo']);
    }

    
    public function getPublicaciones()
    {
        return $this->hasOne(Revista::className(), ['id' => 'publicaciones']);
    }

    
    public function getTesis()
    {
        return $this->hasOne(Tesis::className(), ['id_tesis' => 'tesis']);
    }
}
