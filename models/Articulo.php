<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articulo".
 *
 * @property integer $id_articulo
 * @property integer $id_revista
 * @property string $titulo_articulo
 * @property string $autor_articulo
 * @property string $resumen_articulo
 * @property string $desc1
 * @property string $desc2
 * @property string $desc3
 * @property string $desc4
 *
 * @property Revista $idRevista
 */
class Articulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articulo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'titulo_articulo', 'autor_articulo', 'resumen_articulo', 'desc1', 'desc2', 'desc3', 'desc4'], 'required'],
            [['id_revista'], 'integer'],
            [['titulo_articulo', 'autor_articulo', 'desc1', 'desc2', 'desc3', 'desc4'], 'string', 'max' => 50],
            [['resumen_articulo'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_articulo' => 'Id Articulo',
            'id_revista' => 'Id Revista',
            'titulo_articulo' => 'Titulo Articulo',
            'autor_articulo' => 'Autor Articulo',
            'resumen_articulo' => 'Resumen Articulo',
            'desc1' => 'Desc1',
            'desc2' => 'Desc2',
            'desc3' => 'Desc3',
            'desc4' => 'Desc4',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRevista()
    {
        return $this->hasOne(Revista::className(), ['id' => 'id_revista']);
    }
}
