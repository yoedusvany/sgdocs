<?php

namespace backend\models\departamento;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\departamento\Departamento;

/**
 * DepartamentoSearch represents the model behind the search form of `backend\models\departamento\Departamento`.
 */
class DepartamentoSearch extends Departamento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iddepartamento'], 'integer'],
            [['nombre', 'area_id'], 'safe'],
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
        $query = Departamento::find();

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


        $query->joinWith('area');

        // grid filtering conditions
        $query->andFilterWhere([
            'iddepartamento' => $this->iddepartamento,
            'area' => $this->area,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
