<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tesis;


class TesisSearch extends Tesis
{
    public $busquedag;
	
    public function rules()
    {
        return [
            [['id_tesis'], 'integer'],
            [['titulo_tesis', 'tutor_tesis', 'cotutor_tesis', 'redactor_tesis', 'fecha_tesis', 'resumen_tesis', 'url', 'desc1_tesis', 'desc2_tesis', 'desc3_tesis', 'desc4_tesis', 'universidad','busquedag'], 'safe'],
        ];
    }

     public function attributeLabels()
    {
    	return [
    			'busquedag' => "Buscar Tesis:", //esto aparece en index
    			
    
    	];
    }
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Tesis::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

       $query->andFilterWhere(['like', 'titulo_tesis', $this->titulo_tesis])
            ->andFilterWhere(['like', 'tutor_tesis', $this->tutor_tesis])
            ->andFilterWhere(['like', 'cotutor_tesis', $this->cotutor_tesis])
            ->andFilterWhere(['like', 'redactor_tesis', $this->redactor_tesis])
            ->andFilterWhere(['like', 'fecha_tesis', $this->fecha_tesis])
            ->andFilterWhere(['like', 'resumen_tesis', $this->resumen_tesis])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'desc1_tesis', $this->desc1_tesis])
            ->andFilterWhere(['like', 'desc2_tesis', $this->desc2_tesis])
            ->andFilterWhere(['like', 'desc3_tesis', $this->desc3_tesis])
            ->andFilterWhere(['like', 'desc4_tesis', $this->desc4_tesis])
            ->andFilterWhere(['like', 'universidad', $this->universidad])
       		->orFilterWhere(['like', 'titulo_tesis', $this->busquedag])
            ->orFilterWhere(['like', 'tutor_tesis', $this->busquedag])
            ->orFilterWhere(['like', 'cotutor_tesis', $this->busquedag])
            ->orFilterWhere(['like', 'redactor_tesis', $this->busquedag])
            ->orFilterWhere(['like', 'fecha_tesis', $this->busquedag])
            ->orFilterWhere(['like', 'resumen_tesis', $this->busquedag])
            ->orFilterWhere(['like', 'desc1_tesis', $this->busquedag])
            ->orFilterWhere(['like', 'desc2_tesis', $this->busquedag])
            ->orFilterWhere(['like', 'desc3_tesis', $this->busquedag])
            ->orFilterWhere(['like', 'desc4_tesis', $this->busquedag])
            ->orFilterWhere(['like', 'universidad', $this->busquedag]);

        return $dataProvider;
    }
}
