<?php

namespace backend\models\tipoacta;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\tipoacta\TipoActa;

/**
 * TipoActaSearch represents the model behind the search form of `backend\models\tipoacta\TipoActa`.
 */
class TipoActaSearch extends TipoActa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtipo_acta'], 'integer'],
            [['tipo'], 'safe'],
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
        $query = TipoActa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idtipo_acta' => $this->idtipo_acta,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
