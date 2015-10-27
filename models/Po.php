<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "po".
 *
 * @property integer $id
 * @property string $po_no
 * @property string $description
 *
 * @property PoItem[] $poItems
 */


class Po extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $img;
	
    public static function tableName()
    {
        return 'po';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['po_no', 'description'], 'required'],
            [['description'], 'string'],
            [['po_no'], 'string', 'max' => 10],
        		
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'po_no' => 'Po No',
            'description' => 'Description',
        	'img' => 'Seleccionar imagenes en formato .jpg .gif o .png:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoItems()
    {
        return $this->hasMany(PoItem::className(), ['po_id' => 'id']);
    }
}
