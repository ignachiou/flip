<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "objeto".
 *
 * @property integer $id_objeto
 * @property string $nombre
 * @property string $autor
 * @property string $editorial
 * @property string $fecha
 * @property string $url
 * @property string $desc1
 * @property string $desc2
 * @property string $desc3
 * @property string $desc4
 * @property string $resumen
 * @property string $isbn
 *
 * @property Pagina[] $paginas
 */
class Objeto extends \yii\db\ActiveRecord
{
    
	public $img;
	
    public static function tableName()
    {
        return 'objeto';
    }

    
    public function rules()
    {
        return [
            [['nombre', 'autor', 'editorial', 'fecha', 'desc1', 'desc2', 'resumen'], 'required', 'message' => 'Campo requerido'],        		
            [['nombre', 'autor'], 'string', 'max' => 500],
            [['editorial', 'fecha', 'url', 'desc1', 'desc2', 'desc3', 'desc4', 'isbn'], 'string', 'max' => 50],
            [['resumen'], 'string', 'max' => 2000],
        		['img', 'file',/*'skipOnEmpty' => true,*/
        		'uploadRequired' => 'No has seleccionado ningun archivo', //Error
        		//'maxSize' => 1024*1024*1, //1 MB
        		//'tooBig' => 'El tama�o m�ximo permitido es 1MB', //Error
        		//'minSize' => 10, //10 Bytes
        		//'tooSmall' => 'El tama�o m�nimo permitido son 10 BYTES', //Error
        		'extensions' => 'jpg',
        		'wrongExtension' => 'El archivo {img} no contiene una extensión permitida {extensions}', //Error
        		'maxFiles' => 500,
        		'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
        		],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id_objeto' => 'Id Objeto',
            'nombre' => 'Nombre',
            'autor' => 'Autor',
            'editorial' => 'Editorial',
            'fecha' => 'Fecha de Publicación',
            'url' => 'Url',
            'desc1' => 'Descriptor 1',
            'desc2' => 'Descriptor 2',
            'desc3' => 'Descriptor 3',
            'desc4' => 'Descriptor 4',
            'resumen' => 'Resumen',
            'isbn' => 'Isbn',
        ];
    }

    
    public function getPaginas()
    {
        return $this->hasMany(Pagina::className(), ['dependencia' => 'id_objeto']);
    }
}
