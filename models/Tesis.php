<?php

namespace app\models;

use Yii;


class Tesis extends \yii\db\ActiveRecord
{
    public $img;
    
    public static function tableName()
    {
        return 'tesis';
    }

    
    public function rules()
    {
        return [
            [['titulo_tesis', 'tutor_tesis', 'redactor_tesis', 'fecha_tesis', 'resumen_tesis',  'desc1_tesis', 'desc2_tesis', 'universidad'], 'required', 'message' => 'Campo requerido'],
            [['titulo_tesis'], 'string', 'max' => 500],
            [['tutor_tesis', 'cotutor_tesis', 'redactor_tesis', 'fecha_tesis', 'url', 'desc1_tesis', 'desc2_tesis', 'desc3_tesis', 'desc4_tesis', 'universidad'], 'string', 'max' => 50],
            [['resumen_tesis'], 'string', 'max' => 2000]
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id_tesis' => 'Id Tesis',
            'titulo_tesis' => 'Titulo Tesis',
            'tutor_tesis' => 'Tutor Tesis',
            'cotutor_tesis' => 'Cotutor Tesis',
            'redactor_tesis' => 'Redactor Tesis',
            'fecha_tesis' => 'Fecha Tesis',
            'resumen_tesis' => 'Resumen Tesis',
            'url' => 'Url',
            'desc1_tesis' => 'Descriptor 1',
            'desc2_tesis' => 'Descriptor 2',
            'desc3_tesis' => 'Descriptor 3',
            'desc4_tesis' => 'Descriptor 4',
            'universidad' => 'Universidad',
        ];
    }

    
    public function getPaginas()
    {
        return $this->hasMany(Pagina::className(), ['tesis' => 'id_tesis']);
    }
}
