<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Articulo;

/**
 * ArticuloSearch represents the model behind the search form about `app\models\Articulo`.
 */
class ArticuloSearch extends Articulo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_articulo', 'id_revista'], 'integer'],
            [['titulo_articulo', 'autor_articulo', 'resumen_articulo', 'desc1', 'desc2', 'desc3', 'desc4'], 'safe'],
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
        $query = Articulo::find();

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
            'id_articulo' => $this->id_articulo,
            'id_revista' => $this->id_revista,
        ]);

        $query->andFilterWhere(['like', 'titulo_articulo', $this->titulo_articulo])
            ->andFilterWhere(['like', 'autor_articulo', $this->autor_articulo])
            ->andFilterWhere(['like', 'resumen_articulo', $this->resumen_articulo])
            ->andFilterWhere(['like', 'desc1', $this->desc1])
            ->andFilterWhere(['like', 'desc2', $this->desc2])
            ->andFilterWhere(['like', 'desc3', $this->desc3])
            ->andFilterWhere(['like', 'desc4', $this->desc4]);

        return $dataProvider;
    }
}
