<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "revista".
 *
 * @property integer $id
 * @property string $titulo_revista
 * @property string $editorial_revista
 * @property string $volumen_revista
 * @property string $fasciculo_revista
 * @property string $fecha_revista
 * @property string $issn_revista
 * @property string $periodicidad_revista
 * @property string $url_revista
 * @property string $desc1
 * @property string $desc2
 * @property string $desc3
 * @property string $desc4
 *
 * @property Articulo[] $articulos
 */
class Revista extends \yii\db\ActiveRecord
{
	
	
	public $img;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'revista';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo_revista', 'editorial_revista', 'volumen_revista', 'fasciculo_revista', 'fecha_revista', 'issn_revista', 'periodicidad_revista',  'desc1', 'desc2', 'desc3', 'desc4'], 'required'],
            [['titulo_revista', 'editorial_revista', 'volumen_revista', 'fasciculo_revista', 'fecha_revista', 'issn_revista', 'periodicidad_revista',  'desc1', 'desc2', 'desc3', 'desc4'], 'string', 'max' => 50],
        		['img', 'file',/*'skipOnEmpty' => false,*/
        		'uploadRequired' => 'No has seleccionado ningun archivo', //Error
        		//'maxSize' => 1024*1024*1, //1 MB
        		//'tooBig' => 'El tama�o m�ximo permitido es 1MB', //Error
        		//'minSize' => 10, //10 Bytes
        		//'tooSmall' => 'El tama�o m�nimo permitido son 10 BYTES', //Error
        		'extensions' => 'jpg, gif,png',
        		'wrongExtension' => 'El archivo {img} no contiene una extensi�n permitida {extensions}', //Error
        		'maxFiles' => 500,
        		'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
        		],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo_revista' => 'Titulo Revista',
            'editorial_revista' => 'Editorial Revista',
            'volumen_revista' => 'Volumen Revista',
            'fasciculo_revista' => 'Fasciculo Revista',
            'fecha_revista' => 'Fecha Revista',
            'issn_revista' => 'Issn Revista',
            'periodicidad_revista' => 'Periodicidad Revista',
            'desc1' => 'Descriptor 1',
            'desc2' => 'Descriptor 2',
            'desc3' => 'Descriptor 3',
            'desc4' => 'Descriptor 4',
        	'img'   => 'Seleccionar imagenes en formato .jpg :',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulos()
    {
        return $this->hasMany(Articulo::className(), ['id_revista' => 'id']);
    }
}
