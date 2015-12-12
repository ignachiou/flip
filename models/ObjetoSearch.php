<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Objeto;


class ObjetoSearch extends Objeto
{
	
	public $busquedag;
	
        public function rules()
    {
        return [
            [['id_objeto'], 'integer'],
            [['nombre', 'autor', 'editorial', 'fecha', 'url', 'desc1', 'desc2', 'desc3', 'desc4', 'resumen', 'isbn','busquedag'], 'safe'],
        ];
    }
    
    public function attributeLabels()
    {
    	return [
    			'busquedag' => "Buscar Monografia:", //esto aparece en index
    			
    
    	];
    }

    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

   
    public function search($params)
    {
        $query = Objeto::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        

        $query->orFilterWhere(['like', 'nombre', $this->busquedag])
            ->orFilterWhere(['like', 'autor', $this->busquedag])
            ->orFilterWhere(['like', 'editorial', $this->busquedag])
            ->orFilterWhere(['like', 'fecha', $this->busquedag])
            ->orFilterWhere(['like', 'url', $this->busquedag])
            ->orFilterWhere(['like', 'desc1', $this->busquedag])
            ->orFilterWhere(['like', 'desc2', $this->busquedag])
            ->orFilterWhere(['like', 'desc3', $this->busquedag])
            ->orFilterWhere(['like', 'desc4', $this->busquedag])
            ->orFilterWhere(['like', 'resumen', $this->busquedag])
            ->orFilterWhere(['like', 'isbn', $this->busquedag])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'autor', $this->autor])
            ->andFilterWhere(['like', 'editorial', $this->editorial])
            ->andFilterWhere(['like', 'fecha', $this->fecha])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'desc1', $this->desc1])
            ->andFilterWhere(['like', 'desc2', $this->desc2])
            ->andFilterWhere(['like', 'desc3', $this->desc3])
            ->andFilterWhere(['like', 'desc4', $this->desc4])
            ->andFilterWhere(['like', 'resumen', $this->resumen])
            ->andFilterWhere(['like', 'isbn', $this->isbn]);
        
        

        return $dataProvider;
    }
}
