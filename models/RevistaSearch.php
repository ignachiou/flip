<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Revista;

/**
 * RevistaSearch represents the model behind the search form about `app\models\Revista`.
 */
class RevistaSearch extends Revista
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['titulo_revista', 'editorial_revista', 'volumen_revista', 'fasciculo_revista', 'fecha_revista', 'issn_revista', 'periodicidad_revista', 'url_revista', 'desc1', 'desc2', 'desc3', 'desc4'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Revista::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'titulo_revista', $this->titulo_revista])
            ->andFilterWhere(['like', 'editorial_revista', $this->editorial_revista])
            ->andFilterWhere(['like', 'volumen_revista', $this->volumen_revista])
            ->andFilterWhere(['like', 'fasciculo_revista', $this->fasciculo_revista])
            ->andFilterWhere(['like', 'fecha_revista', $this->fecha_revista])
            ->andFilterWhere(['like', 'issn_revista', $this->issn_revista])
            ->andFilterWhere(['like', 'periodicidad_revista', $this->periodicidad_revista])
            ->andFilterWhere(['like', 'url_revista', $this->url_revista])
            ->andFilterWhere(['like', 'desc1', $this->desc1])
            ->andFilterWhere(['like', 'desc2', $this->desc2])
            ->andFilterWhere(['like', 'desc3', $this->desc3])
            ->andFilterWhere(['like', 'desc4', $this->desc4]);

        return $dataProvider;
    }
}
