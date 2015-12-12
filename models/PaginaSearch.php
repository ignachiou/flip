<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pagina;

/**
 * PaginaSearch represents the model behind the search form about `app\models\Pagina`.
 */
class PaginaSearch extends Pagina
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dependencia', 'tesis', 'publicaciones', 'articulo'], 'integer'],
            [['descripcion', 'url'], 'safe'],
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
        $query = Pagina::find();

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
            'dependencia' => $this->dependencia,
            'tesis' => $this->tesis,
            'publicaciones' => $this->publicaciones,
            'articulo' => $this->articulo,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
