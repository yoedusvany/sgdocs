<?php

namespace backend\models\acuerdos;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\acuerdos\Acuerdos;

/**
 * AcuerdosSearch represents the model behind the search form of `backend\models\acuerdos\Acuerdos`.
 */
class AcuerdosSearch extends Acuerdos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idacuerdos', 'acta_id'], 'integer'],
            [['acuerdo', 'no_acuerdo'], 'safe'],
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
        $query = Acuerdos::find();

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
            'idacuerdos' => $this->idacuerdos,
            'acta_id' => $this->acta_id,
        ]);

        $query->andFilterWhere(['like', 'acuerdo', $this->acuerdo])
            ->andFilterWhere(['like', 'no_acuerdo', $this->no_acuerdo]);

        return $dataProvider;
    }
}
