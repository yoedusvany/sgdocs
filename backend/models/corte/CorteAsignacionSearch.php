<?php

namespace backend\models\corte;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\corte\CorteAsignacion;

/**
 * CorteAsignacionSearch represents the model behind the search form of `backend\models\corte\CorteAsignacion`.
 */
class CorteAsignacionSearch extends CorteAsignacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcorte_asignacion', 'acta_id', 'asignacion_id'], 'integer'],
            [['nota', 'observaciones', 'no_orden'], 'safe'],
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
    public function search($params, $idacta)
    {
        $query = CorteAsignacion::find();

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
            'idcorte_asignacion' => $this->idcorte_asignacion,
            'acta_id' => $idacta,
            'asignacion_id' => $this->asignacion_id,
        ]);

        $query->andFilterWhere(['like', 'nota', $this->nota])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones])
            ->andFilterWhere(['like', 'no_orden', $this->no_orden]);

        return $dataProvider;
    }
}
